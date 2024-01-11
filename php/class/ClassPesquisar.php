<?php
error_reporting(0); // Desativa a exibição de erros e avisos

include("ClassConnect.php");

class ClassPesquisar extends DbConnect
{
    public function PesquisarRM($rm)
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Verifica se a conexão foi bem-sucedida
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        // Use uma declaração preparada para evitar injeção de SQL
        $pesquisar = "SELECT letra, numero, nome, curso, pagamento 
    FROM armarios_aluguel 
    WHERE RM LIKE ?";

        // Preparar a declaração
        $stmt = $con->prepare($pesquisar);

        // Verificar se a preparação foi bem-sucedida
        if (!$stmt) {
            die("Erro na preparação da consulta: " . $con->error);
        }

        // Vincular o parâmetro e definir o valor
        $param = $rm . "%";
        $stmt->bind_param("s", $param);

        // Executar a consulta preparada
        $stmt->execute();

        // Obter o resultado
        $result = $stmt->get_result();

        // Verificar se houve erro na execução
        if (!$result) {
            die("Erro na execução da consulta: " . $stmt->error);
        }

        $J = [];

        while ($row = $result->fetch_assoc()) {
            $J[] = [
                "letra" => $row['letra'],
                "numero" => $row['numero'],
                "nome" => $row['nome'],
                "curso" => $row['curso'],
                "pagamento" => $row['pagamento']
            ];
        }

        // Fechar a declaração e a conexão
        $stmt->close();
        $con->close();

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json");
        echo json_encode($J);
    }

    public function PesquisarCurso($curso)
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Verifica se a conexão foi bem-sucedida
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        // Use uma declaração preparada para evitar injeção de SQL
        $pesquisar = "SELECT IDs, letra, numero, curso, status 
    FROM armarios_aluguel 
    WHERE curso LIKE ?";

        // Preparar a declaração
        $stmt = $con->prepare($pesquisar);

        // Verificar se a preparação foi bem-sucedida
        if (!$stmt) {
            die("Erro na preparação da consulta: " . $con->error);
        }

        // Vincular o parâmetro e definir o valor
        $param = $curso . "%";
        $stmt->bind_param("s", $param);

        // Executar a consulta preparada
        $stmt->execute();

        // Obter o resultado
        $result = $stmt->get_result();

        // Verificar se houve erro na execução
        if (!$result) {
            die("Erro na execução da consulta: " . $stmt->error);
        }

        $J = [];

        while ($row = $result->fetch_assoc()) {
            $J[] = [
                "IDs" => $row['IDs'],
                "letra" => $row['letra'],
                "numero" => $row['numero'],
                "curso" => $row['curso'],
                "status" => $row['status']
            ];
        }

        // Fechar a declaração e a conexão
        $stmt->close();
        $con->close();

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json");
        echo json_encode($J);
    }
    public function AlunoPesquisarRM($rm)
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Verifica se a conexão foi bem-sucedida
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        // Use uma declaração preparada para evitar injeção de SQL
        $pesquisar = "SELECT rm,nome, curso
    FROM usuarios 
    WHERE RM LIKE ? AND type LIKE '%aluno%'";

        // Preparar a declaração
        $stmt = $con->prepare($pesquisar);

        // Verificar se a preparação foi bem-sucedida
        if (!$stmt) {
            die("Erro na preparação da consulta: " . $con->error);
        }

        // Vincular o parâmetro e definir o valor
        $param = $rm . "%";
        $stmt->bind_param("s", $param);

        // Executar a consulta preparada
        $stmt->execute();

        // Obter o resultado
        $result = $stmt->get_result();

        // Verificar se houve erro na execução
        if (!$result) {
            die("Erro na execução da consulta: " . $stmt->error);
        }

        $J = [];

        while ($row = $result->fetch_assoc()) {
            $J[] = [
                "rm" => $row['rm'],
                "nome" => $row['nome'],
                "curso" => $row['curso']
                
            ];
        }

        // Fechar a declaração e a conexão
        $stmt->close();
        $con->close();

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json");
        echo json_encode($J);
    }
    
    public function PesquisarNOME($nome)
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Verifica se a conexão foi bem-sucedida
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        // Use uma declaração preparada para evitar injeção de SQL
        $pesquisar = "SELECT ID, nome, email
        FROM usuarios 
        WHERE nome LIKE ? AND type LIKE 'adm%'";

        // Preparar a declaração
        $stmt = $con->prepare($pesquisar);

        // Verificar se a preparação foi bem-sucedida
        if (!$stmt) {
            die("Erro na preparação da consulta: " . $con->error);
        }

        // Vincular o parâmetro e definir o valor
        $param = $rm . "%";
        $stmt->bind_param("s", $param);

        // Executar a consulta preparada
        $stmt->execute();

        // Obter o resultado
        $result = $stmt->get_result();

        // Verificar se houve erro na execução
        if (!$result) {
            die("Erro na execução da consulta: " . $stmt->error);
        }

        $J = [];

        while ($row = $result->fetch_assoc()) {
            $J[] = [
                "ID" => $row['ID'],
                "nome" => $row['nome'],
                "email" => $row['email']
                
            ];
        }

        // Fechar a declaração e a conexão
        $stmt->close();
        $con->close();

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json");
        echo json_encode($J);
    }
}
