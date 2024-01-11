<?php 
include("../class/ClassDelete.php");


$response = [];

if (isset($_GET['IDs'])) {
    $deleteArm = new ClassDelete();
    $IDs = $_GET['IDs'];

    if ($deleteArm->DeleteArmario($IDs)) {
        $response['error'] = false;
        $response['message'] = 'Armário excluído com sucesso';
    } else {
        $response['error'] = true;
        $response['message'] = 'Erro ao excluir o armário, por favor, tente novamente';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'Não foi possível excluir, forneça um ID válido';
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
echo json_encode($response);
