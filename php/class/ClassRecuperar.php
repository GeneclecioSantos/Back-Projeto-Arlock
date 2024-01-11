<?php
include("ClassConnect.php");

class ClassRecuperar extends DbConnect
{
    public function verificaEmail($email)
    {
        $con = $this->connect(); // Obtém a conexão mysqli
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        // Consulta SQL para verificar se o e-mail existe
        $sql = "SELECT ID, email, senha FROM usuarios WHERE email = '$email'";
        $result = $con->query($sql);

        $J = [];

        // Verificando se há resultados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $J[] = [
                    "senha" => $row['senha'],
                    "email" => $row['email'],
                    "ID" => $row['ID']
                ];
            }
        }

        $con->close();

        return $J;
    }

    public function alteraSenha($novaSenha, $ID)
    {
        $con = $this->connect(); // Obtém a conexão mysqli
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        // Prevenir injeção de SQL usando consultas preparadas  
        $stmt = $con->prepare("UPDATE usuarios SET senha = ? WHERE ID = ?");

        if (!$stmt) {
            die("Erro na preparação da consulta: " . $con->error);
        }

        // Não criptografar a senha, insira-a diretamente
        $stmt->bind_param("si", $novaSenha, $ID);

        if (!$stmt->execute()) {
            die("Erro na execução da consulta: " . $stmt->error);
        }

        $stmt->close();
        $con->close();

        return true; // A senha foi alterada com sucesso
    }
    public function verificaSenhaExistente($novaSenha)
    {
        $con = $this->connect();

        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        $stmt = $con->prepare("SELECT ID FROM usuarios WHERE senha = ?");

        if (!$stmt) {
            die("Erro na preparação da consulta: " . $con->error);
        }

        // Não é necessário bind_param para uma consulta SELECT com uma condição
        $stmt->bind_param("s", $novaSenha);

        if (!$stmt->execute()) {
            die("Erro na execução da consulta: " . $stmt->error);
        }

        $stmt->store_result();
        $senhaExistente = $stmt->num_rows > 0;

        $stmt->close();
        $con->close();

        return $senhaExistente;
    }
}
