<?php
class Livro {
    private $id;
    private $titulo;
    private $editora;
    private $ano_publicado;
    private $quant_disponivel;
    private $categoria; // Associação com Categoria

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getEditora() {
        return $this->editora;
    }

    public function setEditora($editora) {
        $this->editora = $editora;
    }

    public function getAno_publicado() {
        return $this->ano_publicado;
    }

    public function setAno_publicado($ano_publicado) {
        $this->ano_publicado = $ano_publicado;
    }

    public function getQuant_disponivel() {
        return $this->quant_disponivel;
    }

    public function setQuant_disponivel($quant_disponivel) {
        $this->quant_disponivel = $quant_disponivel;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
}