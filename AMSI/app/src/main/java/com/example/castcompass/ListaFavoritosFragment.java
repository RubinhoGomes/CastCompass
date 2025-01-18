package com.example.castcompass;

import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;
import android.widget.SearchView;

import com.example.castcompass.utils.util;
import com.example.castcompass.adaptadores.FavoritosAdaptador;
import com.example.castcompass.listeners.FavoritosListener;
import com.example.castcompass.models.Favoritos;
import com.example.castcompass.models.Singleton;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link ListaFavoritosFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class ListaFavoritosFragment extends Fragment implements FavoritosListener {

    private ListView lvFavoritos;
    private Button remover;
    private ArrayList<Favoritos> favoritos;

    private FloatingActionButton fablista;
    private SearchView searchView;

    public ListaFavoritosFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_lista_favoritos, container, false);
        setHasOptionsMenu(true);

        lvFavoritos = view.findViewById(R.id.lvFavoritos);
        Singleton.getInstance(getContext()).setFavoritosListener(this);
        Singleton.getInstance(getContext()).getAllFavoritosAPI(getContext());

        lvFavoritos.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

            }
        });

        return view;
    }


    @Override
    public void onRefreshFavoritos(ArrayList<Favoritos> favoritos) {
        if(favoritos != null){
            lvFavoritos.setAdapter(new FavoritosAdaptador(getContext(), favoritos));
        }
    }
}