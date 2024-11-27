<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Barre latérale -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="logoo.png" alt="Logo" class="logo">
    
        </div>
        <nav class="menu">
            <ul>
                <li><a href="#profile" onclick="showSection('profile')"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="#forum" onclick="showSection('forum')"><i class="fas fa-comments"></i> Forum</a></li>
                <li><a href="#skillSwap" onclick="showSection('skillSwapp')"><i class="fas fa-exchange-alt"></i> Skill Swap</a></li>
                <li><a href="#blog" onclick="showSection('blog')"><i class="fas fa-blog"></i> Blog</a></li>
                <li><a href="#quiz" onclick="showSection('quiz')"><i class="fas fa-question-circle"></i> Quiz</a></li>
                <li><a href="#reclamation" onclick="showSection('reclamation')"><i class="fas fa-file-alt"></i> Réclamation</a></li>
            </ul>
        </nav>
    </aside>
    <?php

include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Model/modelUser.php';
include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Controller/controllerUser.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$userController = new CoursController();


if ($id > 0) {
    $user = $userController->getUserByIdd($id);
} else {
    $user = null;
}
?>
    <!-- Contenu principal -->
    <main class="main-content">
        <header class="user-info">
            <span>Bienvenue     ,</strong> <?= htmlspecialchars($user['Utilisateur']); ?> </span>
           <a href="http://localhost/projet%20web/View/Frontend/First_Interface/login&signUp/login.php">
             <button class="logout-btn"><i class="fas fa-sign-out-alt"> </i> Déconnexion</button>
        </a>
        </header>

        <div class="content">
            <div id="profile-content" class="section-content">
                <h1>Profile</h1>


                <?php if ($user): ?>
                    <div class="profile-info">
    <p><strong>Nom :</strong> <?= htmlspecialchars($user['Utilisateur']); ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($user['Email']); ?></p>
    <p><strong>telephone :</strong> <?= htmlspecialchars($user['Telephone']); ?></p>
    <p><strong>mot de passe :</strong> <?= htmlspecialchars($user['MotDePasse']); ?></p>
          
<?php else: ?>
    <p>Utilisateur non trouvé ou ID invalide.</p>
<?php endif; ?>


                     <form method="GET" action="updateUtilisateur.php">
                        <input type="hidden" value="<?= $user['Id']; ?>" name="id">
                        <button class="btn-update" type="submit">Modifier</button>
                    </form>

</div>




            </div>












            <div id="forum-content" class="section-content">
                <h2>Forum</h2>
                <p>Participez aux discussions et interagissez avec la communauté.</p>
            </div>
            <div id="skillSwapp-content" class="section-content">
                <h2>Skill Swap</h2>
                <p>Échangez vos compétences avec d'autres membres.</p>
            </div>
            <div id="blog-content" class="section-content">
                <h2>Blog</h2>
                <p>Découvrez ou publiez des articles intéressants.</p>
            </div>
            <div id="quiz-content" class="section-content">
                <h2>Quiz</h2>
                <p>Testez vos connaissances sur divers sujets.</p>
            </div>
            <div id="reclamation-content" class="section-content">
                <h2>Réclamation</h2>
                <p>Envoyez vos réclamations ou signalez des problèmes.</p>
            </div>
        </div>
    </main>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => section.style.display = 'none');
            const selectedSection = document.getElementById(sectionId + '-content');
            if (selectedSection) selectedSection.style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSection('profile');
        });
    </script>
</body>
</html>
