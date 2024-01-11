<!-- CREATE DO ALUNO, QUANDO FOR CÓDIGO DE CRIAÇÃO DO ALUNO -->

<?php 

include("../class/ClassAluno.php");
// Verifica se os dados foram recebidos corretamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $type = $_POST["type"];
    $rm = $_POST["rm"];
    $curso = $_POST["curso"];
    $senha = $_POST["senha"];

$Aluno = new ClassAluno();

$Aluno->createAluno($nome, $email, $senha, $rm, $curso, $type);
}