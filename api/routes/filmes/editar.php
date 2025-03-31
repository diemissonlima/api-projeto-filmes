<?php

require_once '../../config/Database.php';
require_once '../../models/Filme.php';

$database = new Database();
$db = $database->getConnection();
$filme = new Filme($db);

// Definindo a resposta em formato JSON
header('Content-Type: application/json; charset=utf-8');

// Captura o método PUT
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // Verificando se todos os parâmetros necessários estão presentes
    if (isset($_POST['id'], $_POST['titulo'], $_POST['genero'], $_POST['sinopse'], $_POST['trailer_url'], $_POST['data_lancamento'], $_POST['duracao'])) {
        
        // Lógica para upload da capa, se presente
        if (isset($_FILES['capa'])) {
            $fileTempPath = $_FILES['capa']['tmp_name'];
            $fileName = $_FILES['capa']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($fileExtension, $allowedExtensions)) {
                $uploadDir = '../../public/uploads/';

                // Cria a pasta se não existir
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $newFileName = uniqid() . '.' . $fileExtension;
                $destPath = $uploadDir . $newFileName;

                // Move o arquivo para o diretório de upload
                if (move_uploaded_file($fileTempPath, $destPath)) {
                    $filme->capa = $newFileName; // Define o nome do arquivo como a nova capa
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Erro ao fazer upload da imagem'));
                    exit;
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Tipo de arquivo inválido'));
                exit;
            }
        }

        // Definindo os valores do filme
        $filme->id = $_POST['id'];
        $filme->titulo = $_POST['titulo'];
        $filme->genero = $_POST['genero'];
        $filme->sinopse = $_POST['sinopse'];
        $filme->capa = isset($filme->capa) ? $filme->capa : null; // Se não houve upload, mantemos o valor anterior
        $filme->trailer_url = $_POST['trailer_url'];
        $filme->data_lancamento = $_POST['data_lancamento'];
        $filme->duracao = $_POST['duracao'];

        // Chama a função editar() no modelo para atualizar o filme no banco de dados
        if ($filme->editar()) {
            echo json_encode(array('status' => 'success', 'message' => 'Filme editado com sucesso'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Erro ao editar filme'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Dados faltando ou incorretos'));
    }

} else {
    echo json_encode(array('status' => 'error', 'message' => 'Método não permitido'));
}
?>
