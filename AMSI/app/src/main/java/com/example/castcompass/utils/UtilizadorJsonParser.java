package com.example.castcompass.utils;

import android.util.Log;

import com.example.castcompass.models.Utilizador;

import org.json.JSONException;
import org.json.JSONObject;

public class UtilizadorJsonParser {

    public static Utilizador parserJsonUtilizador(String response) {
        Utilizador utilizador = new Utilizador();
        try {
            JSONObject utilizadorJSON = new JSONObject(response);

            utilizador.setId(utilizadorJSON.getInt("id"));
            utilizador.setIdProfile(utilizadorJSON.getInt("idProfile"));
            utilizador.setNif(utilizadorJSON.getString("nif"));
            utilizador.setTelemovel(utilizadorJSON.getString("telemovel"));
            utilizador.setUsername(utilizadorJSON.getString("username"));
            utilizador.setDataNascimento(utilizadorJSON.getString("dtaNascimento"));
            utilizador.setNome(utilizadorJSON.getString("nome"));
            utilizador.setEmail(utilizadorJSON.getString("email"));
            utilizador.setToken(utilizadorJSON.getString("token"));
            utilizador.setGenero(utilizadorJSON.getString("genero"));
            utilizador.setMorada(utilizadorJSON.getString("morada"));

        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return utilizador;
    }
}
