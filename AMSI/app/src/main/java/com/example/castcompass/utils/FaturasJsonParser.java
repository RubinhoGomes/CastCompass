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
                int metodoExpedicaoID = faturaJSON.getInt("metodoExpedicaoID");
                String data = faturaJSON.getString("data");
                int metodoPagamentoID = faturaJSON.getInt("metodoPagamentoID");

                Faturas fatura = new Faturas(id, valorTotal,ivaTotal, metodoExpedicaoID, data,metodoPagamentoID);
                faturas.add(fatura);
            }
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return faturas;
    }
}
