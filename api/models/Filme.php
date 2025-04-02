<?php

class Filme {
    private $conn;
    private $table_name = "filmes";

    public $id;
    public $titulo;
    public $genero;
    public $genero2 = "";
    public $genero3 = "";
    public $sinopse;
    public $capa;
    public $trailer_url;
    public $data_lancamento;
    public $duracao;

    public function __construct($db) {
        $this->conn = $db;
    }

    //Método para listar todos os filmes
    public function listar() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function listarPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt;
    }

    // Método para inserir um filme
    public function inserir() {

        $query = "INSERT INTO " . $this->table_name . " SET titulo=:titulo, genero=:genero, genero_2=:genero2, genero_3=:genero3, sinopse=:sinopse, capa=:capa, trailer_url=:trailer_url, data_lancamento=:data_lancamento, duracao=:duracao";

        $stmt = $this->conn->prepare($query);

        // Limpar os dados
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->genero = htmlspecialchars(strip_tags($this->genero));
        $this->genero2 = htmlspecialchars(strip_tags($this->genero2));
        $this->genero3 = htmlspecialchars(strip_tags($this->genero3));
        $this->sinopse = htmlspecialchars(strip_tags($this->sinopse));
        $this->capa = htmlspecialchars(strip_tags($this->capa));
        $this->trailer_url = htmlspecialchars(strip_tags($this->trailer_url));
        $this->data_lancamento = htmlspecialchars(strip_tags($this->data_lancamento));
        $this->duracao = htmlspecialchars(strip_tags($this->duracao));

        // Vinculando parametros
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":genero", $this->genero);
        $stmt->bindParam(":genero2", $this->genero2);
        $stmt->bindParam(":genero3", $this->genero3);
        $stmt->bindParam(":sinopse", $this->sinopse);
        $stmt->bindParam(":capa", $this->capa);
        $stmt->bindParam(":trailer_url", $this->trailer_url);
        $stmt->bindParam(":data_lancamento", $this->data_lancamento);
        $stmt->bindParam(":duracao", $this->duracao);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function editar() {
        $query = "UPDATE " . $this->table_name . " SET titulo=:titulo, genero=:genero, genero_2=:genero2, genero_3=:genero3, sinopse=:sinopse, capa=:capa, trailer_url=:trailer_url, data_lancamento=:data_lancamento, duracao=:duracao WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpar os dados
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->genero = htmlspecialchars(strip_tags($this->genero));
        $this->genero2 = htmlspecialchars(strip_tags($this->genero2));
        $this->genero3 = htmlspecialchars(strip_tags($this->genero3));
        $this->sinopse = htmlspecialchars(strip_tags($this->sinopse));
        $this->capa = htmlspecialchars(strip_tags($this->capa));
        $this->trailer_url = htmlspecialchars(strip_tags($this->trailer_url));
        $this->data_lancamento = htmlspecialchars(strip_tags($this->data_lancamento));
        $this->duracao = htmlspecialchars(strip_tags($this->duracao));

        // Vinculando parametros
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":genero", $this->genero);
        $stmt->bindParam(":genero2", $this->genero2);
        $stmt->bindParam(":genero3", $this->genero3);
        $stmt->bindParam(":sinopse", $this->sinopse);
        $stmt->bindParam(":capa", $this->capa);
        $stmt->bindParam(":trailer_url", $this->trailer_url);
        $stmt->bindParam(":data_lancamento", $this->data_lancamento);
        $stmt->bindParam(":duracao", $this->duracao);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpar os dados
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vinculando parametros
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>
