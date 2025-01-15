package com.example.castcompass.models;

// Imports from Android

import android.content.Context;
import android.widget.Toast;

//
import org.json.JSONArray;
import org.json.JSONObject;

// Imports from CastCompass
import com.example.castcompass.listeners.LoginListener;
import com.example.castcompass.listeners.ProdutosListener;
import com.example.castcompass.utils.LoginJsonParser;
import com.example.castcompass.utils.util;
import com.example.castcompass.utils.ProdutosJsonParser;
// Imports from Volley
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import java.util.ArrayList;

// For now I know this is the imports to use the HashMap and Map, and of course ArrayList
// I will need to check the import for the Volley
import java.util.HashMap;
import java.util.Map;

public class Singleton {

    // VARIABLES

    private static Singleton instance = null;
    private static RequestQueue volleyQueue;
    private LoginListener loginListener;

    private ProdutosListener produtosListener;

    private String login;
    private static String urlApiLogin = "http://127.0.0.1:8888/Projeto/CastCompass/PLSI/CastCompass/backend/web/api/login/login/";
    private static String urlApiProdutos = "http://localhost/CastCompass/PLSI/CastCompass/backend/web/api/produtos";

    private ArrayList<Produto> listaProdutos;


    public void setProdutosListener(ProdutosListener produtosListener) {
        this.produtosListener = produtosListener;
    }

    // CONSTRUCTOR

    public static synchronized Singleton getInstance(Context context) {
        if (instance == null) {
            instance = new Singleton(context);
            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    private Singleton(Context context) {
        volleyQueue = Volley.newRequestQueue(context);
        listaProdutos = new ArrayList<>();
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

    public void getAllProdutosAPI(final Context context) {
        StringRequest request = new StringRequest(Request.Method.GET, urlApiProdutos, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    // Parse do JSON retornado pela API
                    JSONArray jsonArray = new JSONArray(response);
                    listaProdutos.clear(); // Limpar a lista anterior

                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject jsonObject = jsonArray.getJSONObject(i);
                        Produto produto = ProdutosJsonParser.parserJsonProduto(jsonObject.toString());
                        listaProdutos.add(produto);
                    }

                    // Notificar o listener que a lista foi atualizada
                    if (produtosListener != null) {
                        produtosListener.onRefreshListaProdutos(listaProdutos);
                    }

                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao carregar produtos: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, "Erro na API: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        volleyQueue.add(request);
    }

    public ArrayList<Produto> getProdutosBD() {
        return listaProdutos;
    }
}
