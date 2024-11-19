<?php
include_once '../../config.php';
class QuestionController{

    public function listQuestion($id)
    {
        $sql="SELECT * FROM question WHERE idquiz=$id ";
        $db=config::getconnexion();
        try{
            $lists=$db->query($sql);
            return $lists;
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }

    }

    function deletequestions($id)
    {
        $sql= "DELETE FROM question WHERE id_question= :id";
        $db=config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id',$id);
        try{
            $req->execute();?>
            <script>
            alert("La question a ete supprimer avec succes ");
            </script><?php
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }
    }




    public function addQuestion($question) {
        $sql = "INSERT INTO question VALUES (null, :idquiz, :question_text, :points)";
        $db=config::getConnexion();
        $req = $db->prepare($sql);
       
        $req->execute([
            'idquiz' => $question->getIdquiz1(),
            'question_text' => $question->getquestion(),
            'points' => $question->getPoints(),
        ]);
       
        return $db->lastInsertId();
    }


    
    



        function updatequestion($question,$id)
        {
            try{
                $db=config::getconnexion();
                $query=$db->prepare(
                'UPDATE question SET
                question_text=:question_text,
                points=:points
                WHERE id_question=:id'
                );
                $query->execute([
                    'id' => $id,
                    'question_text'=>$question->getquestion(),
                    ' points'=>$question->getPoints()
                    
                    
                ]);
               }catch(Exception $e){
                die('Error:'.$e->getMessage());
            }
    
    
            }
    
    
        }
    


?>