package com.example.castcompass;

import android.os.Bundle;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.example.castcompass.models.Singleton;

public class CompraActivity extends AppCompatActivity {
    private TextView tvTotal;
    private Spinner spMetodoExpedicao, spMetodoPagamento;
    private Button btnCompraFinal;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_compra);

        tvTotal = findViewById(R.id.tvTotal);
        spMetodoExpedicao = findViewById(R.id.spMetodoExpedicao);
        spMetodoPagamento = findViewById(R.id.spMetodoPagamento);
        btnCompraFinal = findViewById(R.id.btnCompraFinal);

        Singleton.getInstance(this).getCarrinhoAPI(this);
        Singleton.getInstance(this).getMetodosExpedicaoAPI(this);
        Singleton.getInstance(this).getMetodosPagamentoAPI(this);

    }
}