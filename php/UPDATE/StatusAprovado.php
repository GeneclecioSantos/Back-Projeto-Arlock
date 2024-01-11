<?php

include("../class/ClassAlugueis.php");

$response = [];

if (isset($_GET['IDs'])) {
    $updateStatus = new ClassAlugueis(); 

    $IDs = $_GET['IDs']; // Correção aqui

    if ($updateStatus->atualizarAprovadoStatus($IDs)) { // Mudança aqui para usar a função update
        $response['error'] = false;
        $response['message'] = 'Erro na aprovação do aluno, por favor, tente novamente';
    } else {
        $response['error'] = true;
        $response['message'] = 'Aluno aprovado, armário alugado';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'Não foi possível aprovar o armário do aluno, forneça um ID válido';
}


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
echo json_encode($response);
?>
