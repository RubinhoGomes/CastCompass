package com.example.castcompass.utils;

import com.example.castcompass.models.Utilizador;

import org.json.JSONException;
import org.json.JSONObject;

public class UtilizadorJsonParser {

    public static Utilizador parserJsonUtilizador(String response) {
        Utilizador utilizador = null;
        try {
            JSONObject utilizadorJSON = new JSONObject(response);

            int id = utilizadorJSON.getInt("id");
            int idProfile = utilizadorJSON.getInt("idProfile");
            int nif = utilizadorJSON.getInt("nif");
            int telemovel = utilizadorJSON.getInt("telemovel");
            int dataNascimento = utilizadorJSON.getInt("dataNascimento");
            String username = utilizadorJSON.getString("username");
            String nome = utilizadorJSON.getString("nome");
            String email = utilizadorJSON.getString("email");
            String token = utilizadorJSON.getString("token");
            String genero = utilizadorJSON.getString("genero");
            String morada = utilizadorJSON.getString("morada");

            utilizador = new Utilizador(id, idProfile, nif, telemovel, dataNascimento, username, nome, email, token, genero, morada);
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return utilizador;
    }
}
