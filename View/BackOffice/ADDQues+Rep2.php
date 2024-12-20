
<?php

require_once 'C:\xampp\htdocs\projet web\controller\QuestionController.php';
require_once 'C:\xampp\htdocs\projet web\controller\ReponsessController.php';
require_once 'C:\xampp\htdocs\projet web\model\question.php';
require_once 'C:\xampp\htdocs\projet web\model\reponses.php';

//$quiz_id = isset($_GET['quiz_id']) ? $_GET['quiz_id'] : null;


$quiz_id=$_GET['id'];

echo "<script>console.log('dddddd');</script>";
if(!empty($_GET['id']))
{
    echo "<script>console.log('aaaaa');</script>";


    
   
    $question = new Questions($_GET['id'],$_POST['questions'],$_POST['pointsQ']);
    $questionC = new QuestionController();
   
    $question_id = $questionC->addQuestion($question);

    
    if ($question_id) {
        for ($j = 1; $j <= 4; $j++) {

        $reponseC = new ReponsesController();

       if ( $_POST['correct']==$j){
        $reponse1 = new Reponses($question_id, $_POST['answers'.$j], 1);
        $reponseC->addreponse($reponse1);
       }
       else{
        $reponse1 = new Reponses($question_id, $_POST['answers'.$j],0);
        $reponseC->addreponse($reponse1);
       }  
    }
}
header("Location: listeQuestion.php?id=" . $quiz_id);
}



?>