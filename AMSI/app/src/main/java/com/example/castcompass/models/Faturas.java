package com.example.castcompass.models;

public class Faturas {
    private int id,metodoExpedicaoID, metodoPagamentoID;
    private float valorTotal, ivaTotal;
    private String data;

    public Faturas() {
    }

    public Faturas(int id, float valorTotal, float ivaTotal, int metodoExpedicaoID, String data,int metodoPagamentoID) {
        this.id=id;
        this.valorTotal = valorTotal;
        this.ivaTotal = ivaTotal;
        this.metodoExpedicaoID = metodoExpedicaoID;
        this.data = data;
        this.metodoPagamentoID = metodoPagamentoID;
    }

    public int getId() {
        return id;
    }

    public void setid(int id) {
        this.id = id;
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
