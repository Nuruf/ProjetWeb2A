<link rel="styleSheet" href="../FrontOffice/style-liste.css">
<?php
include '../../Controller/ReponseController.php';

include '../../Controller/QuestionController.php';

include '../../Controller/QuizController.php';

$id=$_GET['id'];
$Reponsec= new ReponsesController();
$Reponsec->deletereponcesParQuiz($id);
$Questionc= new QuestionController();
$Questionc->deletequestions($id);
$Quizc= new QuizController();
$Quizc->deleteQuiz($id);




header("Location: listeQuiz.php");
?>
