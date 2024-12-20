<?php
include(__DIR__ . '/../model/contenu.php');
include(__DIR__ . '/../controller/CategoryController.php');

class contenuController
{
    // List all contenus
    public function listContenus()
    {
        $sql = "SELECT * FROM contenu";
        $db = DatabaseConfig::getConnexion();
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
        $db = DatabaseConfig::getConnexion();
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
        // Ajouter un contenu avec la clé étrangère
        function addContenu($contenu,$idCat)
        {
            $sql = "INSERT INTO contenu (nomContenu, descriptionContenu, idCat) VALUES (:nomContenu, :descriptionContenu, :idCat)";
            $db = DatabaseConfig::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->execute([
                    'nomContenu' => $contenu->getNomContenu(),
                    'descriptionContenu' => $contenu->getDescriptionContenu(),
                    'idCat' => $idCat
                ]);
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    
        // Mettre à jour un contenu avec la clé étrangère
        function updateContenu($contenu, $idContenu)
        {
            try {
                $db = DatabaseConfig::getConnexion();
    
                $query = $db->prepare(
                    'UPDATE contenu SET 
                        nomContenu = :nomContenu,
                        descriptionContenu = :descriptionContenu,
                        idCat = :idCat
                    WHERE idContenu = :idContenu' 
                );
    
                $query->execute([
                    'idContenu' => $idContenu,
                    'nomContenu' => $contenu->getNomContenu(),
                    'descriptionContenu' => $contenu->getDescriptionContenu(),
                    'idCat' => $contenu->getIdCat() // Mettre à jour la référence catégorie
                ]);
    
                echo $query->rowCount() . " contenu(s) mis à jour avec succès <br>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage(); 
            }
        }

    // Show a single contenu by idCat
    public function listContenuByIdCat($idCat)
    {
        $sql = "SELECT * FROM contenu WHERE idCat = :idCat"; 
        $db = DatabaseConfig::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':idCat', $idCat);
            $query->execute();
            return $query->fetchAll(); // Fetch all content for the specific category
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Show a single contenu by ID
    function showContenuById($idContenu)
    {
        $sql = "SELECT * FROM contenu WHERE idContenu = :idContenu";
        $db = DatabaseConfig::getConnexion();
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