package com.example.castcompass.models;

// Imports from Android

import android.content.Context;
import android.content.SharedPreferences;
import android.util.Log;
import android.widget.Toast;

//
import androidx.annotation.Nullable;

import org.json.JSONArray;
import org.json.JSONObject;

// Imports from CastCompass
import com.android.volley.toolbox.JsonArrayRequest;
import com.example.castcompass.ListaFaturasFragment;
import com.example.castcompass.listeners.CarrinhoListener;
import com.example.castcompass.listeners.FaturasListener;
import com.example.castcompass.listeners.FavoritosListener;
import com.example.castcompass.listeners.LoginListener;
import com.example.castcompass.listeners.ProdutoListener;
import com.example.castcompass.listeners.ProdutosListener;
import com.example.castcompass.listeners.UtilizadorListener;
import com.example.castcompass.utils.CarrinhoItemsJsonParser;
import com.example.castcompass.utils.FaturasJsonParser;
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

    private ArrayList<Favoritos> favoritos;

    public FavoritoBDHelper favoritoBD = null;

    private ProdutosListener produtosListener;
    private ProdutoListener produtoListener;
    private UtilizadorListener utilizadorListener;
    private FavoritosListener favoritosListener;
    private CarrinhoListener carrinhoListener;
    private FaturasListener faturasListener;

    private Utilizador login;
    private static String urlApiLogin = "";
    private static String urlApiProdutos = "";
    private static String urlApiProduto = "";
    private static String urlApiUtilizador = "";
    private static String urlApiAtualizarUtilizador = "";
    private static String urlApiApagarUtilizador = "";
    private static String urlApiFaturas = "";
    private static String urlApiFavoritos = "";
    private static String urlApiFavoritosRemover = "";
    private static String urlApiFavoritosAdicionar = "";
    private static String urlApiCarrinho = "";

    public int ProdutoCount = 0;

    private ArrayList<Produto> listaProdutos;

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
        favoritoBD = new FavoritoBDHelper(context);
        listaProdutos = new ArrayList<>();
    }

    // MUDA IP
    public void MudarIP(String ip) {
        urlApiLogin = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/login/login";
        urlApiProdutos = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/produtos/all";
        urlApiUtilizador = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/profile/utilizador";
        urlApiAtualizarUtilizador = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/profile/atualizarutilizador";
        urlApiApagarUtilizador = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/profile/apagarutilizador";
        urlApiProduto = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/produtos/produto";
        urlApiFaturas = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/faturas/faturascliente";
        urlApiFavoritos = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/favoritos/profilefavoritos";
        urlApiFavoritosRemover = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/favoritos/remover";
        urlApiFavoritosAdicionar = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/favoritos/adicionar";
        urlApiCarrinho = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/carrinho/carrinho";
    }

    // region LISTENERS

    public void setLoginListener(LoginListener loginListener) {
        this.loginListener = loginListener;
    }

    public void setFavoritosListener(FavoritosListener favoritosListener) {
        this.favoritosListener = favoritosListener;
    }

    public void setProdutosListener(ProdutosListener produtosListener) {
        this.produtosListener = produtosListener;
    }

    public void setProdutoListener(ProdutoListener produtoListener) {
        this.produtoListener = produtoListener;
    }

    public void setUtilizadorListener(UtilizadorListener utilizadorListener) {
        this.utilizadorListener = utilizadorListener;
    }

    public void setCarrinhoListener(CarrinhoListener carrinhoListener) {
        this.carrinhoListener = carrinhoListener;
    }

    public void setFaturasListener(FaturasListener faturasListener) {
        this.faturasListener = faturasListener;
    }
    // endregion

    // API

    // region Login
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

                        if (loginListener != null) {
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

    public void logoutAPI(final Context context) {
        SharedPreferences sp = context.getSharedPreferences("DADOS_USER", Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sp.edit();
        editor.clear();
        editor.apply();
    }
    // endregion

    // region Produtos
    public void getAllProdutosAPI(final Context context) {
        StringRequest request = new StringRequest(Request.Method.GET, urlApiProdutos, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    // Parse do JSON retornado pela API
                    JSONArray jsonArray = new JSONArray(response);

                    ArrayList<Produto> produto = ProdutosJsonParser.parserJsonProdutos(jsonArray, context);

                    ProdutoCount = produto.size();

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
    // endregion

    // region Utilizador
    public void getUtilizadorAPI(final Context context) {
        StringRequest request = new StringRequest(Request.Method.GET, urlApiUtilizador + "?id=" + login.idProfile + "&token=" + login.getToken(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    Utilizador utilizador = UtilizadorJsonParser.parserJsonUtilizador(response);

                    Log.d("RESPONSE", "Response: " + response);
                    // Notificar o listener que a lista foi atualizada
                    if (utilizadorListener != null) {
                        utilizadorListener.onRefreshUtilziador(utilizador);
                    }

                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao carregar o utilizador: " + e.getMessage(), Toast.LENGTH_LONG).show();
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

    public void atualizarUtilizadorAPI(final Context context, final String nome, final String telemovel, final String morada, final String nif) {
        StringRequest request = new StringRequest(Request.Method.POST, urlApiAtualizarUtilizador + "?id=" + login.idProfile + "&token=" + login.getToken(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    Toast.makeText(context, "Utilizador atualizado com sucesso", Toast.LENGTH_LONG).show();
                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao atualizar o utilizador: " + e.getMessage(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, "Erro na API: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        }) {
            @Nullable
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("nome", nome);
                params.put("nif", nif);
                params.put("morada", morada);
                params.put("telemovel", telemovel);

                return params;
            }
        };
        volleyQueue.add(request);
    }

    public void apagarUtilizadorAPI(final Context context) {
        StringRequest request = new StringRequest(Request.Method.DELETE, urlApiApagarUtilizador + "?id=" + login.idProfile + "&token=" + login.getToken(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    Toast.makeText(context, "Utilizador apagado com sucesso", Toast.LENGTH_LONG).show();

                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao apagar o utilizador: " + e.getMessage(), Toast.LENGTH_LONG).show();
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
    // endregion

    //region BD Favoritos
    public Favoritos getFavorito(int id) {
        for (Favoritos favorito : favoritos) {
            if (favorito.getId() == id) {
                return favorito;
            }
        }
        return null;
    }

    public ArrayList<Favoritos> getFavoritosBD() {
        favoritos = favoritoBD.getAllFavoritosBD();
        return new ArrayList<>(favoritos);
    }

    public void adicionarFavoritoBD(Favoritos favorito) {
        favoritoBD.adicionarFavoritoBD(favorito);
    }

    public void removerFavoritoBD(int id) {
        Favoritos favorito = getFavorito(id);
        if (favorito != null) {
            favoritoBD.removerFavoritoBD(id);
        }
    }

    public void adicionarFavoritosBD(ArrayList<Favoritos> favoritos) {
        favoritoBD.removerAllFavoritosBD();
        for (Favoritos favorito : favoritos) {
            adicionarFavoritoBD(favorito);
        }
    }
    //endregion

    // region Favoritos
    public void getAllFavoritosAPI(final Context context) {
        if (!util.isConnected(context)) {
            Toast.makeText(context, "Sem ligação à internet", Toast.LENGTH_LONG).show();

            favoritos = getFavoritosBD();

            if (favoritosListener != null) {
                favoritosListener.onRefreshFavoritos(favoritos);
            }

        } else {
            // ArrayList<Favoritos> favoritos = null;
            SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
            int id = sp.getInt("idProfile", login.idProfile);
            JsonArrayRequest reqSelect = new JsonArrayRequest(Request.Method.GET, urlApiFavoritos + "?profileID=" + id + "&token=" + login.token, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    favoritos = FavoritosJsonParser.parserJsonFavoritos(response);
                    //só para o modo offline
                    adicionarFavoritosBD(favoritos);

                    //TODO: atualizar a vista
                    if (favoritosListener != null) {
                        favoritosListener.onRefreshFavoritos(favoritos);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "Erro na API: " + error.getMessage(), Toast.LENGTH_SHORT).show();
                }
            });

            volleyQueue.add(reqSelect);
        }

    }

    public void adicionarFavoritoAPI(final Context context, final long produtoID) {
        // ArrayList<Favoritos> favoritos = null;
        SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
        int id = sp.getInt("idProfile", login.idProfile);
        StringRequest request = new StringRequest(Request.Method.POST, urlApiFavoritosAdicionar + "?profileID=" + id + "&produtoID=" + produtoID + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
//                Favoritos favorito = FavoritosJsonParser.parserJsonFavorito(response);
//                adicionarFavoritoBD(favorito);

                if (favoritosListener != null) {
                    favoritosListener.onRefreshFavoritos(favoritos);
                }
                Toast.makeText(context, "Produto adicionado com sucesso", Toast.LENGTH_SHORT).show();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, "Erro na API: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        volleyQueue.add(request);
    }

    public void removerFavoritoAPI(final Context context, final long produtoID) {
        // ArrayList<Favoritos> favoritos = null;
        SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
        int id = sp.getInt("idProfile", login.idProfile);
        StringRequest request = new StringRequest(Request.Method.DELETE, urlApiFavoritosRemover + "?profileID=" + id + "&produtoID=" + produtoID + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    removerFavoritoBD((int) produtoID);
                    Toast.makeText(context, "Produto removido com sucesso", Toast.LENGTH_SHORT).show();
                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao remover produto: " + e.getMessage(), Toast.LENGTH_SHORT).show();
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
    // endregion

    //region Faturas
    public void getAllFaturasAPI(final Context context) {
        JsonArrayRequest reqSelect = new JsonArrayRequest(Request.Method.GET, urlApiFaturas + "?id=" + login.idProfile + "&token=" + login.token, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                try {
                    ArrayList<Faturas> faturas = FaturasJsonParser.parserJsonFaturas(response);

                    if (faturasListener != null) {
                        faturasListener.onRefreshFaturas(faturas);
                    }
                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao carregar faturas: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, "Erro na API: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    //endregion

    // region Carrinho
    public void getCarrinhoAPI(final Context context) {
        // ArrayList<Favoritos> favoritos = null;
        SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
        int id = sp.getInt("idProfile", login.idProfile);
        StringRequest request = new StringRequest(Request.Method.GET, urlApiCarrinho + "?profileID=" + id + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONArray json = new JSONArray(response);

                    ArrayList<CarrinhoItems> carrinho = CarrinhoItemsJsonParser.parserJsonCarrinho(json);

                    // Notificar o listener que a lista foi atualizada
                    if (carrinhoListener != null) {
//                        carrinhoListener.onRefreshCarrinho(carrinho);
                    }

                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao carregar carrinho: " + e.getMessage(), Toast.LENGTH_SHORT).show();
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
    // endregion
}
