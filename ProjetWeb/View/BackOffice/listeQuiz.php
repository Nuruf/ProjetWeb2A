<!DOCTYPE html>
<html lang="fr">
<link rel="styleSheet" href="../BackOffice/styleliste.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>SKILL SWAP</title>


    <style>
        .search-bar {
        text-align: center;
        margin: 20px 0;
    }

    .search-bar input {
        padding: 12px 20px;
        font-size: 16px;
        width: 60%;
        border: 1px solid #007bff;
        border-radius: 8px;
        outline: none;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .search-bar input:focus {
        border-color: #0056b3;
        box-shadow: 0px 4px 8px rgba(0, 91, 187, 0.3);
    }

    .search-bar button {
        padding: 12px 20px;
        font-size: 16px;
        margin-left: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-bar button:hover {
        background-color: #0056b3;
    }

</style>
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
include '../../Controller/QuizController.php';
$Quizz= new QuizController();
$liste=$Quizz->listquiz();
?>


<h1 align='center'>Liste des Quizz</h1>

<a align='center' href="formulaireAddQuiz.php">Ajouter un Quiz</a>



<div class="search-bar">
            <input type="text" id="searchInput" placeholder="Rechercher un quiz..." onkeyup="filterTable()">
            <button onclick="filterTable()">Rechercher</button>
        
<table   id="quizTable" class="styled-table" align='center' border="2">
    <thead>
        <tr>
        <th class="quiz-id">ID</th>
            <th class="quiz-title">Title</th>
            <th class="quiz-description">Description</th>
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($liste)): ?>
            <?php foreach ($liste as $quiz): ?>
                <tr>
                    <td><?php echo $quiz['idquiz']; ?></td>
                    <td><?php echo $quiz['nomQuiz']; ?></td>
                    <td><?php echo $quiz['description1']; ?></td>
                    <td>
                    <a href="listeQuestion.php?id=<?php echo $quiz['idquiz'];?>" >Afficher la liste des questions</a> <br><br>
                    <a href="formAddQuestion2.php?id=<?php echo $quiz['idquiz'];?>">Ajouter une question</a><br><br>
                    <a href="updateQuiz.php?id=<?php echo $quiz['idquiz'];?>">Modifier ce quiz</a><br><br>
                    
            <a href="deleteQuiz.php?id=<?php echo $quiz['idquiz'];?>" onclick="return confirm('Voulez-vous vraiment supprimer ce Quiz ?');">Supprimer ce quiz</a>
            </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Aucune offre trouvée.</td>
            </tr>
        <?php endif; ?>
        </div>

    </tbody>
</table>

<script>
 function filterTable() {
            const filter = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#quizTable tbody tr');

            rows.forEach(row => {
                const id = row.children[0].textContent.toLowerCase();
                const title = row.children[0].textContent.toLowerCase();
                const description = row.children[1].textContent.toLowerCase();
                row.style.display = id.includes(filter) ||title.includes(filter) || description.includes(filter) ? '' : 'none';
            });
        }

</script>

</html>