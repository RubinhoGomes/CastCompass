package com.example.castcompass.models;

public class CarrinhoItems {

    private int id,carrinhoID,produtoID;

    private String nome;
    private int quantidade;
    private float valortotal;

    public CarrinhoItems(int id,int carrinhoID,int produtoID,String nome,int quantidade,float valortotal) {
        this.id = id;
        this.carrinhoID = carrinhoID;
        this.produtoID = produtoID;
        this.nome = nome;
        this.quantidade = quantidade;
        this.valortotal = valortotal;

    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
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
