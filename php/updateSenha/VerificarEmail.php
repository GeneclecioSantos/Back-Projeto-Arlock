<?php

include("../class/ClassRecuperar.php");

$response = [];

if (isset($_GET['email'])) {
    // Crie uma instância da classe ClassRecuperar
    $setEmail = new ClassRecuperar();
    $email = $_GET['email'];

    // Agora você pode chamar a função verificaEmail
    $usuarioInfo = $setEmail->verificaEmail($email);

    // Verifique se a função retornou dados
    if ($usuarioInfo) {
        $response['error'] = false;
        $response['message'] = 'E-mail existe!!';
        $response['data'] = $usuarioInfo; // A função já retorna um array
    } else {
        $response['error'] = true;
        $response['message'] = 'E-mail não existe!!';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'E-mail não encontrado, por favor envie um e-mail correspondente';
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
echo json_encode($response);
