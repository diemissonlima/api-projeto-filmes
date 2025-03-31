<?php

class Genero {
    private $conn;
    private $table_name = "generos";

    public $id;
    public $nome;
    public $descricao;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para listar todos os gêneros
    public function listar() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function listarPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpar o id
        $id = htmlspecialchars(strip_tags($id));

        // Vinculando o id
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt;
    }

    public function inserir() {
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, descricao=:descricao";

        $stmt = $this->conn->prepare($query);

        // Limpar os dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));

        // Vinculando parametros
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>
