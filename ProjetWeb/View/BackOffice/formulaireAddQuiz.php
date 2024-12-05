<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>SKILL SWAP</title>
    <link rel="styleSheet" href="styleForm.css">
    <link rel="styleSheet" href="../BackOffice/styleliste.css">
        <script src="../BackOffice/addTEST.js" defer></script>
    
</head>
<head>
    <meta charset="UTF-8">
    <title>SKILL SWAP</title>
    <link rel="stylesheet" href="../BackOffice/styleFormulaire.css">
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
<body>

<h2 align='center'>Ajouter un Nouveau Quiz </h2>

<form action="Addquiz.php" method="post" onsubmit="return validerFormulaire()" align='center'>
    <label for="test_name">Nom du Test :</label>
    <input type="text" id="test_name" name="test_name" >
    <p id="m1"></p>
    <br><br>
    <label for="description">Description :</label>
    <input type="text" id="description" name="description" >
    <p id="m2"></p>
    <br><br>
    <label for="num_questions">Nombre de Questions :</label>
    <input type="number" id="num_questions" name="num_questions" >
    <p id="m3"></p>
    <br><br>

    <button type="submit">Suivant</button>
</form>

</body>



</html>