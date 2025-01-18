package com.example.castcompass.models;

public class CarrinhoItems {

    private int id, carrinhoID, quantidade;
    private String nome, imagem;
    private float valortotal;

    public CarrinhoItems(int id, int carrinhoID, int quantidade, String nome, String imagem, float valortotal) {
        this.id = id;
        this.carrinhoID = carrinhoID;
        this.quantidade = quantidade;
        this.nome = nome;
        this.imagem = imagem;
        this.valortotal = valortotal;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public int getCarrinhoID() { return carrinhoID; }

    public void setCarrinhoID(int carrinhoID) {
        this.carrinhoID = carrinhoID;
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

    public String getImagem() { return imagem; }

    public void setImagem(String imagem) {
        this.imagem = imagem;
    }
}
