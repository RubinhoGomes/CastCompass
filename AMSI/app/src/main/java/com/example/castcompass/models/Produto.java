package com.example.castcompass.models;

public class Produto {

    private int id, stock, iva;
    private String nome,img, marca, descricao, categoria, imagem;
    private float preco;

    public Produto(int id,String nome, String marca, String descricao, float preco, int stock, String categoria, int iva, String imagem) {
        this.id = id;
        this.nome = nome;
        this.marca = marca;
        this.descricao = descricao;
        this.preco = preco;
        this.stock = stock;
        this.categoria = categoria;
        this.iva = iva;
        this.imagem = imagem;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getMarca() {
        return marca;
    }

    public void setMarca(String marca) {
        this.marca = marca;
    }

    public float getPreco() {
        return preco;
    }

    public void setPreco(float preco) {
        this.preco = preco;
    }

    public int getStock() {
        return stock;
    }

    public void setStock(int stock) {
        this.stock = stock;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public String getCategoria() {
        return categoria;
    }

    public void setCategoria(String categoria) {
        this.categoria = categoria;
    }

    public String getImagem() { return this.imagem; }

    public void setImagem(String imagem) { this.imagem = imagem; }

    public int getIvaID() {
        return iva;
    }

    public void setIvaID(int iva) {
        this.iva = iva;
    }


}
