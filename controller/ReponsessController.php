<?php
require_once 'C:\xampp\htdocs\projet web\conf.php';
require_once 'C:\xampp\htdocs\projet web\model\reponses.php';
class ReponsesController{




    public function listReponses($id)
    {
        $sql="SELECT * FROM reponses WHERE id_question=$id ";
        $db=DatabaseConfig::getconnexion();
        try{
            $lists=$db->query($sql);
            return $lists;
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }

    }


    
    public function updateReponse($reponse, $id) {
        $sql = "UPDATE reponses SET reponse_text = :reponse_text, is_correct = :is_correct WHERE id_reponse = :reponseId";
       $db=DatabaseConfig::getconnexion();
       try{
        $query=$db->prepare($sql);
        $query->execute([
            'reponse_text'=> $reponse->getreponse(),
            'is_correct'=> $reponse->getcorrect(),
            'reponseId'=>$id
        ]);
       }catch(Exception $e){
        die('Error:'.$e->getMessage());
    }
    }

    public function addreponse($reponse)
    {
       $sql="INSERT INTO reponses VALUES (NULL, :id_question, :reponse_text, :is_correct)"; 
       $db=DatabaseConfig::getconnexion();
       try{
        $query=$db->prepare($sql);
        $query->execute([
            'id_question'=>$reponse-> getidquestion(),
            'reponse_text'=> $reponse->getreponse(),
            'is_correct'=> $reponse->getcorrect(),
            
        ]);

       }catch(Exception $e){
        die('Error:'.$e->getMessage());
    }

    }
    function deletereponces($id)
    {
        $sql= "DELETE FROM reponses WHERE id_question= :id";
        $db=DatabaseConfig::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id',$id);
        try{
            $req->execute();
            
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }
    }


    function deletereponcesParQuiz($id)
    {
        $sql= "DELETE FROM reponses WHERE id_question IN (SELECT id_question FROM question WHERE idquiz = :id)";
        $db=DatabaseConfig::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id',$id);
        try{
            $req->execute();
            
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }
    }

    public function getCorrectAnswer($question_id) {
        // Préparer la requête pour récupérer la réponse correcte
        $sql = "SELECT id_reponse FROM reponses WHERE id_question =? AND is_correct = 1"; // `est_correct` est une colonne dans votre base de données
        $db=DatabaseConfig::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(1, $question_id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
        
    }

  


    }






    



?>