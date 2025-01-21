package com.example.castcompass.models;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;


import java.util.ArrayList;

public class FavoritoBDHelper extends SQLiteOpenHelper {

    private static final String DBNAME = "castcompass", TABLE_NAME = "favoritos";

    private static final int DB_VERSION = 1;

    private SQLiteDatabase db;

    private static final String ID = "id", IDPRODUTO = "idProduto", IDUTILIZADOR = "idUtilizador", NOME = "nome", MARCA = "marca", DESCRICAO = "descricao", PRECO = "preco", CATEGORIA = "categoria", IMAGEM = "imagem";

    public FavoritoBDHelper(Context context) {
        super(context, DBNAME, null, DB_VERSION);
        db = getWritableDatabase();
    }

    public ArrayList<Favoritos> getAllFavoritosBD() {
        ArrayList<Favoritos> favoritos = new ArrayList<>();

        Cursor cursor = db.query(TABLE_NAME, new String[]{ID, IDPRODUTO, IDUTILIZADOR, NOME, MARCA, DESCRICAO, CATEGORIA, IMAGEM, PRECO}, null, null, null, null, null);

        if (cursor.moveToFirst()) {
            do {
                Favoritos aux = new Favoritos(
                        cursor.getInt(0),    // ID
                        cursor.getInt(1),    // IDPRODUTO
                        cursor.getInt(2),    // IDUTILIZADOR
                        cursor.getString(3), // NOME
                        cursor.getString(4), // MARCA
                        cursor.getString(5), // DESCRICAO
                        cursor.getString(6), // CATEGORIA
                        cursor.getString(7), // IMAGEM
                        cursor.getFloat(8)  // PRECO
                );
                favoritos.add(aux);
            } while (cursor.moveToNext());
            cursor.close();
        }
        return favoritos;
    }

    public Favoritos adicionarFavoritoBD(Favoritos favorito) {
        ContentValues values = new ContentValues();
        values.put(IDUTILIZADOR, favorito.getIdUtilizador());
        values.put(IDPRODUTO, favorito.getIdProduto());
        values.put(NOME, favorito.getNomeProduto());
        values.put(MARCA, favorito.getMarcaProduto());
        values.put(DESCRICAO, favorito.getDescricaoProduto());
        values.put(CATEGORIA, favorito.getCategoriaProduto());
        values.put(IMAGEM, favorito.getImagemProduto());
        values.put(PRECO, favorito.getPrecoProduto());

        long id = db.insert(TABLE_NAME, null, values);
        //se o id=-1 significa que não inseriu registo
        if (id > -1) {
            favorito.setId((int) id);
            return favorito;
        }

        return null;
    }

    public boolean editarFavoritoBD(Favoritos favorito) {
        ContentValues values = new ContentValues();
        values.put(IDUTILIZADOR, favorito.getIdUtilizador());
        values.put(IDPRODUTO, favorito.getIdProduto());
        values.put(NOME, favorito.getNomeProduto());
        values.put(MARCA, favorito.getMarcaProduto());
        values.put(DESCRICAO, favorito.getDescricaoProduto());
        values.put(CATEGORIA, favorito.getCategoriaProduto());
        values.put(IMAGEM, favorito.getImagemProduto());
        values.put(PRECO, favorito.getPrecoProduto());

        int edit = this.db.update(TABLE_NAME, values, ID + "=?", new String[]{favorito.getId() + ""});
        return edit == 1;
    }

    public void removerFavoritoBD(int id) {
        int delete = this.db.delete(TABLE_NAME, ID + "=?", new String[]{id + ""});
    }

    public void removerAllFavoritosBD() {
        db.delete(TABLE_NAME, null, null);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String sql = "CREATE TABLE " + TABLE_NAME + "(" +
                ID + " INTEGER, " +
                IDPRODUTO + " INTEGER, " +
                IDUTILIZADOR + " INTEGER, " +
                NOME + " TEXT, " +
                MARCA + " TEXT, " +
                DESCRICAO + " TEXT, " +
                CATEGORIA + " TEXT," +
                IMAGEM + " TEXT," +
                PRECO + " REAL" +
                ")";

        db.execSQL(sql);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        String sql = "DROP TABLE IF EXISTS " + TABLE_NAME;
        db.execSQL(sql);
        onCreate(db);
    }
}
