package com.example.castcompass;

import android.content.Intent;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.TextView;

import com.example.castcompass.adaptadores.ListaProdutosAdaptador;
import com.example.castcompass.listeners.ProdutosListener;
import com.example.castcompass.models.Produto;
import com.example.castcompass.models.Singleton;

import java.util.ArrayList;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link ListaProdutosFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class ListaProdutosFragment extends Fragment implements ProdutosListener {


    private ListView lvProdutos;
    TextView tvCount;

    public ListaProdutosFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.fragment_lista_produtos, container, false);
        setHasOptionsMenu(true);

        lvProdutos = view.findViewById(R.id.lvProdutos);

        Singleton.getInstance(getContext()).setProdutosListener(this);
        Singleton.getInstance(getContext()).getAllProdutosAPI(getContext());



        // Configurar clique em itens da lista
        lvProdutos.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int position, long id) {
                Intent intent = new Intent(getContext(), DetalhesProdutosActivity.class);
                intent.putExtra(DetalhesProdutosActivity.IDPRODUTO, (int) id);
                startActivity(intent);
            }
        });
        return view;
    }


    @Override
    public void onRefreshListaProdutos(ArrayList<Produto> listaProdutos) {
        if (listaProdutos != null) {
            tvCount = getView().findViewById(R.id.tvCount);
            tvCount.setText("Total de produtos: " + Singleton.getInstance(getContext()).ProdutoCount);
            lvProdutos.setAdapter(new ListaProdutosAdaptador(getContext(), listaProdutos));
        }
    }
}