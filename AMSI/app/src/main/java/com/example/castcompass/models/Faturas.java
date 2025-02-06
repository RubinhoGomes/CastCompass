package com.example.castcompass.models;

public class Faturas {
    private int id;
    private float valorTotal, ivaTotal;
    private String data, estado, metodoExpedicaoID, metodoPagamentoID;

    public Faturas() {
    }

    public Faturas(int id, String metodoExpedicaoID, String metodoPagamentoID, float valorTotal, float ivaTotal, String data, String estado) {
        this.id = id;
        this.metodoExpedicaoID = metodoExpedicaoID;
        this.metodoPagamentoID = metodoPagamentoID;
        this.valorTotal = valorTotal;
        this.ivaTotal = ivaTotal;
        this.data = data;
        this.estado = estado;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getMetodoExpedicaoID() {
        return metodoExpedicaoID;
    }

    public void setMetodoExpedicaoID(String metodoExpedicaoID) {
        this.metodoExpedicaoID = metodoExpedicaoID;
    }

    public String getMetodoPagamentoID() {
        return metodoPagamentoID;
    }

    public void setMetodoPagamentoID(String metodoPagamentoID) {
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

    public String getEstado() {
        return estado;
    }

    public void setEstado(String estado) {
        this.estado = estado;
    }
}
