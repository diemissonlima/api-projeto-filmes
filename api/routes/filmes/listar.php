<?php

require_once '../../config/Database.php';
require_once '../../models/Filme.php';

$database = new Database();
$db = $database->getConnection();
$filme = new Filme($db);

// Definindo a resposta em formato JSON
header('Content-Type: application/json; charset=utf-8');

$reques_method = $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $filme->listarPorId($id);
        
    } else {
        $stmt = $filme->listar();
    }

    $num = $stmt->rowCount();

    if ($num > 0) {
        $filmes_arr = array();
        $filmes_arr['dados'] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $filme_item = array(
                'id' => $id,
                'titulo' => $titulo,
                'generos' => array_values(array_filter([$genero, $genero_2, $genero_3])),
                'sinopse' => $sinopse,
                'capa' => $capa,
                'trailer_url' => $trailer_url,
                'data_lancamento' => $data_lancamento,
                'duracao' => $duracao
            );

            array_push($filmes_arr['dados'], $filme_item);
        }

        echo json_encode($filmes_arr, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(array('message' => 'Nenhum filme encontrado'));
    }
}
