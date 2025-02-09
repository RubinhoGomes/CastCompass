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
import com.example.castcompass.models.CarrinhoItems;
import com.example.castcompass.models.Singleton;

import java.util.ArrayList;

public class ListaCarrinhoAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<CarrinhoItems> items;

    @Override
    public int getCount() {
        return items.size();
    }

    @Override
    public Object getItem(int position) {
        return items.get(position);
    }

    @Override
    public long getItemId(int position) {
        return items.get(position).getId();
    }

    public ListaCarrinhoAdaptador(Context context, ArrayList<CarrinhoItems> items) {
        this.context = context;
        this.items = items;
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        if (inflater == null) {
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if (view == null) {
            view = inflater.inflate(R.layout.item_lista_carrinho_item, null); // Alterado para layout de produto
        }

        ListaCarrinhoAdaptador.ViewHolderLista viewHolder = (ListaCarrinhoAdaptador.ViewHolderLista) view.getTag();

        if (viewHolder == null) {
            viewHolder = new ListaCarrinhoAdaptador.ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(items.get(position));

        return view;
    }

    private class ViewHolderLista {
        private TextView tvNome, tvQuantidade, tvPreco;
        private ImageView imgCapa;

        public ViewHolderLista(View view) {
            tvNome = view.findViewById(R.id.tvNome);
            tvPreco = view.findViewById(R.id.tvPreco);
            tvQuantidade = view.findViewById(R.id.tvQuantidade);
            imgCapa = view.findViewById(R.id.imgCapa);
        }

        public void update(CarrinhoItems items) {
            tvNome.setText(items.getNome());
            tvQuantidade.setText(items.getQuantidade());
            tvPreco.setText(String.format("%.2f€", items.getValortotal()));

            Glide.with(context)
                    .load(items.getImagem())
                    .placeholder(R.drawable.logo)
                    .diskCacheStrategy(DiskCacheStrategy.ALL)
                    .into(imgCapa);
        }
    }
}
