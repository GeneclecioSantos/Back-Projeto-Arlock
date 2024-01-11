<?php

include("../class/ClassRecuperar.php");

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID']) && isset($_POST['novaSenha'])) {
    $ID = $_POST['ID'];
    $novaSenha = $_POST['novaSenha'];

    // Crie uma instância da classe ClassRecuperar
    $recuperarSenha = new ClassRecuperar();

    // Chame a função alteraSenha
    $alteracaoSenhaSucesso = $recuperarSenha->alteraSenha($novaSenha, $ID);

    if ($alteracaoSenhaSucesso) {
        $response['error'] = false;
        $response['message'] = 'Senha alterada com sucesso!';
    } else {
        $response['error'] = true;
        $response['message'] = 'Falha ao alterar a senha.';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'ID ou nova senha não fornecidos. Por favor, envie as informações corretas.';
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
echo json_encode($response);
?>
