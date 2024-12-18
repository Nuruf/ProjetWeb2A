<!DOCTYPE html>
<html lang="fr">

<link rel="styleSheet" href="../BackOffice/styleliste1.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard1.css">
    
</head>
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