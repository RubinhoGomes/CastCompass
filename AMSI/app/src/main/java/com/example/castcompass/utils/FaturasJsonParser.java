package com.example.castcompass.utils;

import com.example.castcompass.models.Faturas;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class FaturasJsonParser {
    public static ArrayList<Faturas> parserJsonFaturas(JSONArray response) {
        ArrayList<Faturas> faturas = new ArrayList<>();

        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject faturaJSON = (JSONObject) response.get(i);

                int id = faturaJSON.getInt("id");
                float valorTotal = (float) faturaJSON.getDouble("valorTotal");
                float ivaTotal = (float) faturaJSON.getDouble("ivaTotal");
                String metodoExpedicaoID = faturaJSON.getString("metodoExpedicaoID");
                String metodoPagamentoID = faturaJSON.getString("metodoPagamentoID");
                String data = faturaJSON.getString("data");
                String estado = faturaJSON.getString("estado");

                Faturas fatura = new Faturas(id, metodoExpedicaoID, metodoPagamentoID, valorTotal, ivaTotal, data, estado);
                faturas.add(fatura);
            }
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return faturas;
    }
}
