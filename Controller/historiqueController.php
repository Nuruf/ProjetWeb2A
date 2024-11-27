<?php
include_once '../../config.php';
class HistoriqueController{

    public function listHistorique()
    {
        $sql="SELECT * FROM historique";
        $db=config::getconnexion();
        try{
            $lists=$db->query($sql);
            return $lists;
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



}