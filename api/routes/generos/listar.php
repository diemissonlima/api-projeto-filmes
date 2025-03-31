<?php

require_once '../../config/database.php';
require_once '../../models/Genero.php';

$database = new Database();
$db = $database->getConnection();
$genero = new Genero($db);

// Definindo a resposta em formato JSON
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $genero->listarPorId($id);
        $num = $stmt->rowCount();

    } else {
        // Se for uma requisicao GET, listar os generos
        $stmt = $genero->listar();
        $num = $stmt->rowCount();
    }


    if ($num > 0) {
        $generos_arr = array();
        $generos_arr['dados'] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $genero_item = array(
                'id' => $id,
                'nome' => $nome,
                'descricao' => $descricao
            );

            array_push($generos_arr['dados'], $genero_item);
        }

        echo json_encode($generos_arr, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(array('message' => 'Nenhum gênero encontrado'));
    }
}
