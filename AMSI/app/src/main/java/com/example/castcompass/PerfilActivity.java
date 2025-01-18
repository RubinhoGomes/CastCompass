package com.example.castcompass;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import androidx.appcompat.app.AppCompatActivity;

import com.example.castcompass.listeners.UtilizadorListener;
import com.example.castcompass.models.Utilizador;

public class PerfilActivity extends AppCompatActivity implements UtilizadorListener {
    private EditText etUsername, etEmail, etDataNascimento, etNome, etNumero, etMorada, etNif, etGenero;
    private Button btnGuardarPerfil, btnApagarPerfil;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_perfil);
        setTitle("Perfil");

        etUsername = findViewById(R.id.etUsername);
        etEmail = findViewById(R.id.etEmail);
        etDataNascimento = findViewById(R.id.etDataNascimento);
        etNome = findViewById(R.id.etNome);
        etNumero = findViewById(R.id.etNumero);
        etMorada = findViewById(R.id.etMorada);
        etNif = findViewById(R.id.etNif);
        etGenero = findViewById(R.id.etGenero);
        btnGuardarPerfil = findViewById(R.id.btnGuardarPerfil);
        btnApagarPerfil = findViewById(R.id.btnApagarPerfil);


    }

    public void onClickEditarPerfil(View view) {
        if (btnGuardarPerfil.getText().equals("Editar Perfil")) {
            etNome.setEnabled(true);
            etNumero.setEnabled(true);
            etMorada.setEnabled(true);
            etNif.setEnabled(true);
            etGenero.setEnabled(true);
            btnGuardarPerfil.setText("Guardar Perfil");
        } else {
            etNome.setEnabled(false);
            etNumero.setEnabled(false);
            etMorada.setEnabled(false);
            etNif.setEnabled(false);
            etGenero.setEnabled(false);

            // Guardar as alterações


            btnGuardarPerfil.setText("Editar Perfil");
        }
    }

    public void onClickApagarPerfil(View view) {

    }

    @Override
    public void onRefreshUtilziador(Utilizador utilizador) {

    }
}