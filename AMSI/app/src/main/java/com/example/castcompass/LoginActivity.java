package com.example.castcompass;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class LoginActivity extends AppCompatActivity {

    public static final int TAMANHO_MINIMO_SENHA = 4;
    public static final String EMAIL = "Email";

    public EditText etEmail;
    public EditText etPassword;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        etEmail = findViewById(R.id.etEmail);
        etPassword = findViewById(R.id.etPassword);
    }

    public void onClickLogin(View view) {
        //TODO: código para validar email e password
        //usar o setError das TextViews para mostrar mensagens de erro
        String email = etEmail.getText().toString();
        String password = etPassword.getText().toString();

        if (!isEmailValid(email)) {
            etEmail.setError("Email inválido");
            return;
        }

        if (!isPasswordValid(password)) {
            etPassword.setError("Tem de ter 4 ou mais Caracteres");
            return;
        }

//        Toast.makeText(this,"Login efetuado com sucesso", Toast.LENGTH_LONG).show();
//        Intent intent = new Intent(this, MainActivity.class);
        Intent intent = new Intent(this, MenuMainActivity.class);
        intent.putExtra(EMAIL, email);
        startActivity(intent);
        finish();
    }

    public boolean isEmailValid(String email) {
        if (email == null) {
            return false;
        }
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    public boolean isPasswordValid(String password) {
        if (password == null) {
            return false;
        }
        return password.length() >= TAMANHO_MINIMO_SENHA;
    }
}