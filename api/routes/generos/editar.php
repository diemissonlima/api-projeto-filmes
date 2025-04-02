<?php

require_once "../../config/Database.php";
require_once "../../models/Genero.php";

$database = new Database();
$db = $database->getConnection();
$genero = new Genero($db);

// Definindo a resposta em formato JSON
header('Content-Type: application/json; charset=utf-8');

// Captura o método PUT
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    if (isset($_POST['id'])) {
        $genero->id = $_POST['id'];
        $genero->nome = $_POST['nome'];
        $genero->descricao = $_POST['descricao'];

        //Chama a função editar() no modelo para atualizar o genero no banco de dados
        if ($genero->editar()) {
            echo json_encode(array('status' => 'success', 'message' => 'Gênero editado com sucesso'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Erro ao editar gênero'));
        }

    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Dados faltando ou incorretos'));
    }
};

?>
