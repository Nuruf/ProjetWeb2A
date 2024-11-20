<?php
include_once '../../config.php';
class ReponsesController{




    public function listReponses($id)
    {
        $sql="SELECT * FROM reponses WHERE id_question=$id ";
        $db=config::getconnexion();
        try{
            $lists=$db->query($sql);
            return $lists;
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }

    }


    
    public function updateReponse($reponse) {
        $sql = "UPDATE reponses SET answer_text = :answerText, is_correct = :isCorrect WHERE id = :reponseId";
       $db=config::getconnexion();
       try{
        $query=$db->prepare($sql);
        $query->execute([
            'answerText' => $answerText,
            'isCorrect' => $isCorrect,
            'reponseId' => $reponseId,
        ]);
       }catch(Exception $e){
        die('Error:'.$e->getMessage());
    }
    }

    public function addreponse($reponse)
    {
       $sql="INSERT INTO reponses VALUES (NULL, :id_question, :reponse_text, :is_correct)"; 
       $db=config::getconnexion();
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
        $db=config::getConnexion();
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
        $db=config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id',$id);
        try{
            $req->execute();
            
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }
    }

    

  


    }






    



?>