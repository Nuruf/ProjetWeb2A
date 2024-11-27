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
                
                
            ]);?>
            <script>
            alert("Le quiz a ete modifier avec succes ");
            </script><?php
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


        public function getQuizById($quiz_id) {
            $sql = "SELECT nomQuiz, description1 FROM quiz WHERE idquiz = :quiz_id";
        
            // Connexion à la base de données
            $db = config::getconnexion(); 
        
            // Préparation et exécution de la requête
            $query = $db->prepare($sql);
            $query->bindParam(':quiz_id', $quiz_id, PDO::PARAM_INT);
            $query->execute();
        
            // Retourner les résultats
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        






}
    
    


?>