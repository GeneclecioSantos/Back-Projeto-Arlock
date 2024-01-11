<?php

include("../class/ClassAlugueis.php");

$response = [];

if (isset($_GET['IDs'], $_GET['ID'], $_GET['pagamento'])) {
    $IDs = $_GET['IDs'];
    $ID = $_GET['ID'];
    $pagamento = $_GET['pagamento'];

    $updateStatus = new ClassAlugueis();

    // Atualiza o status do armário
    $updateResult = $updateStatus->atualizarPendenteStatus($IDs, $pagamento, $ID);

    if ($updateResult['error']) {
        $response['error'] = true;
        $response['message'] = 'Erro ao tentar alugar armário: ' . $updateResult['message'];
    } else {
        $response['error'] = false;
        $response['message'] = 'Armário alugado com sucesso.';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'Parâmetros inválidos. Forneça IDs, ID e pagamento.';
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
echo json_encode($response);
