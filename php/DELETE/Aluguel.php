<?php 

include("../class/ClassDelete.php");


$response = [];

if (isset($_GET['IDs'])) {
    $deleteAluguel = new ClassDelete();
    $id = $_GET['IDs'];

    if ($deleteAluguel->deleteArovacao($id)) {
        $response['error'] = false;
        $response['message'] = 'Aprovação não realizada';
    } else {
        $response['error'] = true;
        $response['message'] = 'Erro ao aprovar, por favor, tente novamente';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'Não foi possível anular, forneça um ID válido';
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
echo json_encode($response);
