package com.example.castcompass.utils;

import android.util.Log;

import com.example.castcompass.models.CarrinhoItems;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class CarrinhoItemsJsonParser {
    public static ArrayList<CarrinhoItems > parserJsonCarrinho(JSONArray response) {
        ArrayList<CarrinhoItems> carrinhoItens = new ArrayList<>();
        //SharedPreferences sharedIP  = context.getSharedPreferences("IP", Context.MODE_PRIVATE);
        //String ip = sharedIP.getString("ip", "");

        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject item = (JSONObject) response.get(i);

                int id = item.getInt("id");
                int idProduto = item.getInt("produtoID");
                int quantidade = item.getInt("quantidade");
                String nome = item.getString("nome");
                String imagem = item.getString("imagem");
                float valorTotal = (float) item.getDouble("valorTotal");

                carrinhoItens.add(new CarrinhoItems(id, idProduto, quantidade, nome, imagem, valorTotal));
            }
        } catch (JSONException e) {
            throw new RuntimeException(e);
        };

        return carrinhoItens;
    }
}
