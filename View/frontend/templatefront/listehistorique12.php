<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard1.css">
   <!-- <link rel="styleSheet" href="../BackOffice/styleliste.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
include '../../Controller/historiqueController.php';
$historiqueC= new HistoriqueController();
$liste=$historiqueC->listHistorique();
?>


<h1 align='center'>Historiques</h1>


<table class="quiz-table" align='center' border="2">
    <thead>
        <tr>
        
            <th>Titre</th>
            <th>Description</th>
            <th>Note</th> 
            <th>Date De Remise</th> 
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($liste)): ?>
            <?php foreach ($liste as $historique): ?>
                <tr>
                    
                    <td><?php echo $historique['titre']; ?></td>
                    <td><?php echo $historique['description1']; ?></td>
                    <td><?php echo $historique['note']; ?></td>
                    <td><?php echo $historique['date_validation']; ?></td>
                 
                 
                    
           
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Aucune quiz trouvée.</td>
            </tr>
        <?php endif; ?>
        

    </tbody>
</table>



</html>
