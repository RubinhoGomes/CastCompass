package com.example.castcompass.listeners;

import com.example.castcompass.models.MetodoPagamento;

import java.util.ArrayList;

public interface MetodoPagamentoListener {
    void onMetodoPagamentoCarregado(ArrayList<MetodoPagamento> metodosPagamento);
}
