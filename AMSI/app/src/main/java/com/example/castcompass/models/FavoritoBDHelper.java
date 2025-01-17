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

    private static final String IDPRODUTO = "idProduto", IDUTILIZADOR = "idUtilizador", NOME = "nome", MARCA = "marca", DESCRICAO = "descricao", PRECO = "preco", CATEGORIA = "categoria", IMAGEM = "imagem";

    public FavoritoBDHelper(Context context) {
        super(context, DBNAME, null, DB_VERSION);
        db = getWritableDatabase();
    }

    public void removerAllFavoritos(){
        db.delete(TABLE_NAME, null, null);
    }

    public ArrayList<Favoritos> getAllFavoritos(){
        ArrayList<Favoritos> favoritos = new ArrayList<>();

        Cursor cursor = db.query(TABLE_NAME, new String[]{IDPRODUTO, IDUTILIZADOR, NOME, MARCA, DESCRICAO, CATEGORIA, IMAGEM, PRECO}, null, null, null, null, null);

        if(cursor.moveToFirst()){
            do{
                Favoritos aux = new Favoritos(cursor.getInt(0), cursor.getInt(1), cursor.getString(2), cursor.getString(3), cursor.getString(4), cursor.getString(5), cursor.getString(6), cursor.getInt(7));
                favoritos.add(aux);
            }while(cursor.moveToNext());
            cursor.close();
        }

        return favoritos;
    }


    @Override
    public void onCreate(SQLiteDatabase db) {
        String sql = "CREATE TABLE " + TABLE_NAME + "(" +
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

    public void adicionarFavorito(Favoritos favorito){
        ContentValues values = new ContentValues();
        values.put(IDUTILIZADOR, favorito.getIdUtilizador());
        values.put(IDPRODUTO, favorito.getIdProduto());
        values.put(NOME, favorito.getNomeProduto());
        values.put(MARCA, favorito.getMarcaProduto());
        values.put(DESCRICAO, favorito.getDescricaoProduto());
        values.put(CATEGORIA, favorito.getCategoriaProduto());
        values.put(IMAGEM, favorito.getImagemProduto());
        values.put(PRECO, favorito.getPrecoProduto());
        db.insert(TABLE_NAME, null, values);
    }

}
