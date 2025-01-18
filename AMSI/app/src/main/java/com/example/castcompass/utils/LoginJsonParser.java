package com.example.castcompass.utils;

import android.content.Context;

import com.example.castcompass.models.Utilizador;

import org.json.JSONObject;
import org.json.JSONException;

public class LoginJsonParser {

    public static Utilizador loginJsonParser(String response){
        Utilizador utilizador = new Utilizador();

        try {

            JSONObject loginJSON = new JSONObject(response);
            utilizador.setId(loginJSON.getInt("id"));
            utilizador.setIdProfile(loginJSON.getInt("idProfile"));
            utilizador.setToken(loginJSON.getString("token"));
            utilizador.setUsername(loginJSON.getString("username"));
            utilizador.setEmail(loginJSON.getString("email"));

        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return utilizador;
    }

}
