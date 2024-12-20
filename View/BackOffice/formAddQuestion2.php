<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>SKILL SWAP</title>
    <link rel="stylesheet" href="../BackOffice/styleForm11.css">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard1.css">
    
</head>

    
    <script>
        // Function to show the selected section and hide others
        function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => {
                section.style.display = 'none';
            });

            // Show the selected section
            const selectedSection = document.getElementById(sectionId + '-content');
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        }

        // Show the first section by default
        document.addEventListener('DOMContentLoaded', () => {
            showSection('profile');
        });
    </script>

 
</head>

    <h2 align="center">Ajouter un question </h2>

    <?php
    $quiz_id= $_GET['id'];
    

    

    
    echo "<form align='center' action='ADDQues+Rep2.php?id=" . $quiz_id . "' method='post' onsubmit='return validateForm();'>";



    
    echo "<label for='question'>Question :</label>";
    echo "<input type='text' id='question' name='questions'><br>";
    echo "<p id=m5></p>";

    echo "<label for='points'>Points :</label>";
    echo "<input type='number' id='points' name='pointsQ'><br>";
     echo "<p id=m6></p>";


    for ($j = 1; $j <= 4; $j++) {
        echo "<div>";
        echo "<label for='answer_$j'>Réponse $j :</label>";
        echo "<input type='text' id='answer_$j' name='answers$j'><br>";
        echo "<p id='m$j'></p>";

        echo "</div>";

        echo "<label for='correct_$j'>Correct</label>";
        echo "<input type='radio' id='correct_$j' name='correct' value='$j' ><br>";
        
    }

    // Bouton suivant pour chaque question
    echo "<div align='center'>";
    echo "<button type='submit'id='specialBUTTON'>Enregistrer</button>";
    echo "</div>";

    echo "</div>";  // Fermeture du conteneur de la question
    echo "</form>";  // Fermeture du formulaire pour la question actuelle
    ?>




</html>
   <script>
        function validateForm() {
            const question = document.getElementById(`question`).value;
            const points = document.getElementById(`points`).value;
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
                const answer = document.getElementById(`answer_${j}`);
                const radio = document.getElementById("correct_"+j);

                if (!answer || answer.value.trim() === "") {
                    message+="* La réponse "+j+" ne doit pas être vide.\n";
                   
                }

                if (radio && radio.checked) {
                    correctAnswerSelected = true;
                }
            }

/*
            for (let j = 1; j <= 4; j++) {
        const answer = document.getElementById("answer_"+j);
        if (!answer || answer.value === "") {
            message += "* La réponse "+j+" ne doit pas être vide.\n";
        }
        const correct = document.getElementById("correct_"+j).value;
        // Vérifier si une des réponses est correcte
            if (correct) {
                correctAnswerSelected = true;
            }
        }
    
*/
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
        var t=document.getElementById("question").value;
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
        var reponse1=document.getElementById("answer_1").value;
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
        var reponse2=document.getElementById("answer_2").value;
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
        var reponse3=document.getElementById("answer_3").value;
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
        var reponse4=document.getElementById("answer_4").value;
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
        var nbP=document.getElementById("points").value;
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
    document.querySelector("#points").addEventListener("keyup", validernbPoints);
    document.querySelector("#question").addEventListener("keyup",validerQuestion);
    document.querySelector("#answer_1").addEventListener("keyup",validerReponse1);
    document.querySelector("#answer_2").addEventListener("keyup",validerReponse2);
    document.querySelector("#answer_3").addEventListener("keyup",validerReponse3);
    document.querySelector("#answer_4").addEventListener("keyup",validerReponse4);



    </script>