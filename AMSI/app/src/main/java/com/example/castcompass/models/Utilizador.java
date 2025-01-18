package com.example.castcompass.models;

public class Utilizador {

    public int id, idProfile, nif, telemovel, dataNascimento;
    public String username, email, token, genero, morada, nome;

    public Utilizador() {
    }

    public Utilizador(int id, int idProfile, int nif, int telemovel, int dataNascimento, String username, String nome, String email, String token, String genero, String morada) {
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

    public int getNif() {
        return nif;
    }

    public void setNif(int nif) {
        this.nif = nif;
    }

    public int getTelemovel() {
        return telemovel;
    }

    public void setTelemovel(int telemovel) {
        this.telemovel = telemovel;
    }

    public String getGenero() {
        return genero;
    }

    public void setGenero(String genero) {
        this.genero = genero;
    }

    public int getDataNascimento() {
        return dataNascimento;
    }

    public void setDataNascimento(int dataNascimento) {
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
