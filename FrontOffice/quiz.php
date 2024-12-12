<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard1.css">
    
   <!-- <link rel="styleSheet" href="../BackOffice/styleliste.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        #timer {
            font-size: 1.5em;
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <script>
        let timeLeft = 60; // Temps en secondes (5 minutes)

        function startCountdown() {
            const timerDisplay = document.getElementById('timer');
            const quizForm = document.getElementById('quizForm');
            
            const countdown = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    alert("Temps écoulé ! Le quiz sera soumis automatiquement.");
                    quizForm.submit();
                } else {
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    timerDisplay.textContent = `Temps restant : ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                    timeLeft--;
                }
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', startCountdown);
    </script>
</head>
<body>
    <!-- Barre latérale -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="logoo.png" alt="Logo" class="logo">
            <h3>Dashboard</h3>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="#profile" onclick="showSection('profile')"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="#forum" onclick="showSection('forum')"><i class="fas fa-comments"></i> Forum</a></li>
                <li><a href="#skillSwap" onclick="showSection('skillSwapp')"><i class="fas fa-exchange-alt"></i> Skill Swap</a></li>
                <li><a href="#blog" onclick="showSection('blog')"><i class="fas fa-blog"></i> Blog</a></li>
                <li><a href="listeQuizFront.php" onclick="showSection('quiz')"><i class="fas fa-question-circle"></i> Quiz</a></li>
                <li><a href="#reclamation" onclick="showSection('reclamation')"><i class="fas fa-file-alt"></i> Réclamation</a></li>
            </ul>
        </nav>
    </aside>
    <main class="main-content">
        <header class="user-info">
            <span>Bienvenue, <b>username</b></span>
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
        </header>
    


<?php
include '../../Controller/QuestionController.php';
include '../../Controller/ReponseController.php';
$id=$_GET['id'];
$Question= new QuestionController();
$liste=$Question->listQuestion($id);
$Reponse= new ReponsesController();
$listeR=$Reponse->listReponses($id);
?>

    <br>

    <div id="timer">Temps restant : 1:00</div>
    <form id="quizForm" action="process_quiz.php?id=<?php echo $id;?>" method="POST">
<h1 align='center'>Liste des Questions pour ce quiz</h1>
<br>

<table class="quiz-container" align='center' border="0">

    <tbody>
        <?php
        $q=0;
        $r=0; 
        if (!empty($liste)): ?>
            <?php foreach ($liste as $Question):
                $q++;
               
                ?>
                <tr>

                <td class="question-text"><h3 style="color:blue">question <?php echo $q;?> :<?php echo $Question['question_text']; ?></h3></td>
<td>                                       </td>
<td>                                       </td>
                    <td class="question-text"><h3  style="color:blue;"><?php echo $Question['points']; ?> Points</h3></td></tr>
                   <?php $listeR=$Reponse->listReponses($Question['id_question']);?>
                   <?php foreach ($listeR as $reponse): 
                     $r++;?>
                    <tr><td class="question-text"><?php echo $reponse['reponse_text']; ?></td>
          
                    <td>
                    <label for='correct_<?php echo $q . "_" . $r; ?>'>Correct</label>
<input type='radio' id='correct_<?php echo $q . "_" . $r;?>' name='reponse_<?php echo $Question['id_question']; ?>' value='<?php echo $reponse['id_reponse']; ?>'><br>

</td>

                    
                    <?php endforeach; ?>
            
                   
                    
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Aucune question trouvée.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<p align="center"><button type="submit"  >Valider</button></p>
</form>
</html>