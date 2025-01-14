package com.example.castcompass.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;

import com.example.castcompass.models.Produto;

import java.util.ArrayList;

public class ListaProdutosAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Produto> produtos;

    public ListaProdutosAdaptador(Context context, ArrayList<Produto> produtos) {
        this.context = context;
        this.produtos = produtos;
    }

    @Override
    public int getCount() {
        return produtos.size();
    }

    @Override
    public Object getItem(int i) {
        return produtos.get(i);
    }

    @Override
    public long getItemId(int i) {
        return produtos.get(i).getId();
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        return null;
    }
}
