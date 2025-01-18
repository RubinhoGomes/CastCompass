package com.example.castcompass.models;

public class Faturas {
    private int id, carrinhoID, metodoExpedicaoID, metodoPagamentoID;
    private float valorTotal, ivaTotal;
    private String data;

    public Faturas() {
    }

    public Faturas(int id, int carrinhoID, int metodoExpedicaoID, int metodoPagamentoID, float valorTotal, float ivaTotal, String data) {
        this.id = id;
        this.carrinhoID = carrinhoID;
        this.metodoExpedicaoID = metodoExpedicaoID;
        this.metodoPagamentoID = metodoPagamentoID;
        this.valorTotal = valorTotal;
        this.ivaTotal = ivaTotal;
        this.data = data;
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

    public int getMetodoExpedicaoID() {
        return metodoExpedicaoID;
    }

    public void setMetodoExpedicaoID(int metodoExpedicaoID) {
        this.metodoExpedicaoID = metodoExpedicaoID;
    }

    public int getMetodoPagamentoID() {
        return metodoPagamentoID;
    }

    public void setMetodoPagamentoID(int metodoPagamentoID) {
        this.metodoPagamentoID = metodoPagamentoID;
    }

    public float getValorTotal() {
        return valorTotal;
    }

    public void setValorTotal(float valorTotal) {
        this.valorTotal = valorTotal;
    }

    public float getIvaTotal() {
        return ivaTotal;
    }

    public void setIvaTotal(float ivaTotal) {
        this.ivaTotal = ivaTotal;
    }

    public String getData() {
        return data;
    }


    public void setData(String data) {
        this.data = data;
    }
}
