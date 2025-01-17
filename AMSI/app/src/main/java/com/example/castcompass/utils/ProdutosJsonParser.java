package com.example.castcompass.utils;

import android.content.Context;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.castcompass.models.Produto;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class ProdutosJsonParser {

    public static ArrayList<Produto> parserJsonProdutos(JSONArray response, Context context) {
        ArrayList<Produto> produtos = new ArrayList<>();
        SharedPreferences sharedIP  = context.getSharedPreferences("IP", Context.MODE_PRIVATE);
        String ip = sharedIP.getString("ip", "");

        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject produtoJSON = (JSONObject) response.get(i);

                int id = produtoJSON.getInt("id");
                String nome = produtoJSON.getString("nome");
                String marca = produtoJSON.getString("marca");
                float preco = (float) produtoJSON.getDouble("preco");
                int stock = produtoJSON.getInt("stock");
                String descricao = produtoJSON.getString("descricao");
                String categoria = produtoJSON.getString("categoria");
                int iva = produtoJSON.getInt("iva");

                String imgPath = produtoJSON.getString("imagem");;

                Produto produto = new Produto(id, nome, marca, descricao, preco, stock, categoria, iva, imgPath);
                produtos.add(produto);
            }
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return produtos;
    }

    public static Produto parserJsonProduto(String response) {
        Produto produto = null;

        try {
            JSONObject produtoJSON = new JSONObject(response);

            int id = produtoJSON.getInt("id");
            String nome = produtoJSON.getString("nome");
            String marca = produtoJSON.getString("marca");
            float preco = (float) produtoJSON.getDouble("preco");
            int stock = produtoJSON.getInt("stock");
            String descricao = produtoJSON.getString("descricao");
            String categoria = produtoJSON.getString("categoria");
            int iva = produtoJSON.getInt("iva");
            String imagem = produtoJSON.getString("imagem");

            produto = new Produto(id, nome, marca, descricao, preco, stock, categoria, iva, imagem);
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return produto;
    }

    public static boolean isConnectionInternet(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo netInfo = cm.getActiveNetworkInfo();
        return (netInfo != null && netInfo.isConnected());
    }
}
