package com.example.castcompass;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;

import com.example.castcompass.adaptadores.FaturaAdaptador;
import com.example.castcompass.listeners.FaturasListener;
import com.example.castcompass.models.Faturas;
import com.example.castcompass.models.Singleton;

import java.util.ArrayList;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link ListaFaturasFragment#newInstance} factory method to
 * create an instance of this fragment.
 *
 */
public class ListaFaturasFragment extends Fragment implements FaturasListener {


    private ListView lvFaturas;
    private ArrayList<Faturas> faturas;

    public ListaFaturasFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_lista_faturas, container, false);
        setHasOptionsMenu(true);

        lvFaturas = view.findViewById(R.id.lvFaturas);
        Singleton.getInstance(getContext()).setFaturasListener(this);

        return view;
    }

    @Override
    public void onRefreshFaturas(ArrayList<Faturas> faturas) {
        this.faturas = faturas;
        FaturaAdaptador adaptador = new FaturaAdaptador(getContext(), faturas);
        lvFaturas.setAdapter(adaptador);
    }
}