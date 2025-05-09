package com.example.castcompass.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.example.castcompass.R;
import com.example.castcompass.models.CarrinhoItems;
import com.example.castcompass.models.Singleton;

import java.util.ArrayList;

public class ListaCarrinhoitemsAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<CarrinhoItems> carrinhoItems;
    private float valorUnico;


    public ListaCarrinhoitemsAdaptador(Context context, ArrayList<CarrinhoItems> carrinhoItems) {
        this.context = context;
        this.carrinhoItems = carrinhoItems;
    }

    @Override
    public int getCount() {
        return carrinhoItems.size();
    }

    @Override
    public Object getItem(int i) {
        return carrinhoItems.get(i);
    }

    @Override
    public long getItemId(int i) {
        return carrinhoItems.get(i).getCarrinhoID();
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        if (inflater == null) {
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if (view == null) {
            view = inflater.inflate(R.layout.item_lista_carrinho_item, null);
        }

        ListaCarrinhoitemsAdaptador.ViewHolderLista viewHolder = (ListaCarrinhoitemsAdaptador.ViewHolderLista) view.getTag();
        if (viewHolder == null) {
            viewHolder = new ListaCarrinhoitemsAdaptador.ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(carrinhoItems.get(position));

        Button btnEliminar = view.findViewById(R.id.btnEliminar);
        btnEliminar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Singleton.getInstance(context).eliminarItemCarrinhoAPI(context, carrinhoItems.get(position).getCarrinhoID());
                carrinhoItems.remove(position);
                notifyDataSetChanged();
            }
        });

        Button btnAumentar = view.findViewById(R.id.btnAumentar);
        btnAumentar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Singleton.getInstance(context).aumentarQuantidadeAPI(context, carrinhoItems.get(position).getId());
            }
        });

        Button btnDiminuir = view.findViewById(R.id.btnDiminuir);
        btnDiminuir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (carrinhoItems.get(position).getQuantidade() > 1) {
                    Singleton.getInstance(context).diminuirQuantidadeAPI(context, carrinhoItems.get(position).getId());
                } else {
                    showToast("A quantidade não pode ser menos que 1");
                }
            }
        });

        return view;
    }

    private void showToast(String message) {
        Toast.makeText(context.getApplicationContext(), message, Toast.LENGTH_SHORT).show();
    }

    private class ViewHolderLista {
        private TextView tvNome, tvPreco, tvQuantidade;
        private ImageView ivImagem;

        public ViewHolderLista(View view) {
            tvNome = view.findViewById(R.id.tvNome);
            tvPreco = view.findViewById(R.id.tvPreco);
            tvQuantidade = view.findViewById(R.id.tvQuantidade);
            ivImagem = view.findViewById(R.id.imgCapa);
        }

        public void update(CarrinhoItems carrinhoItems) {
            tvNome.setText(carrinhoItems.getNome());
            tvPreco.setText(carrinhoItems.getValortotal() + "€");
            tvQuantidade.setText(carrinhoItems.getQuantidade() + "");
            Glide.with(context).load(carrinhoItems.getImagem()).diskCacheStrategy(DiskCacheStrategy.ALL).into(ivImagem);
        }
    }
}
