<?php
require_once(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/contenu.php');

class contenuController
{
    // List all contenus
    public function listContenus()
    {
        $sql = "SELECT * FROM contenu";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Delete a contenu by ID
    function deleteContenu($idContenu)
    {
        $sql = "DELETE FROM contenu WHERE idContenu = :idContenu"; 
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idContenu', $idContenu);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
        echo"test";
    }

    // Add a new contenu
    function addContenu($contenu)
    {
        $sql = "INSERT INTO contenu (nomContenu, descriptionContenu) VALUES (:nomContenu, :descriptionContenu)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nomContenu' => $contenu->getNomContenu(),
                'descriptionContenu' => $contenu->getDescriptionContenu()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Update an existing contenu
    function updateContenu($contenu, $idContenu)
    {
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE contenu SET 
                    nomContenu = :nomContenu,
                    descriptionContenu = :descriptionContenu
                WHERE idContenu = :idContenu' 
            );

            $query->execute([
                'idContenu' => $idContenu,
                'nomContenu' => $contenu->getNomContenu(),
                'descriptionContenu' => $contenu->getDescriptionContenu()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }

    // Show a single contenu by ID
    function showContenu($idContenu)
    {
        $sql = "SELECT * FROM contenu WHERE idContenu = :idContenu"; 
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':idContenu', $idContenu);
            $query->execute();

            $contenu = $query->fetch(PDO::FETCH_ASSOC); 
            return $contenu;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>