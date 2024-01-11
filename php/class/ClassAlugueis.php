<?php
include("ClassConnect.php");

class ClassAlugueis extends DbConnect
{


    public function updateAprovado($IDs)
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Verifica se a conexão foi bem-sucedida
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        $query = "UPDATE Armarios_Aluguel
        SET status = 'pendente'
        WHERE IDs = $IDs";

        if ($con->query($query) === TRUE) {
            echo "Registro atualizado com sucesso.";
        } else {
            echo "Erro na atualização: " . $con->error;
        }
    }

    public function StatusAprovado($IDs)
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Verifica se a conexão foi bem-sucedida
        if ($con->connect_error) {
            die("Falha de conexão com o MySQL: " . $con->connect_error);
        }

        // Obtém o status atual
        $queryStatus = "SELECT statusAluguel FROM Armarios_Aluguel WHERE IDs = $IDs";
        $result = $con->query($queryStatus);

        if ($result) {
            $row = $result->fetch_assoc();
            $statusAtual = $row['statusAluguel'];

            // Alterna entre 'PENDENTE' e 'APROVADO'
            $novoStatus = ($statusAtual == 'pedente') ? 'pedente' : 'aprovado';

            // Atualiza o status
            $queryUpdate = "UPDATE Armarios_Aluguel SET statusAluguel = '$novoStatus' WHERE IDs = $IDs";

            if ($con->query($queryUpdate) === TRUE) {
            } else {
            }
        } else {
            echo "Erro ao obter o status atual: " . $con->error;
        }
    }
    function atualizarAprovadoStatus($IDs)
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Inicia a transação
        mysqli_begin_transaction($con);

        try {
            // Primeiro update
            $sqlUpdate1 = "UPDATE armarios_aluguel SET status = 'alugado' WHERE IDs = ?";
            $stmt1 = mysqli_prepare($con, $sqlUpdate1);
            mysqli_stmt_bind_param($stmt1, 'i', $IDs);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_close($stmt1);

            // Segundo update (baseado no resultado do primeiro)
            $sqlUpdate2 = "UPDATE armarios_aluguel SET statusAluguel = 'aprovado' WHERE IDs = ? AND status = 'alugado'";
            $stmt2 = mysqli_prepare($con, $sqlUpdate2);
            mysqli_stmt_bind_param($stmt2, 'i', $IDs);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);

            // Se ambos os updates foram bem-sucedidos, confirma a transação
            mysqli_commit($con);
        } catch (Exception $e) {
            // Se ocorrer um erro, desfaz a transação
            mysqli_rollback($con);

            // Trata o erro ou registra para investigação
            echo "Erro: " . $e->getMessage();
        }
    }
    function atualizarNegadoStatus($IDs)
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Inicia a transação
        mysqli_begin_transaction($con);

        try {
            // Primeiro update
            $sqlUpdate1 = "UPDATE armarios_aluguel SET status = 'ativado' WHERE IDs = ?";
            $stmt1 = mysqli_prepare($con, $sqlUpdate1);
            mysqli_stmt_bind_param($stmt1, 'i', $IDs);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_close($stmt1);

            // Segundo update (baseado no resultado do primeiro)
            $sqlUpdate2 = "UPDATE armarios_aluguel SET statusAluguel = 'negado' WHERE IDs = ? AND status = 'ativado'";
            $stmt2 = mysqli_prepare($con, $sqlUpdate2);
            mysqli_stmt_bind_param($stmt2, 'i', $IDs);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);

            // Se ambos os updates foram bem-sucedidos, confirma a transação
            mysqli_commit($con);
        } catch (Exception $e) {
            // Se ocorrer um erro, desfaz a transação
            mysqli_rollback($con);

            // Trata o erro ou registra para investigação
            echo "Erro: " . $e->getMessage();
        }
    }
    function atualizarPendenteStatus($IDs, $pagamento, $ID)
    {
        $con = $this->connect(); // Obtém a conexão mysqli

        // Inicia a transação
        mysqli_begin_transaction($con);

        try {
            // Inserir dados na tabela Armarios_Aluguel usando informações da tabela Usuarios com base no ID
            $sqlUpdate3 = "UPDATE Armarios_Aluguel
                SET rm = (SELECT rm FROM Usuarios WHERE ID = ?),
                    nome = (SELECT nome FROM Usuarios WHERE ID = ?),
                    ID = (SELECT ID FROM Usuarios WHERE ID = ?)
                WHERE IDs = ?";
            $stmtUpdate3 = mysqli_prepare($con, $sqlUpdate3);
            mysqli_stmt_bind_param($stmtUpdate3, 'iiii', $ID, $ID, $ID, $IDs);
            mysqli_stmt_execute($stmtUpdate3);
            mysqli_stmt_close($stmtUpdate3);

            $sqlUpdate3 = "UPDATE armarios_aluguel SET pagamento = ? WHERE IDs = ?";
            $stmtUpdate3 = mysqli_prepare($con, $sqlUpdate3);
            mysqli_stmt_bind_param($stmtUpdate3, 'si', $pagamento, $IDs);
            mysqli_stmt_execute($stmtUpdate3);
            mysqli_stmt_close($stmtUpdate3);

            // Primeiro update
            $sqlUpdate1 = "UPDATE armarios_aluguel SET status = 'pendente' WHERE IDs = ?";
            $stmt1 = mysqli_prepare($con, $sqlUpdate1);
            mysqli_stmt_bind_param($stmt1, 'i', $IDs);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_close($stmt1);

            // Segundo update (baseado no resultado do primeiro)
            $sqlUpdate2 = "UPDATE armarios_aluguel SET statusAluguel = 'pendente' WHERE IDs = ? AND status = 'pendente'";
            $stmt2 = mysqli_prepare($con, $sqlUpdate2);
            mysqli_stmt_bind_param($stmt2, 'i', $IDs);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);



            // Se todos os updates e inserções foram bem-sucedidos, confirma a transação
            mysqli_commit($con);

            return ['error' => false, 'message' => 'Atualização bem-sucedida.'];
        } catch (Exception $e) {
            // Se ocorrer um erro, desfaz a transação
            mysqli_rollback($con);

            // Trata o erro ou registra para investigação
            return ['error' => true, 'message' => 'Erro: ' . $e->getMessage()];
        }
    }
}
