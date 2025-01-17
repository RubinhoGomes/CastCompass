package com.example.castcompass.models;

public class Favoritos {

    private int idProduto, idUtilizador;
    private String nomeProduto, marcaProduto, descricaoProduto, categoriaProduto, imagemProduto;
    private float precoProduto;

    public Favoritos() {
    }

    public Favoritos(int idProduto, int idUtilizador, String nomeProduto, String marcaProduto, String descricaoProduto, String categoriaProduto, String imagemProduto, float precoProduto) {
        this.idProduto = idProduto;
        this.idUtilizador = idUtilizador;
        this.nomeProduto = nomeProduto;
        this.marcaProduto = marcaProduto;
        this.descricaoProduto = descricaoProduto;
        this.categoriaProduto = categoriaProduto;
        this.imagemProduto = imagemProduto;
        this.precoProduto = precoProduto;
    }


    public int getIdProduto() {
        return idProduto;
    }

    public void setIdProduto(int idProduto) {
        this.idProduto = idProduto;
    }

    public int getIdUtilizador() {
        return idUtilizador;
    }

    public void setIdUtilizador(int idUtilizador) {
        this.idUtilizador = idUtilizador;
    }

    public String getNomeProduto() {
        return nomeProduto;
    }

    public void setNomeProduto(String nomeProduto) {
        this.nomeProduto = nomeProduto;
    }

    public String getMarcaProduto() {
        return marcaProduto;
    }

    public void setMarcaProduto(String marcaProduto) {
        this.marcaProduto = marcaProduto;
    }

    public String getDescricaoProduto() {
        return descricaoProduto;
    }

    public void setDescricaoProduto(String descricaoProduto) {
        this.descricaoProduto = descricaoProduto;
    }

    public String getCategoriaProduto() {
        return categoriaProduto;
    }

    public void setCategoriaProduto(String categoriaProduto) {
        this.categoriaProduto = categoriaProduto;
    }

    public String getImagemProduto() {
        return imagemProduto;
    }

    public void setImagemProduto(String imagemProduto) {
        this.imagemProduto = imagemProduto;
    }

    public float getPrecoProduto() {
        return precoProduto;
    }

    public void setPrecoProduto(float precoProduto) {
        this.precoProduto = precoProduto;
    }
}
