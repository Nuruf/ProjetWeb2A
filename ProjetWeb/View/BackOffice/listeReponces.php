<!DOCTYPE html>
<html lang="fr">

<link rel="styleSheet" href="../BackOffice/styleliste.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    
</head>
<div class="user-info">
        <img src="logoo.png" alt="User Profile">
        <span>bienvenue sur notre site  : username</span>
    </div>
    <nav>
        <ul>
            <li><a href="#profile" onclick="showSection('profile')">Profile</a></li>
            <li><a href="#forum" onclick="showSection('forum')">Forum</a></li>
            <li><a href="#skillSwap" onclick="showSection('skillSwapp')">Skill Swapp</a></li>
            <li><a href="#blog" onclick="showSection('blog')">Blog</a></li>
            <li><a href="listeQuiz.php" onclick="showSection('quiz')">Quiz</a></li>
            <li><a href="#Reclamation" onclick="showSection('reclamation')">Réclamation</a></li>
        </ul>
    </nav>


<?php
include '../../Controller/ReponseController.php';
$id=$_GET['id'];
$Reponse= new ReponsesController();
$liste=$Reponse->listReponses($id);
?>

    <br>

<h1 align='center'>Liste des reponses pour cette question</h1>
<br>

<table class="styled-table" align='center' border="2">
    <thead>
        <tr>
        <th>Id de la reponse</th>
            <th>Id de la question</th>
            <th> la reponse</th>
            <th>correcte (1:correcte / 0:fausse)</th> 
            
        </tr>
    </thead>
    <tbody>
        
            <?php foreach ($liste as $Reponse): ?>
                <tr>
                    <td><?php echo $Reponse['id_reponse']; ?></td>
                    <td><?php echo $Reponse['id_question']; ?></td>
                    <td><?php echo $Reponse['reponse_text']; ?></td>
                    <td><?php echo $Reponse['is_correct']; ?></td>
                    
                    
           
           
            </td>
                </tr>
            <?php endforeach; ?>
        
    </tbody>
</table>

</html>