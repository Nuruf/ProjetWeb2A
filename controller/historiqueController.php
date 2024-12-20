<?php
require_once 'C:\xampp\htdocs\projet web\conf.php';
class HistoriqueController{


    public function listHistorique($id)
    {
        $sql="SELECT * FROM historique WHERE id_user=$id ";
        $db=DatabaseConfig::getconnexion();
        try{
            $lists=$db->query($sql);
            return $lists->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }

    }

    public function addHistorique($Historique, $id_user) {
        $sql = "INSERT INTO historique (idquiz, titre, description1, note, date_validation, id_user) 
                VALUES (:idquiz, :titre, :description1, :note, :date_validation, :id_user)";
        $db = DatabaseConfig::getConnexion();
        $req = $db->prepare($sql);
       
        $req->execute([
            'idquiz' => $Historique->getIdquiz(),
            'titre' => $Historique->getTitre(),
            'description1' => $Historique->getDescription(),  // Utilisation de description1
            'note' => $Historique->getnote(),
            'date_validation' => $Historique->getDValidation(),
            'id_user' => $id_user
        ]);
    }
    
    
    
    public function countHistorique() {
        $sql = "SELECT COUNT(*) as total FROM historique";
        $db = DatabaseConfig::getConnexion();
        $req = $db->query($sql);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

}