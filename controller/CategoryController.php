<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/categories.php');

class categoriesController{
    public function listCategories(){
        $sql = "SELECT * FROM categories";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteCategory($idCat){
        $sql = "DELETE FROM categories WHERE idCat = :idCat"; 
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idCat', $idCat);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addCategory($category){
        $sql = "INSERT INTO categories VALUES (NULL,:nomCat, :descriptionCat)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nomCat' => $category->getNomCat(),
                'descriptionCat' => $category->getDescriptioncat()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateCategory($category, $idCat){
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE categories SET 
                    nomCat = :nomCat,
                    descriptionCat = :descriptionCat
                WHERE idCat = :idCat' 
            );

            $query->execute([
                'idCat' => $idCat,
                'nomCat' => $category->getNomCat(),
                'descriptionCat' => $category->getDescriptioncat()]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }

    function showCategory($idCat){
        $sql = "SELECT * FROM categories WHERE idCat = :idCat"; 
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':idCat', $idCat);
            $query->execute();

            $category = $query->fetch(PDO::FETCH_ASSOC); 
            return $category;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>