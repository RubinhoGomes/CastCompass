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



    public ListaCarrinhoitemsAdaptador(Context context, ArrayList<CarrinhoItems> carrinhoItems) {
        this.context = context;
        this.carrinhoItems = carrinhoItems;
    }

    @Override
    public int getCount() {return carrinhoItems.size();}

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


        if(inflater == null){
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        } if(view == null){
            view = inflater.inflate(R.layout.item_lista_carrinho_item, null);
        }

        ListaCarrinhoitemsAdaptador.ViewHolderLista viewHolder = (ListaCarrinhoitemsAdaptador.ViewHolderLista) view.getTag();
        if(viewHolder == null){
            viewHolder = new ListaCarrinhoitemsAdaptador.ViewHolderLista(view);
            view.setTag(viewHolder);
        }


        viewHolder.update(carrinhoItems.get(position));
        return view;
    }

    private void showToast(String message) {
        Toast.makeText(context.getApplicationContext(), message, Toast.LENGTH_SHORT).show();
    }

    private class ViewHolderLista{
        private TextView tvNome , tvPreco ;

        public ViewHolderLista(View view){
            tvNome = view.findViewById(R.id.tvNome);
            tvPreco = view.findViewById(R.id.tvPreco);
        }

        public void update(CarrinhoItems carrinhoItems){
            tvNome.setText(carrinhoItems.getNome());
            tvPreco.setText(carrinhoItems.getValortotal()+"");

        }
    }
}
