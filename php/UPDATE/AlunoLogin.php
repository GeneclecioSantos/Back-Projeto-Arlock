<?php
// Inclua a definição da sua classe Usuario
include("../class/ClassAluno.php");

// Inicializa a resposta
$response = [];

// Verifique se o e-mail está presente nos dados
if (isset($_GET['email'])) {
    // Crie uma instância da classe Usuario
    $setEmail = new ClassAluno();
    $email = $_GET['email'];

    // Agora você pode chamar a função SessaoUsuario
    $usuarioInfo = $setEmail->SessaoUsuario($email);

    // Verifique se a função retornou dados
    if ($usuarioInfo) {
        $response['error'] = false;
        $response['message'] = 'Sessão do usuário criada com sucesso';
        $response['data'] = json_decode($usuarioInfo, true); // Converta a string JSON para array associativo
    } else {
        $response['error'] = true;
        $response['message'] = 'Erro ao criar sessão do usuário, por favor, tente novamente';
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
