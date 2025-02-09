package com.example.castcompass;

import android.content.Context;
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
import com.example.castcompass.listeners.CarrinhoListener;
import com.example.castcompass.models.CarrinhoItems;
import com.example.castcompass.models.Singleton;

import java.util.ArrayList;


public class ListaCarrinhoFragment extends Fragment implements CarrinhoListener {

    private ListView lvProdutos;
    private ArrayList<CarrinhoItems> carrinhoItems;
    private Button btnComprar;
    private TextView tvTotal;
    private SearchView searchView;
    private ListaCarrinhoitemsAdaptador adapter;


    public ListaCarrinhoFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_lista_carrinho, container, false);
        setHasOptionsMenu(true);

        lvProdutos = view.findViewById(R.id.lvProdutos);
        btnComprar = view.findViewById(R.id.btnComprar);

        carrinhoItems = new ArrayList<>();
        adapter = new ListaCarrinhoitemsAdaptador(getContext(), carrinhoItems);
        lvProdutos.setAdapter(adapter);


        Singleton.getInstance(getContext()).setCarrinhoListener(this);
        Singleton.getInstance(getContext()).getCarrinhoAPI(getContext());

        btnComprar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Singleton.getInstance(getContext()).comprarCarrinhoAPI(getContext());
            }
        });

        return view;
    }

    public void onRefreshCarrinho(ArrayList<CarrinhoItems> itens) {
        if (itens != null) {
            carrinhoItems.clear();
            carrinhoItems.addAll(itens);
            adapter.notifyDataSetChanged();
        }
    }
}