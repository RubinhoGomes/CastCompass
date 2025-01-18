package com.example.castcompass.utils;

import com.example.castcompass.models.Carrinho;
import com.example.castcompass.models.CarrinhoItems;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class CarrinhoJsonParser {

    public static Carrinho parserJsonCarrinho(String response) {
        Carrinho carrinho  = null;
        try {
            JSONObject carrinhoJSON = new JSONObject(response);
            int id = carrinhoJSON.getInt("id");
            int profileID = carrinhoJSON.getInt("profileID");
            float valorTotal = carrinhoJSON.getInt("valorTotal");
            int quantidade = carrinhoJSON.getInt("quantidade");

            JSONArray jsonArray = new JSONArray(response);

            ArrayList<CarrinhoItems> items = parserJsonItems(jsonArray.getJSONArray(1));

            carrinho = new Carrinho(id,profileID,valorTotal,quantidade, items);
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }
        return carrinho;
    }

    public static ArrayList<CarrinhoItems> parserJsonItems(JSONArray response) {
        ArrayList<CarrinhoItems> items = null;
        try{
            for (int i = 0; i < response.length(); i++) {
                JSONObject produtoJSON = (JSONObject) response.get(i);
                int carrinhoId = produtoJSON.getInt("id");
                String imagem = produtoJSON.getString("imagem");
                String nome = produtoJSON.getString("nome");
                int produtoID = produtoJSON.getInt("produtoID");
                int quantidade = produtoJSON.getInt("quantidade");
                float valorTotal = (float) produtoJSON.getDouble("valorTotal");
                
                CarrinhoItems item = new CarrinhoItems(carrinhoId, produtoID, nome, imagem, quantidade, valorTotal);
                items.add(item);
            }
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }
        return items;
    }
}
