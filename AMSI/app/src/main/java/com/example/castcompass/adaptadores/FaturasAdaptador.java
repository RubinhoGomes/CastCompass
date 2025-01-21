package com.example.castcompass.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.castcompass.R;
import com.example.castcompass.models.Faturas;

import java.util.ArrayList;

public class FaturasAdaptador extends BaseAdapter {
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Faturas> faturas;

    public FaturasAdaptador(Context context, ArrayList<Faturas> faturas) {
        this.context = context;
        this.faturas = faturas;
    }

    @Override
    public int getCount() {
        return faturas.size();
    }

    @Override
    public Object getItem(int i) {
        return faturas.get(i);
    }

    @Override
    public long getItemId(int i) {
        return faturas.get(i).getId();
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        if (inflater == null) {
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if (view == null) {
            view = inflater.inflate(R.layout.item_lista_faturas, null);
        }

        FaturasAdaptador.ViewHolderLista viewHolder = (FaturasAdaptador.ViewHolderLista) view.getTag();

        if (viewHolder == null) {
            viewHolder = new FaturasAdaptador.ViewHolderLista(view);
            view.setTag(viewHolder);
        }
        viewHolder.update(faturas.get(position));
        return view;
    }

    private class ViewHolderLista {
        private TextView tvValorTotal, tvIvaTotal, tvData, tvMetodoExpedicao, tvMetodoPagamento;

        public ViewHolderLista(View view) {
            tvValorTotal = view.findViewById(R.id.tvNome);
            tvIvaTotal = view.findViewById(R.id.tvIvaTotal);
            tvData = view.findViewById(R.id.tvData);
            tvMetodoExpedicao = view.findViewById(R.id.tvMtdExpedicao);
            tvMetodoPagamento = view.findViewById(R.id.tvMtdPagamento);
        }

        //invoca 1 vez por cada linha da lista
        public void update(Faturas faturas) {
            tvValorTotal.setText(faturas.getValorTotal()+"");
            tvIvaTotal.setText(faturas.getIvaTotal()+"");
            tvData.setText(faturas.getData());
            tvMetodoExpedicao.setText(faturas.getMetodoExpedicaoID()+"");
            tvMetodoPagamento.setText(faturas.getMetodoPagamentoID()+"");
        }
    }
}



