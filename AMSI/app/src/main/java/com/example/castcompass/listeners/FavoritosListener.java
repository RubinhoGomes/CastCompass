package com.example.castcompass.listeners;

import com.example.castcompass.models.Favoritos;

import java.util.ArrayList;

public interface FavoritosListener {
    void onRefreshListaFavoritos(ArrayList<Favoritos> favoritos);
}
