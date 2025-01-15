package com.example.castcompass.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;

import com.example.castcompass.R;
import com.example.castcompass.models.Produto;

import java.time.Instant;
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
        if (inflater == null) {
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if (view == null) {
            view = inflater.inflate(R.layout.item_lista_produto, null); // Alterado para layout de produto
        }


        ViewHolderLista viewHolder = (ViewHolderLista) view.getTag();
        if (viewHolder == null) {
            viewHolder = new ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(produtos.get(position));
        return view;
    }


    private class ViewHolderLista {
        private TextView tvNome, tvMarca, tvPreco, tvDescricao, tvCategoria;
        private ImageView imgCapa;

        public ViewHolderLista(View view) {
            tvNome = view.findViewById(R.id.tvNome);
            tvMarca = view.findViewById(R.id.tvMarca);
            tvPreco = view.findViewById(R.id.tvPreco);
//            tvDescricao = view.findViewById(R.id.tvDescricao);
            tvCategoria = view.findViewById(R.id.tvCategoria);
            imgCapa = view.findViewById(R.id.imgCapa);
        }

        public void update(Produto produto) {
            tvNome.setText(produto.getNome());
            tvMarca.setText(produto.getMarca());
            tvPreco.setText(String.format("€ %.2f", produto.getPreco())); // Formatação de preço
//            tvDescricao.setText(produto.getDescricao());
            tvCategoria.setText("" + produto.getCategoriaID());

            // Carrega a imagem usando Glide
            Glide.with(context)
                    .load(produto.getImg())
                    .placeholder(R.drawable.logo)
                    //guardar em cache todas as imagens
                    .diskCacheStrategy(DiskCacheStrategy.ALL)
                    .into(imgCapa);
        }



    }
}
