<?php
include '../../Model/historique.php';
include '../../Controller/historiqueController.php';

include '../../Controller/QuizController.php';
// Exemple des données du résultat

$id_quiz = $_GET["quiz_id"];
$points_obtenus = $_GET["point_obtenus"];
$total_points =$_GET["total_points"];
$date_Validation =date('Y-m-d');

$quizController = new QuizController();
$quiz = $quizController->getQuizById($id_quiz);
$note = (string)$points_obtenus . "/" . (string)$total_points;

if ($quiz) {
    $titre = $quiz['nomQuiz'];
    $description = $quiz['description1'];
$historique = new historique($id_quiz,$titre,$description,$note,$date_Validation);
    $historiqueC = new HistoriqueController();
   
    $historiqueC->addHistorique($historique);


}
header("Location: listehistorique.php");
?>

