
<?php
include '../../Model/question.php';
include '../../Model/reponses.php';
include '../../Controller/QuestionController.php';
include '../../Controller/ReponseController.php';

//$quiz_id = isset($_GET['quiz_id']) ? $_GET['quiz_id'] : null;

$num_questions=$_GET['num_questions'];
$current_question=$_GET['i'];
$quiz_id=$_GET['quiz_id'];


if(!empty($_GET['quiz_id']))
{
    


    
   
    $question = new Questions($_GET['quiz_id'],$_POST['questions'],$_POST['pointsQ']);
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

    


}
$current_question++;
if($current_question==$num_questions)
header("Location: listeQuiz.php");
else
header('Location:FORMULAIRE3.php?quiz_id=' . $quiz_id . '&num_questions=' . $num_questions . '&i=' . $current_question);




?>