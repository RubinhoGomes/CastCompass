package com.example.castcompass.models;

public class Utilizador {

    public int id, idProfile;
//    public long nif;
    public String username, nif, email, token, genero, morada, nome, dataNascimento, telemovel;

    public Utilizador() {
    }

    public Utilizador(int id, int idProfile, String nif, String telemovel, String dataNascimento, String username, String nome, String email, String token, String genero, String morada) {
        this.id = id;
        this.idProfile = idProfile;
        this.username = username;
        this.nome = nome;
        this.email = email;
        this.nif = nif;
        this.telemovel = telemovel;
        this.genero = genero;
        this.dataNascimento = dataNascimento;
        this.morada = morada;
        this.token = token;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getIdProfile() {
        return idProfile;
    }

    public void setIdProfile(int idProfile) {
        this.idProfile = idProfile;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getNif() {
        return nif;
    }

    public void setNif(String nif) {
        this.nif = nif;
    }

    public String getTelemovel() {
        return telemovel;
    }

    public void setTelemovel(String telemovel) {
        this.telemovel = telemovel;
    }

    public String getGenero() {
        return genero;
    }

    public void setGenero(String genero) {
        this.genero = genero;
    }

    public String getDataNascimento() {
        return dataNascimento;
    }

    public void setDataNascimento(String dataNascimento) {
        this.dataNascimento = dataNascimento;
    }

    public String getMorada() {
        return morada;
    }

    public void setMorada(String morada) {
        this.morada = morada;
    }

    public String getToken() {
        return token;
    }

    public void setToken(String token) {
        this.token = token;
    }
}
