package com.example.castcompass.listeners;

import com.example.castcompass.models.CarrinhoItems;

import java.util.ArrayList;

public interface CarrinhoListener {
    void onRefreshCarrinho(ArrayList<CarrinhoItems> carrinho);
}
