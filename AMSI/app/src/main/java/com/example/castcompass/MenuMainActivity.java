package com.example.castcompass;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.graphics.Insets;
import androidx.core.view.GravityCompat;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import com.example.castcompass.models.Singleton;
import com.example.castcompass.utils.util;
import com.google.android.material.navigation.NavigationView;

public class MenuMainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    private NavigationView navigationView;
    private DrawerLayout drawer;
    private FragmentManager fragmentManager;
    private String username = "Sem Username!";
    private MenuItem navLogOut;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu_main);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        drawer = findViewById(R.id.drawerLayout);
        navigationView = findViewById(R.id.navView);
        navLogOut = navigationView.getMenu().findItem(R.id.navLogOut);

        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar, R.string.ndOpen, R.string.ndClose);
        toggle.syncState();
        drawer.addDrawerListener(toggle);

        carregarCabecalho();
        navigationView.setNavigationItemSelectedListener(this);
        fragmentManager = getSupportFragmentManager();

        if (getIntent().getBooleanExtra("produtos", false)) {
            carregarFragmentoInicial();
        }

        carregarFragmentoInicial();
    }

    private boolean carregarFragmentoInicial() {
        Menu menu = navigationView.getMenu();
        int menuconexao = 0;

        if (!util.isConnected(this)) {
            menuconexao = 1;
        }

        MenuItem item = menu.getItem(menuconexao);
        item.setChecked(true);
        return onNavigationItemSelected(item);
    }

    private void carregarCabecalho() {
        username = getIntent().getStringExtra(LoginActivity.USER);
        SharedPreferences sharedPrefUser = getSharedPreferences("DADOS_USER", Context.MODE_PRIVATE);

        if (username != null) {
            SharedPreferences.Editor editor = sharedPrefUser.edit();
            editor.putString("USERNAME", username);
            editor.apply();
        } else {
            username = sharedPrefUser.getString("USERNAME", "Sem Username!");
        }

        View headerView = navigationView.getHeaderView(0);
        TextView nav_tvUsername = headerView.findViewById(R.id.tvUsername);
        nav_tvUsername.setText(username);
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        Fragment fragment = null;
        View headerView = navigationView.getHeaderView(0);
        TextView nav_tvUsername = headerView.findViewById(R.id.tvUsername);

        if (nav_tvUsername.getText().toString().equals("Sem Username!")) {
            navLogOut.setTitle("Login");
        }

        if (item.getItemId() == R.id.navHome) {
            fragment = new ListaProdutosFragment();
            setTitle(item.getTitle());
        } else if (item.getItemId() == R.id.navFavoritos) {
            if (nav_tvUsername.getText().toString().equals("Sem Username!") && !util.isConnected(this)) {
                Toast.makeText(this, "Para aceder offline à lista de favoritos deves primeiro fazer login", Toast.LENGTH_SHORT).show();
                Intent intent = new Intent(this, IpServidorActivity.class);
                startActivity(intent);
                finish();
            } else if (nav_tvUsername.getText().toString().equals("Sem Username!")) {
                loginRedirect();
            } else {
                fragment = new ListaFavoritosFragment();
                setTitle(item.getTitle());
            }
        } else if (item.getItemId() == R.id.navCarrinho) {
            if (nav_tvUsername.getText().toString().equals("Sem Username!")) {
                loginRedirect();
            } else {
                fragment = new ListaCarrinhoFragment();
                setTitle(item.getTitle());
            }
        } else if (item.getItemId() == R.id.navFaturas) {
            if (nav_tvUsername.getText().toString().equals("Sem Username!")) {
                loginRedirect();
            } else {
                fragment = new ListaFaturasFragment();
                setTitle(item.getTitle());
            }
        } else if (item.getItemId() == R.id.navPerfil) {
            if (nav_tvUsername.getText().toString().equals("Sem Username!")) {
                loginRedirect();
            } else {
                Intent intent = new Intent(this, PerfilActivity.class);
                startActivity(intent);
            }
        } else if (item.getItemId() == R.id.navLogOut) {
            if (navLogOut.getTitle().equals("Login")) {
                Intent intent = new Intent(this, LoginActivity.class);
                startActivity(intent);
                finish();
            } else {
                Singleton singleton = Singleton.getInstance(this);
                singleton.logoutAPI(this);

                Intent intent = new Intent(this, LoginActivity.class);
                startActivity(intent);
                finish();
            }
        }

        if (fragment != null) {
            fragmentManager.beginTransaction().replace(R.id.contentFragment, fragment).commit();
        }

        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    private void enviarEmail() {
        //TODO: intent implicito ACTION_SEND
    }

    private void loginRedirect() {
        Toast.makeText(this, "Tem de fazer o login primeiro", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(this, LoginActivity.class);
        startActivity(intent);
        finish();
    }
}