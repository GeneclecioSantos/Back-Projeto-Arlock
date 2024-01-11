<?php
include("ClassConnect.php");

class ClassAluno extends DbConnect
{

    public function exibirAluno()
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Verifica se a conexão foi bem-sucedida
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        $query = "SELECT ID, rm, nome, curso, status FROM Usuarios WHERE type LIKE '%aluno%';";

        $result = $con->query($query);

        if (!$result) {
            die("Erro na consulta: " . $con->error);
        }

        $J = [];


        while ($row = $result->fetch_assoc()) {
            $J[] = [
                "ID" => $row['ID'],
                "rm" => $row['rm'],
                "nome" => $row['nome'],
                "curso" => $row['curso'],
                "status" => $row['status'],
            ];
        }

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json");
        echo json_encode($J);
    }
    public function toggleStatus($ID)
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Verifica se a conexão foi bem-sucedida
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        // Obtém o status atual
        $queryStatus = "SELECT status FROM Usuarios WHERE ID = $ID";
        $result = $con->query($queryStatus);

        if ($result) {
            $row = $result->fetch_assoc();
            $statusAtual = $row['status'];

            // Alterna entre 'ATIVADO' e 'DESATIVADO'
            $novoStatus = ($statusAtual == 'ativado') ? 'desativado' : 'ativado';

            // Atualiza o status
            $queryUpdate = "UPDATE Usuarios SET status = '$novoStatus' WHERE ID = $ID";

            if ($con->query($queryUpdate) === TRUE) {
                echo "Registro atualizado com sucesso. Novo status: $novoStatus";
            } else {
                echo "Erro na atualização: " . $con->error;
            }
        } else {
            echo "Erro ao obter o status atual: " . $con->error;
        }
    }

    public function SessaoUsuario($email)
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Verifica se a conexão foi bem-sucedida
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }
        
        $email = $con->real_escape_string($email); // Prevenir SQL injection

        $sql = "SELECT ID, nome, curso, rm, email, status FROM Usuarios WHERE email = '$email'";
        $result = $con->query($sql);

        // Verifique se a consulta foi bem-sucedida
        if ($result) {
            // Transforme o resultado em um array associativo
            $dados = $result->fetch_assoc();

            // Verifique se algum resultado foi encontrado
            if ($dados) {
                return json_encode($dados);
            } else {
                return json_encode(array("erro" => "Nenhum usuário encontrado com o e-mail fornecido."));
            }
        } else {
            return json_encode(array("erro" => "Erro na consulta ao banco de dados: " . $con->error));
        }
    }

    public function createAluno($nome, $email, $senha, $rm, $curso, $type){
        $con = $this->connect();

        $sql = "INSERT INTO Usuarios (nome, email, senha, rm, curso, type) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssss", $nome, $email, $senha, $rm, $curso, $type);

        if ($stmt->execute()) {
            return json_encode(array("mensagem" => "Adicionado com sucesso!"));
        } else {
            return json_encode(array("erro" => "Erro ao inserir usuario."));
        }
    }  

}
