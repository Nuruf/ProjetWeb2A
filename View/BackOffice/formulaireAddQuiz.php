<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>SKILL SWAP</title>
    <link rel="styleSheet" href="styleForm11.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="../BackOffice/addTEST.js" defer></script>
    
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

    <button type="submit"id="specialBUTTON">Suivant</button>
</form>

</body>



</html>