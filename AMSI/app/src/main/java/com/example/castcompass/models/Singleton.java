package com.example.castcompass.models;

// Imports from Android

import android.content.Context;
import android.widget.Toast;

//
import org.json.JSONArray;
import org.json.JSONObject;

// Imports from CastCompass
import com.example.castcompass.listeners.LoginListener;
import com.example.castcompass.listeners.ProdutoListener;
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
    private ProdutoListener produtoListener;

    private Utilizador login;
    private static String urlApiLogin = "http://172.22.21.205/CastCompass/PLSI/CastCompass/backend/web/api/login/login";
    private static String urlApiProdutos = "http://172.22.21.205/CastCompass/PLSI/CastCompass/backend/web/api/produtos";
    private static String UrlApiProduto = "http://172.22.21.205/CastCompass/PLSI/CastCompass/backend/web/api/produtos/";
    private ArrayList<Produto> listaProdutos;


    public void setProdutosListener(ProdutosListener produtosListener) {
        this.produtosListener = produtosListener;
    }

    public void setProdutoListener(ProdutoListener produtoListener) {
        this.produtoListener = produtoListener;
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

                        login = LoginJsonParser.loginJsonParser(response);

                        // SharedPreferences.Editor editor = context.getSharedPreferences("pref", Context.MODE_PRIVATE).edit();
                        // editor.putString("token", jsonObject.getString("token"));
                        // editor.apply();

                        if(loginListener != null) {
                            loginListener.onUpdateLogin(login);
                        }

                        Toast.makeText(context, "Login efetuado com sucesso com o", Toast.LENGTH_SHORT).show();
                        Toast.makeText(context, "Token: " + login.getToken(), Toast.LENGTH_SHORT).show();
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
                    //params.put("username", username);
                    //params.put("password", password);
                    return params;
                }
                @Override
                public Map<String, String> getHeaders() {
                    Map<String, String> headers = new HashMap<>();
                    String credentials = username + ":" + password;
                    String auth = "Basic " + android.util.Base64.encodeToString(credentials.getBytes(), android.util.Base64.NO_WRAP);
                    headers.put("Authorization", auth);
                    return headers;
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

                    ArrayList<Produto> produto = ProdutosJsonParser.parserJsonProdutos(jsonArray, context);

                    // Notificar o listener que a lista foi atualizada
                    if (produtosListener != null) {
                        produtosListener.onRefreshListaProdutos(produto);
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

    public Produto getProdutoAPI(final Context context, int id) {
        Produto produto = null;
        StringRequest request = new StringRequest(Request.Method.GET, UrlApiProduto + id, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    Produto produto = ProdutosJsonParser.parserJsonProduto(response);

                    // Notificar o listener que a lista foi atualizada
                    if (produtoListener != null) {
                        produtoListener.onRefreshProduto(produto);
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
        return produto;
    }

    public ArrayList<Produto> getProdutosBD() {
        return listaProdutos;
    }
}
