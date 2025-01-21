package com.example.castcompass.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.example.castcompass.R;
import com.example.castcompass.models.Favoritos;
import com.example.castcompass.models.Singleton;

import java.util.ArrayList;

public class FavoritosAdaptador extends BaseAdapter {
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Favoritos> favoritos;


    public FavoritosAdaptador(Context context, ArrayList<Favoritos> favoritos) {
        this.context = context;
        this.favoritos = favoritos;
    }

    @Override
    public int getCount() {
        return favoritos.size();
    }

    @Override
    public Object getItem(int i) {
        return favoritos.get(i);
    }

    @Override
    public long getItemId(int i) {
        return favoritos.get(i).getIdProduto();
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        if (inflater == null) {
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if (view == null) {
            view = inflater.inflate(R.layout.item_lista_favoritos, null);
        }
        FavoritosAdaptador.ViewHolderLista viewHolder = (FavoritosAdaptador.ViewHolderLista) view.getTag();
        if (viewHolder == null) {
            viewHolder = new FavoritosAdaptador.ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(favoritos.get(position));

        Button btnRemover = view.findViewById(R.id.btnRemoverFav);
        btnRemover.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Remove o favorito ao clicar no botão
                Favoritos favorito = favoritos.get(position);
                Singleton.getInstance(context).removerFavoritoAPI(context, favorito.getIdProduto());
                Singleton.getInstance(context).getAllFavoritosAPI(context);
            }
        });
        return view;
    }

    private class ViewHolderLista {
        private TextView tvNome, tvMarca, tvCategoria, tvPreco;
        private ImageView imgCapa;

        public ViewHolderLista(View view) {

            tvNome = view.findViewById(R.id.tvNome);
            tvMarca = view.findViewById(R.id.tvMarca);
            tvPreco = view.findViewById(R.id.tvPreco);
            tvCategoria = view.findViewById(R.id.tvCategoria);
            imgCapa = view.findViewById(R.id.imgCapa);
        }

        //invoca 1 vez por cada linha da lista
        public void update(Favoritos favoritos) {
            tvNome.setText(favoritos.getNomeProduto());
            tvMarca.setText(favoritos.getMarcaProduto());
            tvPreco.setText(favoritos.getPrecoProduto() + "");
            tvCategoria.setText(favoritos.getCategoriaProduto());
            Glide.with(context)
                    .load(favoritos.getImagemProduto())
                    .placeholder(R.drawable.logo)
                    .diskCacheStrategy(DiskCacheStrategy.ALL)
                    .into(imgCapa);
        }
    }
}