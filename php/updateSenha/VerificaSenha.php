<?php

include("../class/ClassRecuperar.php");

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID']) && isset($_POST['novaSenha'])) {
    $ID = $_POST['ID'];
    $novaSenha = $_POST['novaSenha'];

    // Crie uma instância da classe ClassRecuperar
    $recuperarSenha = new ClassRecuperar();

    // Verifique se a nova senha já existe
    $senhaExistente = $recuperarSenha->verificaSenhaExistente($novaSenha);

    if ($senhaExistente) {
        $response['error'] = true;
        $response['message'] = 'Essa senha já existe.';
    } else {
        $response['error'] = false;
        $response['message'] = 'Essa senha não existe, por favor, crie uma nova';
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
