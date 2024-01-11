<?php
include("ClassConnect.php");

class ClassArmario extends DbConnect
{
        public function exibirArmario()
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Verifica se a conexão foi bem-sucedida
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        $query = "SELECT * FROM Armarios_Aluguel";

        $result = $con->query($query);

        if (!$result) {
            die("Erro na consulta: " . $con->error);
        }

        $J = [];

        while ($row = $result->fetch_assoc()) {
            $J[] = [
                "IDs" => $row['IDs'],
                "letra" => $row['letra'],
                "numero" => $row['numero'],
                "status" => $row['status'],
                "curso" => $row['curso'],
                "nome" => $row['nome'],
                "rm" => $row['rm'],
                "pagamento" => $row['pagamento'],
                "statusAluguel" => $row['statusAluguel'],
            ];
        }

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json");
        echo json_encode($J);
    }

    public function createArmario($letra, $numero, $curso, $status)
    {
        $con = $this->connect();

        $sql = "INSERT INTO Armarios_Aluguel (letra, numero, curso, status) VALUES (?, ?, ?, ?)";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("siss", $letra, $numero, $curso, $status);

        if ($stmt->execute()) {
            return json_encode(array("mensagem" => "Armário inserido com sucesso!"));
        } else {
            return json_encode(array("erro" => "Erro ao inserir o armário."));
        }
    }   
}      


// Defina os cabeçalhos HTTP aqui antes de qualquer saída
// header("Access-Control-Allow-Origin: *");
// header("Content-type: application/json");
