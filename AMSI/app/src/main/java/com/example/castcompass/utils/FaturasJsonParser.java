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

                float valorTotal = (float) faturaJSON.getDouble("valorTotal");
                float ivaTotal = (float) faturaJSON.getDouble("ivaTotal");
                int metodoExpedicaoID = faturaJSON.getInt("metodoExpedicaoID");
                int metodoPagamentoID = faturaJSON.getInt("metodoPagamentoID");
                String data = faturaJSON.getString("data");

                Faturas fatura = new Faturas(metodoExpedicaoID, metodoPagamentoID, valorTotal, ivaTotal, data);
                faturas.add(fatura);
            }
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return faturas;
    }
}
