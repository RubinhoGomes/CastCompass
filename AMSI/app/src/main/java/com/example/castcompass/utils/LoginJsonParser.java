package com.example.castcompass.utils;

import android.content.Context;

import org.json.JSONObject;
import org.json.JSONException;

public class LoginJsonParser {

    public static String loginJsonParser(String response){
        String token = null;

        try {

            JSONObject loginJSON = new JSONObject(response);
            token = loginJSON.getString("token");

        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        return token;
    }

}
