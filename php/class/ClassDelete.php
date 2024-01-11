<?php
error_reporting(0); // Desativa a exibição de erros e avisos

include("ClassConnect.php");

class ClassDelete extends DbConnect
{
    public function deleteArmario($IDs) {
        $con = $this->connect(); // Obtém a conexão mysqli
        $stmt = $con->prepare("DELETE FROM Armarios_Aluguel WHERE IDs = ? ");
        $stmt->bind_param("i", $IDs);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteArovacao($IDs) {
        $con = $this->connect(); // Obtém a conexão mysqli
        $stmt = $con->prepare("DELETE FROM Armarios_Aluguel WHERE IDs = ? ");
        $stmt->bind_param("i", $IDs);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}