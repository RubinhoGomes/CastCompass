package com.example.castcompass.models;

public class Produto {

    private int id, stock, categoriaID, ivaID;
    private String nome,img, marca, descricao;
    private float preco;

    public Produto(int id,String nome, String marca, String descricao, float preco, int stock, int categoriaID, int ivaID) {
        this.id = id;
        this.nome = nome;
        this.marca = marca;
        this.descricao = descricao;
        this.preco = preco;
        this.stock = stock;
        this.categoriaID = categoriaID;
        this.ivaID = ivaID;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getImg() {
        return img;
    }

    public void setImg(String img) {
        this.img = img;
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

    public int getCategoriaID() {
        return categoriaID;
    }

    public void setCategoriaID(int categoriaID) {
        this.categoriaID = categoriaID;
    }

    public int getIvaID() {
        return ivaID;
    }

    public void setIvaID(int ivaID) {
        this.ivaID = ivaID;
    }


}
