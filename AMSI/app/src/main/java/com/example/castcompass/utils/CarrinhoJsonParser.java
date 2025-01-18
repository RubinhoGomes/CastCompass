package com.example.castcompass.utils;

import com.example.castcompass.models.Carrinho;

import org.json.JSONException;
import org.json.JSONObject;

public class CarrinhoJsonParser {

    public static Carrinho parserJsonCarrinho(String response) {
        Carrinho carrinho  = null;
        try {
            JSONObject carrinhoJSON = new JSONObject(response);
            int id = carrinhoJSON.getInt("id");
            int profileID = carrinhoJSON.getInt("profileID");
            float valorTotal = carrinhoJSON.getInt("valorTotal");
            int quantidade = carrinhoJSON.getInt("quantidade");


            carrinho = new Carrinho(id,profileID,valorTotal,quantidade);
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }
        return carrinho;
    }
}
