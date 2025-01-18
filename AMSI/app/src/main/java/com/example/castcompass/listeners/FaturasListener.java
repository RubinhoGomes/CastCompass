package com.example.castcompass.listeners;

import com.example.castcompass.models.Faturas;

import java.util.ArrayList;

public interface FaturasListener {
    void onRefreshFaturas(ArrayList<Faturas> faturas);
}
