<?php

include '../../../Controller/QuestionController.php';
include '../../../Controller/ReponsessController.php';


$id_quiz = $_GET['id']; 


$reponses_soumises = $_POST;


$Question = new QuestionController();
$Reponse = new ReponsesController();

$liste_questions = $Question->listQuestion($id_quiz);
$total_points = 0;
$points_obtenus = 0;


if (!empty($liste_questions)) {
    
    foreach ($liste_questions as $question) {
        $total_points += $question['points']; 
        $id_question = $question['id_question'];

        
        $reponse_correcte = $Reponse->getCorrectAnswer($id_question); 
 

        // Vérifier si l'utilisateur a soumis une réponse pour cette question
        if (isset($reponses_soumises["reponse_$id_question"])) {
            $reponse_utilisateur = $reponses_soumises["reponse_$id_question"];

            // Comparer l'ID de la réponse utilisateur avec l'ID de la réponse correcte
            if ($reponse_utilisateur == $reponse_correcte['id_reponse']) {
                $points_obtenus += $question['points']; // Ajouter des points si la réponse est correcte
            }
        }
    }

    
}
?>
 <script>
    
    alert("Vous avez obtenu <?php echo $points_obtenus; ?> sur <?php echo $total_points; ?> points.");

    
    window.location.href = "AddHistorique.php?quiz_id=<?php echo $id_quiz; ?>&point_obtenus=<?php echo $points_obtenus; ?>&total_points=<?php echo $total_points; ?>";
</script>
