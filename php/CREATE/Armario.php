<!-- CREATE DO ARMÁRIO, QUANDO FOR CÓDIGO DE CRIAÇÃO DO ARMÁRIO -->
<?php 

include("../class/ClassArmario.php");
// Verifica se os dados foram recebidos corretamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $letra = $_POST["letra"];
    $numero = $_POST["numero"];
    $curso = $_POST["curso"];
    $status = $_POST["status"];

$create = new ClassArmario();

$create->createArmario($letra, $numero, $curso, $status);
}