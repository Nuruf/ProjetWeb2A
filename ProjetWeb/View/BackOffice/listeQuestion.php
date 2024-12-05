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
include '../../Controller/QuestionController.php';
$id=$_GET['id'];
$Question= new QuestionController();
$liste=$Question->listQuestion($id);
?>

    <br>

<h1 align='center'>Liste des Question pour ce quiz</h1>
<br>

<table class="styled-table" align='center' border="2">
    <thead>
        <tr>
        <th>Id du question</th>
            <th>Id du quiz</th>
            <th> question</th>
            <th>points du question</th> 
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($liste)): ?>
            <?php foreach ($liste as $Question): ?>
                <tr>
                    <td><?php echo $Question['id_question']; ?></td>
                    <td><?php echo $Question['idquiz']; ?></td>
                    <td><?php echo $Question['question_text']; ?></td>
                    <td><?php echo $Question['points']; ?></td>
                    <td>
                    <a href="listeReponces.php?id=<?php echo $Question['id_question'];?>" >Afficher la liste des reponses</a><br><br>
                        
            <a href="deletequestion.php?id=<?php echo $Question['id_question'];?>" onclick="return confirm('Voulez-vous vraiment supprimer cette question ?');">Supprimer cette question</a><br><br>
            <a href="updateQUESTION+REPONSES.php?id=<?php echo $Question['id_question']; ?>&quiz_id=<?php echo $Question['idquiz']; ?>">Modifier cette question</a>

            </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Aucune question trouvée.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


</html>