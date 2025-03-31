<?php

require_once '../../config/database.php';
require_once '../../models/Genero.php';

$database = new Database();
$db = $database->getConnection();
$genero = new Genero($db);

// Definindo a resposta em formato JSON
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Se for uma requisicao POST, inserir um novo genero
    $genero->nome = $_POST['nome'];
    $genero->descricao = $_POST['descricao'];

    if ($genero->inserir()) {
        echo json_encode(array('message' => 'Gênero inserido com sucesso'));
    } else {
        echo json_encode(array('message' => 'Erro ao inserir gênero'));
    }
} else {
    echo json_encode(array('message' => 'Método não permitido'));
}
