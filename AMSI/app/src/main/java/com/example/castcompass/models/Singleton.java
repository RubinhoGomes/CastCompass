package com.example.castcompass.models;

// Imports from Android

import android.content.Context;
import android.widget.Toast;

//
import org.json.JSONObject;

// Imports from CastCompass
import com.example.castcompass.listeners.LoginListener;
import com.example.castcompass.utils.LoginJsonParser;
import com.example.castcompass.utils.util;

// Imports from Volley
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;


// For now I know this is the imports to use the HashMap and Map, and of course ArrayList
// I will need to check the import for the Volley
import java.util.HashMap;
import java.util.Map;

public class Singleton {

    // VARIABLES

    private static Singleton instance = null;
    private static RequestQueue volleyQueue;
    private LoginListener loginListener;

    private String login;
    private static String urlApiLogin = "http://127.0.0.1:8888/Projeto/CastCompass/PLSI/CastCompass/frontend/web/api/login/login/";


    // CONSTRUCTOR

    public static synchronized Singleton getInstance(Context context) {
        if (instance == null) {
            instance = new Singleton(context);
            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    private Singleton(Context context) {

            // Produtos
            // Produtos Helper
    }

    // LISTENERS

    public void setLoginListener(LoginListener loginListener) {
        this.loginListener = loginListener;
    }

    // API

    public void loginAPI(final String username, final String password, final Context context) {
        if (!util.isConnected(context)) {
            Toast.makeText(context, "Sem conexão à internet", Toast.LENGTH_SHORT).show();
        } else {

            StringRequest request = new StringRequest(Request.Method.POST, urlApiLogin, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        String token = jsonObject.getString("token");
                        int id = jsonObject.getInt("id");

                        login = LoginJsonParser.loginJsonParser(response);

                        // SharedPreferences.Editor editor = context.getSharedPreferences("pref", Context.MODE_PRIVATE).edit();
                        // editor.putString("token", jsonObject.getString("token"));
                        // editor.apply();

                        Toast.makeText(context, "Login efetuado com sucesso com o", Toast.LENGTH_SHORT).show();
                        Toast.makeText(context, "Token: " + token, Toast.LENGTH_SHORT).show();
                    } catch (Exception e) {
                        Toast.makeText(context, "Erro: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "Erro: " + error.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }) {
                @Override
                protected Map<String, String> getParams() {
                    Map<String, String> params = new HashMap<>();
                    params.put("username", username);
                    params.put("password", password);
                    return params;
                }
            };
            volleyQueue.add(request);
        }
    }
}
