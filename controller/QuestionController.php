<?php

require_once 'C:\xampp\htdocs\projet web\conf.php'; 
require_once 'C:\xampp\htdocs\projet web\model\comment.php'; 

class QuestionController{

    public function listQuestion($id)
    {
        $sql="SELECT * FROM question WHERE idquiz=$id ";
        $db=DatabaseConfig::getconnexion();
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
        $db=DatabaseConfig::getConnexion();
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
        $sql = "INSERT INTO question VALUES (:idquiz, null, :question_text, :points)";
        $db=DatabaseConfig::getConnexion();
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
                $db=DatabaseConfig::getconnexion();
                $query=$db->prepare(
                'UPDATE question SET
                question_text=:question_text,
                points=:points
                WHERE id_question=:id'
                );
                $query->execute([
                    'id' => $id,
                    'question_text'=>$question->getquestion(),
                    'points'=>$question->getPoints()
                    
                    
                ]);
               }catch(Exception $e){
                die('Error:'.$e->getMessage());
            }
    
    
            }
    
             function getNumberOfQuestions($quizId) {
                $db=DatabaseConfig::getconnexion();
                $stmt = $db->prepare("SELECT COUNT(*) as question_count FROM question WHERE idquiz = :quiz_id");
                $stmt->bindParam(':quiz_id', $quizId, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['question_count'] ?? 0;
            }


            function showQuestion($id)
            {
                $sql = "SELECT * from question where id_question = $id";
                $db = DatabaseConfig::getConnexion();
                try {
                    $query = $db->prepare($sql);
                    $query->execute();
        
                    $quiz = $query->fetch();
                    return $quiz;
                } catch (Exception $e) {
                    die('Error: ' . $e->getMessage());
                }
            }
        }
    


?>