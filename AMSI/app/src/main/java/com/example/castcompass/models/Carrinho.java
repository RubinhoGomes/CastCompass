package com.example.castcompass.models;

public class Carrinho {
    private int id,profileID,quantidade;
    private float valorTotal;

    public Carrinho(int id,float total, int user_id) {
        this.id = id;
        this.profileID = profileID;
        this.valorTotal = valorTotal;
        this.quantidade = quantidade;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getProfileID() {
        return profileID;
    }

    public void setProfileID(int profileID) {
        this.profileID = profileID;
    }

    public float getValorTotal() {
        return valorTotal;
    }

    public void setValorTotal(float valorTotal) {
        this.valorTotal = valorTotal;
    }

    public int getQuantidade() {
        return quantidade;
    }

    public void setQuantidade(int quantidade) {
        this.quantidade = quantidade;
    }
}
