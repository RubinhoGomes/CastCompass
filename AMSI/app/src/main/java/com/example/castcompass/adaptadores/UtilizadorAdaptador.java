package com.example.castcompass.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.example.castcompass.R;
import com.example.castcompass.models.Favoritos;
import com.example.castcompass.models.Utilizador;

import java.util.ArrayList;

public class UtilizadorAdaptador extends BaseAdapter {
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Utilizador> utilizador;

    public UtilizadorAdaptador(Context context, ArrayList<Utilizador> utilizador) {
        this.context = context;
        this.utilizador = utilizador;
    }

    @Override
    public int getCount() {
        return 0;
    }

    @Override
    public Object getItem(int i) {
        return null;
    }

    @Override
    public long getItemId(int i) {
        return 0;
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        UtilizadorAdaptador.ViewHolderLista viewHolder = (UtilizadorAdaptador.ViewHolderLista) view.getTag();

        if (viewHolder == null) {
            viewHolder = new UtilizadorAdaptador.ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(utilizador.get(position));
        return view;
    }

    private class ViewHolderLista {
        private EditText etUsername, etEmail, etDataNascimento, etNome, etNumero, etMorada, etNif, etGenero;
        private Button btnGuardarPerfil, btnApagarPerfil;

        public ViewHolderLista(View view) {
            etUsername = view.findViewById(R.id.etUsername);
            etEmail = view.findViewById(R.id.etEmail);
            etDataNascimento = view.findViewById(R.id.etDataNascimento);
            etNome = view.findViewById(R.id.etNome);
            etNumero = view.findViewById(R.id.etTelemovel);
            etMorada = view.findViewById(R.id.etMorada);
            etNif = view.findViewById(R.id.etNif);
            etGenero = view.findViewById(R.id.etGenero);
            btnGuardarPerfil = view.findViewById(R.id.btnGuardarPerfil);
            btnApagarPerfil = view.findViewById(R.id.btnApagarPerfil);
        }

        //invoca 1 vez por cada linha da lista
        public void update(Utilizador utilizador) {
            etUsername.setText(utilizador.getUsername());
            etEmail.setText(utilizador.getEmail());
            etDataNascimento.setText(utilizador.getDataNascimento());
            etNome.setText(utilizador.getNome());
            etNumero.setText(utilizador.getTelemovel());
            etMorada.setText(utilizador.getMorada());
            etNif.setText("" + utilizador.getNif());
            etGenero.setText(utilizador.getGenero());
        }
    }
}
