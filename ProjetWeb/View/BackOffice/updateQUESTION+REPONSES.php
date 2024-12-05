<?php
include '../../Model/question.php';
include '../../Controller/QuestionController.php';

include '../../Model/reponses.php';
include '../../Controller/ReponseController.php';

// Instantiation des contrôleurs
$questionC = new QuestionController();
$reponseC = new ReponsesController();

$question = null;
$responses = null;

if (isset($_GET['id'])) {
    $question = $questionC->showQuestion($_GET['id']); // Récupérer la question
    $responses = $reponseC->listReponses($_GET['id']); // Récupérer les réponses associées
}

if (isset($_POST["nomQuestion"]) && isset($_POST["points"])) {
    if (!empty($_POST["nomQuestion"]) && !empty($_POST["points"])) {
        // Mise à jour de la question
        $question = new Questions(
            $_GET['quiz_id'],
            $_POST['nomQuestion'],
            $_POST['points']
        );
        $questionC->updateQuestion($question, $_GET['id']);

        // Mise à jour des réponses
        foreach ($_POST['responses'] as $id_reponse => $reponse_text) {
            $is_correct = ($_POST['correct'] == $id_reponse) ? 1 : 0;
            $reponse = new Reponses($_GET['id'], $reponse_text, $is_correct);
            $reponseC->updateReponse($reponse, $id_reponse);
        }

        header('Location: ListeQuestion.php?id=' . $_GET['quiz_id']);
        exit();
    } else {
        $error = "Informations manquantes.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleForm.css">
    <link rel="stylesheet" href="dashboard.css">
    <title>Modifier une question</title>
</head>

<body>
    <div class="user-info">
        <img src="logoo.png" alt="User Profile">
        <span>Bienvenue sur notre site : username</span>
    </div>

    <nav>
        <ul>
            <li><a href="#profile">Profile</a></li>
            <li><a href="#forum">Forum</a></li>
            <li><a href="#skillSwap">Skill Swap</a></li>
            <li><a href="#blog">Blog</a></li>
            <li><a href="listeQuestions.php">Questions</a></li>
            <li><a href="#Reclamation">Réclamation</a></li>
        </ul>
    </nav>

    <?php if ($question): ?>
        <h2 align="center">Modifier cette question</h2>

        <form align="center" action="" method="POST" onsubmit="return validateForm()">
            <label for="id">ID Question:</label><br>
            <input type="text" id="id" name="idquestion" readonly value="<?php echo $question['id_question']; ?>"><br>

            <label for="nomQuestion">Nom de la question :</label><br>
            <input type="text" id="nomQuestion" name="nomQuestion" value="<?php echo $question['question_text']; ?>"><br>
            <p id='m5'></p><br>

            <label for="pointsQ">Points :</label><br>
            <input type="number" id="pointsQ" name="points" value="<?php echo $question['points']; ?>"><br>
            <p id='m6'></p><br>

            <h3>Réponses :</h3>
            <?php $i = 0; foreach ($responses as $response): $i++; ?>
                <label for="id<?php echo $i; ?>">ID Réponse <?php echo $i; ?> :</label><br>
                <input type="text" id="id<?php echo $i; ?>" name="idreponses[<?php echo $response['id_reponse']; ?>]" readonly value="<?php echo $response['id_reponse']; ?>"><br>

                <label for="reponse<?php echo $i; ?>">Réponse <?php echo $i; ?> :</label><br>
                <input type="text" id="reponse<?php echo $i; ?>" name="responses[<?php echo $response['id_reponse']; ?>]" value="<?php echo $response['reponse_text']; ?>"><br>
                <p id='m<?php echo $i; ?>'></p><br>

                <label for="correct_<?php echo $i; ?>">Correct</label>
                <input type="radio" id="correct_<?php echo $i; ?>" name="correct" value="<?php echo $response['id_reponse']; ?>" <?php if ($response['is_correct'] == 1) echo "checked"; ?>><br><br>
            <?php endforeach; ?>

            <button type="submit">Modifier la question</button>
        </form>
    <?php else: ?>
        <p>Question non trouvée.</p>
    <?php endif; ?>

<script>
   function validateForm() {
            const question = document.getElementById(`nomQuestion`).value;
            const points = document.getElementById(`pointsQ`).value;
            let correctAnswerSelected = 0;
            var message="";

            // Validation de la question
            if (!question || question.length < 3) {
                message+="* La question  doit contenir au moins 3 caractères.\n";
               
               
            }

            // Validation des points
            if (!points || points.value <= 0) {
                message+="* Le nombre de points pour la question  doit être supérieur à 0.\n";
              
                
            }

            // Validation des réponses
            for (let j = 1; j <= 4; j++) {
                const answer = document.getElementById(`reponse${j}`);
                const radio = document.getElementById("correct_"+j);

                if (!answer || answer.value.trim() === "") {
                    message+="* La réponse "+j+" ne doit pas être vide.\n";
                   
                }

                if (radio && radio.checked) {
                    correctAnswerSelected = true;
                }
            }
            if (!correctAnswerSelected) {
                message+="* Veuillez sélectionner une bonne réponse.\n";
            
            }
            if (message !== "") {
                 alert(message); 
                     return false;
             } else {
                alert("* Le formulaire est rempli avec succès."); 
                      return true;
        }
    }


    function  validerQuestion(event) {
        event.preventDefault();
        var t=document.getElementById("nomQuestion").value;
        var messageQuestion=document.getElementById("m5");
        var valide=true;
        
    
        if(t.length<3){
            messageQuestion.innerText="* Le question doit contenir au moins 3 caractères";
            messageQuestion.style.color="red";
            valide=false;
        }
        else{
            messageQuestion.innerText="* correct";
            messageQuestion.style.color="green";
        }


    }

    function  validerReponse1(event) {
        event.preventDefault();
        var reponse1=document.getElementById("reponse1").value;
        var messagereponse1=document.getElementById("m1");
       
        if(reponse1.length<1 ){
            messagereponse1.innerText="* La reponse doit contenir au moins 1 caractère";
            messagereponse1.style.color="red";
            valide=false;
        }
        else{
            messagereponse1.innerText="* correct";
            messagereponse1.style.color="green";
        }
    }

    function  validerReponse2(event) {
        event.preventDefault();
        var reponse2=document.getElementById("reponse2").value;
        var messagereponse2=document.getElementById("m2");
       
        if(reponse2.length<1 ){
            messagereponse2.innerText="* La reponse doit contenir au moins 1 caractère";
            messagereponse2.style.color="red";
            valide=false;
        }
        else{
            messagereponse2.innerText="* correct";
            messagereponse2.style.color="green";
        }
    }

    function  validerReponse3(event) {
        event.preventDefault();
        var reponse3=document.getElementById("reponse3").value;
        var messagereponse3=document.getElementById("m3");
       
        if(reponse3.length<1 ){
            messagereponse3.innerText="* La reponse doit contenir au moins 1 caractère";
            messagereponse3.style.color="red";
            valide=false;
        }
        else{
            messagereponse3.innerText="* correct";
            messagereponse3.style.color="green";
        }
    }

    function  validerReponse4(event) {
        event.preventDefault();
        var reponse4=document.getElementById("reponse4").value;
        var messagereponse4=document.getElementById("m4");
       
        if(reponse4.length<1 ){
            messagereponse4.innerText="* La reponse doit contenir au moins 1 caractère";
            messagereponse4.style.color="red";
            valide=false;
        }
        else{
            messagereponse4.innerText="* correct";
            messagereponse4.style.color="green";
        }
    }
    

    function  validernbPoints(event) {
        event.preventDefault();
        var nbP=document.getElementById("pointsQ").value;
        var messagenbP=document.getElementById("m6");
        if (nbP<=0)
        {
            messagenbP.innerText="* Le nombre de points pour cette question doit être positif";
            messagenbP.style.color="red";
         
        }
        else{
            messagenbP.innerText="* correct.";
            messagenbP.style.color="green";
        }
    

    }
    document.querySelector("#pointsQ").addEventListener("keyup", validernbPoints);
    document.querySelector("#nomQuestion").addEventListener("keyup",validerQuestion);
    document.querySelector("#reponse1").addEventListener("keyup",validerReponse1);
    document.querySelector("#reponse2").addEventListener("keyup",validerReponse2);
    document.querySelector("#reponse3").addEventListener("keyup",validerReponse3);
    document.querySelector("#reponse4").addEventListener("keyup",validerReponse4);



</script>

</body>
<footer>
    <br>
    <br>
    <p>You can contact us at: <a href="mailto:yosrmoussa63@gmail.com">contact@esprit.tn</a></p>
    <p>1,2 rue André Ampère -2083</p>
    <p>Technological Pole - El Ghazala</p>
    <p align="center"> <small> Copyright © Your Website 2024</small></p>
</footer>
</html>
