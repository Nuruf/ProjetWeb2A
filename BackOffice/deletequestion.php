<link rel="styleSheet" href="../FrontOffice/style-liste.css">
<?php
include '../../Controller/ReponseController.php';

include '../../Controller/QuestionController.php';

$id=$_GET['id'];
$Reponse= new ReponsesController();
$Reponse->deletereponces($id);
$Question= new QuestionController();
$Question->deletequestions($id);

header("Location: listeQuestion.php?id=" . $id);
?>
