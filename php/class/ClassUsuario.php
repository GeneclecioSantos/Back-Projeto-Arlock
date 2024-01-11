<?php
include("ClassConnect.php");

class ClassUsuario extends DbConnect {

    public function exibirFuncionarios() {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Verifica se a conexão foi bem-sucedida
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        $query = "SELECT ID, nome, email FROM Usuarios WHERE type LIKE 'adm%'";

        $result = $con->query($query);

        if (!$result) {
            die("Erro na consulta: " . $con->error);
        }

        $J = [];
       

        while ($row = $result->fetch_assoc()) {
            $J[] = [
                "ID" => $row['ID'],
                "nome" => $row['nome'],
                "email" => $row['email']
                
            ];
            
        }

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json");
        echo json_encode($J);
    }

    public function createUsuarios($nome, $email, $type, $senha){
        $con = $this->connect();

        $create = "INSERT INTO Usuarios (nome, email, type, senha) VALUES (?, ?, ?, ?)";
        
        $stmt = $con->prepare($create);
        $stmt->bind_param("ssss", $nome, $email, $type, $senha);

        if ($stmt->execute()) {
            return json_encode(array("mensagem" => "Usuario inserido com sucesso!"));
        } else {
            return json_encode(array("erro" => "Erro ao Usuario o armário."));
        }
    }
    
}
