package com.example.castcompass;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.castcompass.listeners.CarrinhoFinalListener;
import com.example.castcompass.listeners.MetodoExpedicaoListener;
import com.example.castcompass.listeners.MetodoPagamentoListener;
import com.example.castcompass.models.CarrinhoItems;
import com.example.castcompass.models.MetodoExpedicao;
import com.example.castcompass.models.MetodoPagamento;
import com.example.castcompass.models.Singleton;

import java.util.ArrayList;
import java.util.List;

public class CompraActivity extends AppCompatActivity implements CarrinhoFinalListener, MetodoExpedicaoListener, MetodoPagamentoListener {
    private TextView tvTotal;
    private Spinner spMetodoExpedicao, spMetodoPagamento;
    private Button btnCompraFinal;
    private int carrinhoID, metodoExpedicaoID, metodoPagamentoID;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_compra);
        setTitle("Compra Final");

        tvTotal = findViewById(R.id.tvTotal);
        spMetodoExpedicao = findViewById(R.id.spMetodoExpedicao);
        spMetodoPagamento = findViewById(R.id.spMetodoPagamento);
        btnCompraFinal = findViewById(R.id.btnCompraFinal);

        Singleton.getInstance(this).setCarrinhoFinalListener(this);
        Singleton.getInstance(this).setMetodoExpedicaoListener(this);
        Singleton.getInstance(this).setMetodoPagamentoListener(this);

        Singleton.getInstance(this).getCarrinhoFinalAPI(this);
        Singleton.getInstance(this).getMetodosExpedicaoAPI(this);
        Singleton.getInstance(this).getMetodosPagamentoAPI(this);

        spMetodoExpedicao.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                MetodoExpedicao metodoExpedicao = (MetodoExpedicao) parent.getSelectedItem();
                metodoExpedicaoID = metodoExpedicao.getId();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                metodoExpedicaoID = 1;
            }
        });

        spMetodoPagamento.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                MetodoPagamento metodoPagamento = (MetodoPagamento) parent.getSelectedItem();
                metodoPagamentoID = metodoPagamento.getId();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                metodoPagamentoID = 1;
            }
        });

        btnCompraFinal.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
//                Log.e("CompraActivity", "onClick: carrinho " + carrinhoID + " exped " + metodoExpedicaoID + " pag " + metodoPagamentoID);
                finalizarCompra();
            }
        });
    }

    @Override
    public void onCarrinhoLoaded(String total, int carrinhoID) {
        this.carrinhoID = carrinhoID;
        tvTotal.setText("Total a pagar: " + total + "€");
    }

    @Override
    public void onMetodoExpedicaoCarregado(List<MetodoExpedicao> metodosExpedicao) {
        ArrayAdapter<MetodoExpedicao> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_item, metodosExpedicao);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spMetodoExpedicao.setAdapter(adapter);
        adapter.notifyDataSetChanged();
    }

    @Override
    public void onMetodoPagamentoCarregado(ArrayList<MetodoPagamento> metodosPagamento) {
        ArrayAdapter<MetodoPagamento> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_item, metodosPagamento);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spMetodoPagamento.setAdapter(adapter);
        adapter.notifyDataSetChanged();
    }

    private void finalizarCompra() {
        Singleton.getInstance(this).comprarCarrinhoAPI(this, carrinhoID, metodoExpedicaoID, metodoPagamentoID);

        Intent intent = new Intent(this, MenuMainActivity.class);
        intent.putExtra("produtos", true);
        startActivity(intent);

        finish();
    }
}