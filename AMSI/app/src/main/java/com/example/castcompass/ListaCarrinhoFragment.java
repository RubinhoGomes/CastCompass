package com.example.castcompass;

import android.content.Intent;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ListView;
import android.widget.SearchView;
import android.widget.TextView;

import com.example.castcompass.adaptadores.ListaCarrinhoitemsAdaptador;
import com.example.castcompass.models.CarrinhoItems;
import com.example.castcompass.models.Singleton;
import com.example.castcompass.utils.ProdutosJsonParser;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;


public class ListaCarrinhoFragment extends Fragment {



    private ListView lvProdutos;
    private CarrinhoItems carrinhoItems;
    private Button btnComprar;
    private TextView tvTotal;
    private FloatingActionButton fabLista;
    private SearchView searchView;



    public ListaCarrinhoFragment() {
        // Required empty public constructor
    }



    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_lista_carrinho , container , false);
        setHasOptionsMenu(true);



        lvProdutos = view.findViewById(R.id.lvProdutos);
        btnComprar = view.findViewById(R.id.btnComprar);
        tvTotal = view.findViewById(R.id.tvTotal);
        //Singleton.getInstance(getContext()).getAllCarrinhoItemsAPI(getContext());
        //Singleton.getInstance(getContext()).setCarrinhoTotalListener(this);

        btnComprar.setOnClickListener(new View.OnClickListener(){

            public void onClick(View view) {

            }


        });

        return view;
    }



    public void onRefreshListaCarrinhoItems(ArrayList<CarrinhoItems> listaCarrinhoItems) {
        if(listaCarrinhoItems!=null){
            lvProdutos.setAdapter(new ListaCarrinhoitemsAdaptador(getContext(),listaCarrinhoItems));
        }
    }


    public void onRefreshTotal(float total) {
        tvTotal.setText("Total: "+total+"€");
    }
}