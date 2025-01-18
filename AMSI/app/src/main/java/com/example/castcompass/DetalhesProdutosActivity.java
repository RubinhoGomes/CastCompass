package com.example.castcompass;

import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toolbar;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.example.castcompass.listeners.ProdutoListener;
import com.example.castcompass.models.Produto;
import com.example.castcompass.models.Singleton;

public class DetalhesProdutosActivity extends AppCompatActivity implements ProdutoListener {

    public static final String IDPRODUTO = "id";

    private TextView tvNome, tvPreco, tvDescricao, tvStock;
    private ImageView imgCapa;
    private Produto produto;
    private Button btnAdicionarFav;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_produtos);
        btnAdicionarFav = findViewById(R.id.btnAdicionarFav);

        tvNome = findViewById(R.id.tvNome);
        tvPreco = findViewById(R.id.tvPreco);
        tvStock = findViewById(R.id.tvStock);
        tvDescricao = findViewById(R.id.tvDescricao);
        imgCapa = findViewById(R.id.ivImage);


        Singleton.getInstance(this).setProdutoListener(this);
        produto = Singleton.getInstance(this).getProdutoAPI(this, getIntent().getIntExtra(IDPRODUTO, 0));

        if (produto != null) {
            carregarDados();
        }

        btnAdicionarFav.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (produto != null) {
                    Singleton.getInstance(DetalhesProdutosActivity.this)
                            .adicionarFavoritoAPI(DetalhesProdutosActivity.this, produto.getId());
                }
            }
        });
    }

    public void carregarDados() {

        tvNome.setText(produto.getNome());
        tvPreco.setText(produto.getPreco() + "€");
        tvStock.setText(produto.getStock() + " unidades");
        tvDescricao.setText(produto.getDescricao());
        Glide.with(this)
                .load(produto.getImagem())
                .placeholder(R.drawable.logo)
                .diskCacheStrategy(DiskCacheStrategy.ALL)
                .into(imgCapa);
    }

    @Override
    public void onRefreshProduto(Produto produto) {
        this.produto = produto;
        carregarDados();
    }

}