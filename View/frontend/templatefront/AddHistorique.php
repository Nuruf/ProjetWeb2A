
<?php
include '../../../model/historique.php';
include '../../../controller/historiqueController.php';

include '../../../controller/QuizController.php';
// Exemple des données du résultat

session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    // Rediriger vers la page de connexion si non connecté ou rôle incorrect
    header('Location: ../../frontend/templatefront/index.php');
    exit;
}


$pp= $_SESSION['user_id'];
/*************************/ 
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
$historique = new historique($id_quiz,$titre,$description,$note,$date_Validation,$pp);
    $historiqueC = new HistoriqueController();
   
    $historiqueC->addHistorique($historique,$pp);


}
header("Location: listehistorique.php");
?>

