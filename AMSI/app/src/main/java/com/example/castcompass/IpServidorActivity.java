package com.example.castcompass;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.example.castcompass.models.Singleton;

public class IpServidorActivity extends AppCompatActivity {

    private EditText etIpServidor;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ip_servidor);
    }

    public void onClickServidor(View view) {
        etIpServidor = findViewById(R.id.etIpServidor);
        String ipServidor = etIpServidor.getText().toString();
        Singleton singleton = Singleton.getInstance(this);
        singleton.MudarIP(ipServidor);

        Intent intent = new Intent(this, LoginActivity.class);
        startActivity(intent);
        finish();
    }
}