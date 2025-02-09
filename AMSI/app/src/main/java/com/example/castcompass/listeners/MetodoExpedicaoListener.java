package com.example.castcompass.listeners;

import com.example.castcompass.models.MetodoExpedicao;

import java.util.List;

public interface MetodoExpedicaoListener {
    void onMetodoExpedicaoCarregado(List<MetodoExpedicao> metodosExpedicao);
}
