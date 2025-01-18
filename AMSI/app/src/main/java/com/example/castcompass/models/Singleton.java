package com.example.castcompass.models;

// Imports from Android

import android.content.Context;
import android.content.SharedPreferences;
import android.util.Log;
import android.widget.Toast;

//
import org.json.JSONArray;
import org.json.JSONObject;

// Imports from CastCompass
import com.example.castcompass.listeners.FavoritosListener;
import com.example.castcompass.listeners.LoginListener;
import com.example.castcompass.listeners.ProdutoListener;
import com.example.castcompass.listeners.ProdutosListener;
import com.example.castcompass.listeners.UtilizadorListener;
import com.example.castcompass.utils.FavoritosJsonParser;
import com.example.castcompass.utils.LoginJsonParser;
import com.example.castcompass.utils.UtilizadorJsonParser;
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

    public FavoritoBDHelper favoritoBD;

    private ProdutosListener produtosListener;
    private ProdutoListener produtoListener;
    private UtilizadorListener utilizadorListener;
    private FavoritosListener favoritosListener;

    private Utilizador login;
    private static String urlApiLogin = "";
    private static String urlApiProdutos = "";
    private static String urlApiProduto = "";
    private static String urlApiUtilizador = "";
    private static String urlApiFavoritos = "";

    private ArrayList<Produto> listaProdutos;


    public void setProdutosListener(ProdutosListener produtosListener) {
        this.produtosListener = produtosListener;
    }

    public void setProdutoListener(ProdutoListener produtoListener) {
        this.produtoListener = produtoListener;
    }

    public void setUtilizadorListener(UtilizadorListener utiliziadorListener) {
        this.utilizadorListener = utiliziadorListener;
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

    // MUDA IP
    public void MudarIP(String ip) {
        urlApiLogin = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/login/login";
        urlApiProdutos = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/produtos/all";
        urlApiUtilizador = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/profile/utilizador";
        urlApiProduto = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/produtos/produto";
        urlApiFavoritos = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/favoritos/profilefavoritos";
    }

    // LISTENERS

    public void setLoginListener(LoginListener loginListener) {
        this.loginListener = loginListener;
    }

    public void setFavoritosListener(FavoritosListener favoritosListener){
        this.favoritosListener = favoritosListener;
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

                        SharedPreferences.Editor editor = context.getSharedPreferences("DADOS_USER", Context.MODE_PRIVATE).edit();
                        editor.putString("token", jsonObject.getString("token"));
                        editor.putString("idProfile", jsonObject.getString("idProfile"));
                        editor.putInt("id", jsonObject.getInt("id"));
                        editor.apply();

                        if(loginListener != null) {
                            loginListener.onUpdateLogin(login);
                        }

//                        Toast.makeText(context, "Login efetuado com sucesso com o " + login.username, Toast.LENGTH_SHORT).show();
//                        Toast.makeText(context, "Token: " + login.getToken(), Toast.LENGTH_SHORT).show();
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
        StringRequest request = new StringRequest(Request.Method.GET, urlApiProduto + "?id=" + id, new Response.Listener<String>() {
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

    public Utilizador getUtilizadorAPI(final Context context) {
        Utilizador utilizador = null;
        StringRequest request = new StringRequest(Request.Method.GET, urlApiUtilizador + "?id=" + login.idProfile + "&token=" + login.getToken(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    Utilizador utilizador = UtilizadorJsonParser.parserJsonUtilizador(response);

                    // Notificar o listener que a lista foi atualizada
                    if (utilizadorListener != null) {
                        utilizadorListener.onRefreshUtilziador(utilizador);
                    }

                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao carregar o utilizador: " + e.getMessage(), Toast.LENGTH_LONG).show();
                    Log.e("Singleton", "Erro ao carregar o utilizador: " + e.getMessage());
                    Log.d("API_RESPONSE", "Resposta da API: " + response);
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, "Erro na API: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        volleyQueue.add(request);
        return utilizador;
    }

    public void getAllFavoritosAPI(final Context context) {
       // ArrayList<Favoritos> favoritos = null;
        SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
        int id = sp.getInt("idProfile", login.idProfile);
        StringRequest request = new StringRequest(Request.Method.GET, urlApiFavoritos + "?profileID=" + id + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {

                    JSONArray jsonArray = new JSONArray(response);

                    ArrayList<Favoritos> favoritos = FavoritosJsonParser.parserJsonFavoritos(jsonArray);

                    // Notificar o listener que a lista foi atualizada
                    if (favoritosListener != null) {
                        favoritosListener.onRefreshFavoritos(favoritos);
                    }

                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao carregar favoritos: " + e.getMessage(), Toast.LENGTH_SHORT).show();
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
