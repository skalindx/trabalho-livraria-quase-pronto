<?php
class Reserva {
    private $id;
    private $dataReserva;
    private $usuario;
    private $livro;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id =$id;
    }

    public function getDataReserva() {
        return $this->dataReserva;
    }

    public function setDataReserva($dataReserva) {
        $this->dataReserva =$dataReserva;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario =$usuario;
    }

    public function getLivro() {
        return $this->livro;
    }

    public function setLivro($livro) {
        $this->livro =$livro;
    }
}