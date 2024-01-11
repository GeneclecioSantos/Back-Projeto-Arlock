<?php 

include("../class/ClassAlugueis.php");


 $response = [];

if (isset($_GET['$IDs'])) {
    $updateAprovado = new ClassAlugueis(); // Substitua "SuaClasse" pelo nome da sua classe.

    $IDs = $_GET['$IDs'];

    if ($updateAprovado->updateAprovado($IDs)) {
        $response['error'] = false;
        $response['message'] = 'Aprovação realizada';
    } else {
        $response['error'] = true;
        $response['message'] = 'Erro na atualização na aprovação, por favor, tente novamente';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'Não foi possível aprovar, forneça um ID válido';
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
echo json_encode($response);