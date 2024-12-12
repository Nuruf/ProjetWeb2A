<?php
include_once '../../config.php';
class HistoriqueController{

    public function listHistorique()
    {
        $sql="SELECT * FROM historique";
        $db=config::getconnexion();
        try{
            $lists=$db->query($sql);
            return $lists->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }

    }

    public function addHistorique($Historique) {
        $sql = "INSERT INTO historique VALUES (null, :idquiz, :titre, :description1 , :note , :date_validation )";
        $db=config::getConnexion();
        $req = $db->prepare($sql);
       
        $req->execute([
            'idquiz' => $Historique->getIdquiz(),
            'titre' => $Historique->getTitre(),
            'description1' => $Historique->getDescription(),
            'note' => $Historique->getnote(),
            'date_validation' => $Historique->getDValidation()

        ]);
       
        
    }

    public function countHistorique() {
        $sql = "SELECT COUNT(*) as total FROM historique";
        $db = config::getConnexion();
        $req = $db->query($sql);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

}