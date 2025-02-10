package com.example.castcompass.models;

// Imports from Android

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.util.Log;
import android.widget.Toast;

//
import androidx.annotation.Nullable;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

// Imports from CastCompass
import com.android.volley.toolbox.JsonArrayRequest;
import com.example.castcompass.IpServidorActivity;
import com.example.castcompass.listeners.CarrinhoFinalListener;
import com.example.castcompass.listeners.CarrinhoListener;
import com.example.castcompass.listeners.FaturasListener;
import com.example.castcompass.listeners.FavoritosListener;
import com.example.castcompass.listeners.LoginListener;
import com.example.castcompass.listeners.MetodoExpedicaoListener;
import com.example.castcompass.listeners.MetodoPagamentoListener;
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
import java.util.Collections;
import java.util.HashMap;
import java.util.Map;

public class Singleton {

    // VARIABLES

    private static Singleton instance = null;
    private static RequestQueue volleyQueue;
    private LoginListener loginListener;

    private ArrayList<Favoritos> favoritos;
    private ArrayList<Faturas> faturas;
    public ArrayList<CarrinhoItems> carrinho;

    public FavoritoBDHelper favoritoBD = null;

    private ProdutosListener produtosListener;
    private ProdutoListener produtoListener;
    private UtilizadorListener utilizadorListener;
    private FavoritosListener favoritosListener;
    private CarrinhoListener carrinhoListener;
    private FaturasListener faturasListener;
    private CarrinhoFinalListener carrinhoFinalListener;
    private MetodoPagamentoListener metodoPagamentoListener;
    private MetodoExpedicaoListener metodoExpedicaoListener;

    public float total = 0;

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
    private static String urlApiAdicionarItemCarrinho = "";
    private static String urlApiAumentarQuantidade = "";
    private static String urlApiDiminuirQuantidade = "";
    private static String urlApiCompraFinal = "";
    private static String urlApiApagarItemCarrinho = "";
    private static String urlApiMetodosExpedicao = "";
    private static String urlApiMetodosPagamento = "";

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

