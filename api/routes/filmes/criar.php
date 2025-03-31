<?php

require_once '../../config/Database.php';
require_once '../../models/Filme.php';

$database = new Database();
$db = $database->getConnection();
$filme = new Filme($db);

// Definindo a resposta em formato JSON
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se for uma requisicao POST, inserir um filme
    if (isset($_FILES['capa'])) {
        $fileTempPath = $_FILES['capa']['tmp_name'];
        $fileName = $_FILES['capa']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadDir = '../../public/uploads/';

            // Cria a pasta se nao existir
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $newFileName = uniqid() . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;

            // Move o arquivo para o diretório de upload
            if (move_uploaded_file($fileTempPath, $destPath)) {
                // Sucesso no upload
                $imgemPath = $destPath;
            } else {
                // Falha no upload
                echo json_encode(array('message' => 'Erro ao fazer upload da imagem'));
                exit;
            }
        }   
    };

    $filme->titulo = $_POST['titulo'];
    $filme->genero = $_POST['genero'];
    $filme->sinopse = $_POST['sinopse'];
    $filme->capa = $newFileName;
    $filme->trailer_url = $_POST['trailer_url'];
    $filme->data_lancamento = $_POST['data_lancamento'];
    $filme->duracao = $_POST['duracao'];

    if ($filme->inserir()) {
        echo json_encode(array('message' => 'Filme inserido com sucesso'));
    } else {
        echo json_encode(array('message' => 'Erro ao inserir filme'));
    }
} else {
    echo json_encode(array('message' => 'Método não permitido'));
};
