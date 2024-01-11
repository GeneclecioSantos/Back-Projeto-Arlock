

<?php 

include("../class/ClassUsuario.php");
// Verifica se os dados foram recebidos corretamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $type = $_POST["type"];
    $senha = $_POST["senha"];

$Aluno = new ClassUsuario();

$Aluno->createUsuarios($nome, $email,$type, $senha);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
}