<?php

include("../class/ClassPesquisar.php");

$response = [];

if (isset($_GET['curso'])) {
    $RM = new ClassPesquisar();
    $curso = $_GET['curso'];

    $result = $RM->PesquisarCurso($curso); // Corrigido o nome do método

    if ($result) {
        $response['error'] = false;
        $response['message'] = 'Erro na pesquisa, por favor, tente novamente';
        $response['data'] = $result; // Adicionado o resultado da pesquisa aos dados de resposta
    } else {
        $response['error'] = true;
        $response['message'] = 'Pesquisa realizada com sucesso ';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'Não foi possível realizar a pesquisa, forneça um Curso válido';
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
echo json_encode($response);
