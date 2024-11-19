<?php
include_once '../../config.php';
class QuizController{
   



    




    public function addquiz($quiz)
    {
       $sql="INSERT INTO quiz VALUES (NULL, :nomQuiz, :description1)"; 
       $db=config::getconnexion();
       try{
        $query=$db->prepare($sql);
        $query->execute([
            'nomQuiz'=>$quiz->getnomQ(),
            'description1'=> $quiz->getDescription(),
            
        ]);
      
      
        return $db->lastInsertId();
       }catch(Exception $e){
        die('Error:'.$e->getMessage());
    }
}

    public function listquiz()
    {
        $sql="SELECT * FROM quiz";
        $db=config::getconnexion();
        try{
            $lists=$db->query($sql);
            return $lists;
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }

    }



    function deleteQuiz($id)
    {
        $sql= "DELETE FROM quiz WHERE idquiz= :id";
        $db=config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id',$id);
        try{
            $req->execute();
            ?>
        <script>
            alert("Le quiz a ete supprimer avec succes ");
            </script><?php
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }
    }

/*

    }
    function deleteOffer($id)
    {
        $sql= "DELETE FROM traveloffer WHERE Id= :id";
        $db=config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id',$id);
        try{
            $req->execute();?>
            <script>
            alert("L'offer a ete supprimer avec succes ");
            </script><?php
        }
        catch(Exception $e){
            die('Error:'.$e->getMessage());
        }
    }
*/
    function updatequiz($quiz,$id)
    {
        try{
            $db=config::getconnexion();
            $query=$db->prepare(
            'UPDATE quiz SET
            nomQuiz=:nomQuiz,
            description1=:description1
            WHERE idquiz=:id'
            );
            $query->execute([
                'id' => $id,
                'nomQuiz'=>$quiz->getnomQ(),
                'description1'=> $quiz->getDescription()
                
                
            ]);
           }catch(Exception $e){
            die('Error:'.$e->getMessage());
        }


        }


        function showQuiz($id)
        {
            $sql = "SELECT * from quiz where idquiz = $id";
            $db = config::getConnexion();
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