package com.example.castcompass.listeners;


import com.example.castcompass.models.Produto;

import java.util.ArrayList;

public interface ProdutosListener {
    void onRefreshListaProdutos(ArrayList<Produto> listaProdutos);
}