    // region IP
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
        urlApiAdicionarItemCarrinho = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/carrinho/addproduto";
        urlApiAumentarQuantidade = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/carrinho/aumentarquantidade";
        urlApiDiminuirQuantidade = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/carrinho/diminuirquantidade";
        urlApiCompraFinal = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/fatura/comprafinal";
        urlApiApagarItemCarrinho = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/carrinho/removerproduto";
        urlApiMetodosExpedicao = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/metodoexpedicao/metodosexpedicao";
        urlApiMetodosPagamento = "http://" + ip + "/CastCompass/PLSI/CastCompass/backend/web/api/metodopagamento/metodospagamento";
    }
    // endregion

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

    public void setCarrinhoFinalListener(CarrinhoFinalListener carrinhoFinalListener) {
        this.carrinhoFinalListener = carrinhoFinalListener;
    }

    public void setMetodoPagamentoListener(MetodoPagamentoListener metodoPagamentoListener) {
        this.metodoPagamentoListener = metodoPagamentoListener;
    }

    public void setMetodoExpedicaoListener(MetodoExpedicaoListener metodoExpedicaoListener) {
        this.metodoExpedicaoListener = metodoExpedicaoListener;
    }
    // endregion

    //region API

    // region Login
    public void loginAPI(final String username, final String password, final Context context) {
        if (verificaconexao(context)){
            return;
        }
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

    public void logoutAPI(final Context context) {
        if (verificaconexao(context)){
            return;
        }
        SharedPreferences sp = context.getSharedPreferences("DADOS_USER", Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sp.edit();
        editor.clear();
        editor.apply();
        favoritoBD.removerAllFavoritosBD();
    }
    // endregion

    // region Produtos
    public void getAllProdutosAPI(final Context context) {
        if (verificaconexao(context)) {
            return;
        }
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
        if (verificaconexao(context)) {
            return null;
        }
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
        if (verificaconexao(context)) {
            return;
        }
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
        if (verificaconexao(context)) {
            return;
        }
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
        if (verificaconexao(context)) {
            return;
        }
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

                    if (favoritosListener != null) {
                        favoritosListener.onRefreshFavoritos(favoritos);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "Não tem favoritos", Toast.LENGTH_SHORT).show();
                }
            });

            volleyQueue.add(reqSelect);
        }

    }

    public void adicionarFavoritoAPI(final Context context, final long produtoID) {
        if (verificaconexao(context)) {
            return;
        }
        // ArrayList<Favoritos> favoritos = null;
        SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
        int id = sp.getInt("idProfile", login.idProfile);
        StringRequest request = new StringRequest(Request.Method.POST, urlApiFavoritosAdicionar + "?profileID=" + id + "&produtoID=" + produtoID + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
//                Favoritos favorito = FavoritosJsonParser.parserJsonFavorito(response);
//                adicionarFavoritoBD(favorito);

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
        if (verificaconexao(context)) {
            return;
        }
        // ArrayList<Favoritos> favoritos = null;
        SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
        int id = sp.getInt("idProfile", login.idProfile);
        StringRequest request = new StringRequest(Request.Method.DELETE, urlApiFavoritosRemover + "?profileID=" + id + "&produtoID=" + produtoID + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
//                    removerFavoritoBD((int) produtoID);
                    Toast.makeText(context, "Produto removido com sucesso", Toast.LENGTH_SHORT).show();

                    if (favoritosListener != null) {
                        favoritosListener.onRefreshFavoritos(favoritos);
                    }

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
        if (verificaconexao(context)) {
            return;
        }
        JsonArrayRequest reqSelect = new JsonArrayRequest(Request.Method.GET, urlApiFaturas + "?id=" + login.idProfile + "&token=" + login.token, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                try {
                    faturas = FaturasJsonParser.parserJsonFaturas(response);

                    Collections.reverse(faturas);

                    if (faturasListener != null) {
                        faturasListener.onRefreshFaturas(faturas);
                    }

                } catch (Exception e) {
                    Toast.makeText(context, "Não tem faturas", Toast.LENGTH_SHORT).show();
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
    //endregion

    // region Carrinho
    public void getCarrinhoAPI(final Context context) {
        if (verificaconexao(context)) {
            return;
        }
        SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
        int id = sp.getInt("idProfile", login.idProfile);
        StringRequest request = new StringRequest(Request.Method.GET, urlApiCarrinho + "?profileID=" + id + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);

                    JSONArray jsonItems = jsonObject.getJSONArray("items");

                    ArrayList<CarrinhoItems> carrinho = CarrinhoItemsJsonParser.parserJsonCarrinho(jsonItems);

                    // Notificar o listener que a lista foi atualizada
                    if (carrinhoListener != null) {
                        carrinhoListener.onRefreshCarrinho(carrinho);
                    }

                } catch (Exception e) {
                    Toast.makeText(context, "Não tem items no carrinho", Toast.LENGTH_SHORT).show();
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

    public void adicionarItemCarrinhoAPI(final Context context, final int idProduto) {
        if (verificaconexao(context)) {
            return;
        }
        SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
        int idProfile = sp.getInt("idProfile", login.idProfile);
        StringRequest request = new StringRequest(Request.Method.POST, urlApiAdicionarItemCarrinho + "?profileID=" + idProfile + "&produtoID=" + idProduto + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    Toast.makeText(context, "Item adicionado com sucesso", Toast.LENGTH_SHORT).show();
                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao adicionar item ao carrinho: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                    Log.e("ERRO", "Erro: " + e.getMessage());
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

    public void eliminarItemCarrinhoAPI(final Context context, final int id) {
        if (verificaconexao(context)) {
            return;
        }
        SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
        int idProfile = sp.getInt("idProfile", login.idProfile);
        StringRequest request = new StringRequest(Request.Method.DELETE, urlApiApagarItemCarrinho + "?profileID=" + idProfile + "&produtoID=" + id + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    Toast.makeText(context, "Item removido com sucesso", Toast.LENGTH_SHORT).show();

                    if (carrinhoListener != null) {
                        carrinhoListener.onRefreshCarrinho(carrinho);
                    }

                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao remover item do carrinho: " + e.getMessage(), Toast.LENGTH_SHORT).show();
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

    public void aumentarQuantidadeAPI(final Context context, final int id) {
        if (verificaconexao(context)) {
            return;
        }
        StringRequest request = new StringRequest(Request.Method.GET, urlApiAumentarQuantidade + "?id=" + id + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    Toast.makeText(context, "Quantidade adicionada", Toast.LENGTH_SHORT).show();
                    getCarrinhoAPI(context);
                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao aumentar quantidade do item do carrinho: " + e.getMessage(), Toast.LENGTH_SHORT).show();
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

    public void diminuirQuantidadeAPI(final Context context, final int id) {
        if (verificaconexao(context)) {
            return;
        }
        StringRequest request = new StringRequest(Request.Method.GET, urlApiDiminuirQuantidade + "?id=" + id + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    Toast.makeText(context, "Quantidade diminuida", Toast.LENGTH_SHORT).show();
                    getCarrinhoAPI(context);
                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao diminuir quantidade do item do carrinho: " + e.getMessage(), Toast.LENGTH_SHORT).show();
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

    public void getCarrinhoFinalAPI(final Context context) {
        if (verificaconexao(context)) {
            return;
        }
        SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
        int id = sp.getInt("idProfile", login.idProfile);
        StringRequest request = new StringRequest(Request.Method.GET, urlApiCarrinho + "?profileID=" + id + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    Log.d("DEBUG", "Resposta bruta da API: " + response);

                    JSONObject jsonObject = new JSONObject(response);

                    int carrinhoID = jsonObject.getInt("id");
                    String totalCarrinho = jsonObject.getString("valorTotal");

                    SharedPreferences sp = context.getSharedPreferences("DADOSUSER", Context.MODE_PRIVATE);
                    SharedPreferences.Editor editor = sp.edit();
                    editor.putInt("carrinhoid", carrinhoID);
                    editor.apply();

                    // Notificar o listener que o carrinho foi carregado
                    if (carrinhoFinalListener != null) {
                        carrinhoFinalListener.onCarrinhoLoaded(totalCarrinho, carrinhoID);
                    }

                } catch (JSONException e) {
                    Log.e("DEBUG", "Erro ao processar JSON: " + e.getMessage());
                    Toast.makeText(context, "Erro ao carregar carrinho", Toast.LENGTH_SHORT).show();
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

    public void comprarCarrinhoAPI(final Context context, final int carrinhoID, final int metodoExpedicaoID, final int metodoPagamentoID) {
        if (verificaconexao(context)) {
            return;
        }
        StringRequest request = new StringRequest(Request.Method.POST, urlApiCompraFinal + "?carrinhoID=" + carrinhoID + "&metodoExpedicaoID="
                + metodoExpedicaoID + "&metodoPagamentoID=" + metodoPagamentoID + "&token=" + login.token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    Toast.makeText(context, "Compra efetuada com sucesso", Toast.LENGTH_SHORT).show();
                } catch (Exception e) {
                    Toast.makeText(context, "Erro ao comprar carrinho: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                    Log.e("ERRO", "Erro: " + e.getMessage());
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

    public void getMetodosExpedicaoAPI(final Context context) {
        if (verificaconexao(context)) {
            return;
        }
        JsonArrayRequest reqSelect = new JsonArrayRequest(Request.Method.GET, urlApiMetodosExpedicao, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                try {
                    ArrayList<MetodoExpedicao> metodosExped = new ArrayList<>();

                    for (int i = 0; i < response.length(); i++) {
                        JSONObject jsonObject = response.getJSONObject(i);
                        MetodoExpedicao metodoExpedicao = new MetodoExpedicao(jsonObject.getInt("id"), jsonObject.getString("nome"));
                        metodosExped.add(metodoExpedicao);
                    }

                    if (metodoExpedicaoListener != null) {
                        metodoExpedicaoListener.onMetodoExpedicaoCarregado(metodosExped);
                    }
                } catch (JSONException e) {
                    Toast.makeText(context, "Erro ao carregar métodos de expedição: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, "Erro ao obter métodos de pagamento: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        volleyQueue.add(reqSelect);
    }

    public void getMetodosPagamentoAPI(final Context context) {
        if (verificaconexao(context)) {
            return;
        }
        JsonArrayRequest reqSelect = new JsonArrayRequest(Request.Method.GET, urlApiMetodosPagamento, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                try {
                    ArrayList<MetodoPagamento> metodosPag = new ArrayList<>();

                    for (int i = 0; i < response.length(); i++) {
                        JSONObject jsonObject = response.getJSONObject(i);
                        MetodoPagamento metodosPagamento = new MetodoPagamento(jsonObject.getInt("id"), jsonObject.getString("nome"), jsonObject.getString("tipo"));
                        metodosPag.add(metodosPagamento);
                    }

                    if (metodoPagamentoListener != null) {
                        metodoPagamentoListener.onMetodoPagamentoCarregado(metodosPag);
                    }
                } catch (JSONException e) {
                    Toast.makeText(context, "Erro ao carregar métodos de pagamento: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, "Erro ao obter métodos de pagamento: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        volleyQueue.add(reqSelect);
    }
    // endregion
    // endregion

    // region Verifica conexao para segurança
    public boolean verificaconexao(final Context context) {
        if (!util.isConnected(context)) {
            Toast.makeText(context, "Sem conexão à internet", Toast.LENGTH_SHORT).show();
            Intent intent = new Intent(context, IpServidorActivity.class);
            context.startActivity(intent);
            return true;
        }
        return false;
    }
    // endregion
}