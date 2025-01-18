package com.example.castcompass.models;

public class CarrinhoItems {

    private int carrinhoID,produtoID;

    private String nome, imagem;
    private int quantidade;
    private float valortotal;

    public CarrinhoItems(int carrinhoID,int produtoID,String nome, String imagem,int quantidade,float valortotal) {
        this.carrinhoID = carrinhoID;
        this.produtoID = produtoID;
        this.nome = nome;
        this.imagem = imagem;
        this.quantidade = quantidade;
        this.valortotal = valortotal;

    }

    public int getCarrinhoID() {
        return carrinhoID;
    }

    public void setCarrinhoID(int carrinhoID) {
        this.carrinhoID = carrinhoID;
    }

    public int getProdutoID() {
        return produtoID;
    }

    public void setProdutoID(int produtoID) {
        this.produtoID = produtoID;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public int getQuantidade() {
        return quantidade;
    }

    public void setQuantidade(int quantidade) {
        this.quantidade = quantidade;
    }

    public float getValortotal() {
        return valortotal;
    }

    public void setValortotal(float valortotal) {
        this.valortotal = valortotal;
    }

}
