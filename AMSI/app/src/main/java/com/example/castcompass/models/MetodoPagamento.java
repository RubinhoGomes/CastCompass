package com.example.castcompass.models;

public class MetodoPagamento {
    int id;
    String nome, tipo;

    public MetodoPagamento() {
    }

    public MetodoPagamento(int id, String nome, String tipo) {
        this.id = id;
        this.nome = nome;
        this.tipo = tipo;
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

    public String getTipo() {
        return tipo;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }

    @Override
    public String toString() {
        return nome; // Retorna o nome do método de pagamento
    }
}
