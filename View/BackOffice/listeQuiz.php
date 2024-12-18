<!DOCTYPE html>
<html lang="fr">
<link rel="styleSheet" href="../BackOffice/styleliste1.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard1.css">
    
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
        border-color: #3498db;
        box-shadow: 0px 4px 8px rgba(0, 91, 187, 0.3);
    }

    .search-bar button {
        padding: 12px 20px;
        font-size: 16px;
        margin-left: 10px;
        background-color: #3498db;
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
                <li><a href="listeQuiz.php" onclick="showSection('quiz')"><i class="fas fa-question-circle"></i> Quiz</a></li>
                <li><a href="#reclamation" onclick="showSection('reclamation')"><i class="fas fa-file-alt"></i> Réclamation</a></li>
            </ul>
        </nav>
    </aside>
    <main class="main-content">
        <header class="user-info">
            <span>Bienvenue, <b>username</b></span>
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
        </header>
    
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
  
<?php
include '../../Controller/QuizController.php';
$Quizz= new QuizController();
$liste=$Quizz->listquiz();
?>


<h1 align='center'>Liste des Quizz</h1>
<div class="add-quiz">
<a align='center' href="formulaireAddQuiz.php">Ajouter un Quiz</a>
    </div>


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