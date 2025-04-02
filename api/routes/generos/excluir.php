<?php

require_once "../../config/Database.php";
require_once "../../models/Genero.php";

$database = new Database();
$db = $database->getConnection();
$genero = new Genero($db);

// Definindo a resposta em formato JSON
header('Content-Type: application/json; charset=utf-8');

// Captura o método DELETE
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'DELETE') {
    // Verificando se o ID do filme foi passado
    if (isset($_GET['id'])) {
        $genero->id = $_GET['id'];

        // Tentando excluir o filme
        if ($genero->delete()) {
            echo json_encode(array('status' => 'success', 'message' => 'Gênero excluído com sucesso'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Erro ao excluir o genero'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'ID do genero não fornecido'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Método não permitido'));
}

?>
