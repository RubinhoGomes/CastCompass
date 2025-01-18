package com.example.castcompass.utils;

import android.content.Context;
import android.content.SharedPreferences;

import com.example.castcompass.models.Favoritos;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class FavoritosJsonParser {

    public static ArrayList<Favoritos> parserJsonFavoritos(String response) {
        ArrayList<Favoritos> favoritos = new ArrayList<>();
        //SharedPreferences sharedIP  = context.getSharedPreferences("IP", Context.MODE_PRIVATE);
        //String ip = sharedIP.getString("ip", "");

        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject favoritoJSON = new JSONObject(response);

                int id = favoritoJSON.getInt("id");
                int idProduto = favoritoJSON.getInt("idProduto");
                int idUtilizador = favoritoJSON.getInt("idUtilizador");
                String nome = favoritoJSON.getString("nome");
                String marca = favoritoJSON.getString("marca");
                String descricao = favoritoJSON.getString("descricao");
                String categoria = favoritoJSON.getString("categoria");
                String imagem = favoritoJSON.getString("imagem");
                int preco = favoritoJSON.getInt("iva");

                Favoritos favorito = new Favoritos(id, idProduto, idUtilizador, nome, marca, descricao, categoria, imagem, preco);
                favoritos.add(favorito);
            }
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return favoritos;
    }

}
