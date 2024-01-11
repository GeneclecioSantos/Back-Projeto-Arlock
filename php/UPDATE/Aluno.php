<?php

include("../class/ClassAluno.php");

$response = [];

if (isset($_GET['ID'])) {
    $updateAtivado = new ClassAluno(); // Substitua "SuaClasse" pelo nome da sua classe.

    $ID = $_GET['ID']; // Correção aqui

    if ($updateAtivado->toggleStatus($ID)) { // Mudança aqui para usar a função toggleStatus
        $response['error'] = false;
        $response['message'] = 'Status do aluno atualizado com sucesso';
    } else {
        $response['error'] = true;
        $response['message'] = 'Erro na atualização do status do aluno, por favor, tente novamente';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'Não foi possível atualizar o status do aluno, forneça um ID válido';
}


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
echo json_encode($response);
?>
