<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Controller/controllerUser.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Model/modelUser.php');

$utilisateur1 = null;


session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 0) {
    // Rediriger vers la page de connexion si non connecté ou rôle incorrect
   header('Location: ../../frontend/templatefront/index.php');
    exit;
}
$pp=$_SESSION['user_id'];

// Récupérer l'ID de l'utilisateur à modifier depuis l'URL

    $utilisateur1Id =$pp;

    $utilisateursController = new CoursController();
    $utilisateur1 = $utilisateursController->getUserById($utilisateur1Id);


// Si l'utilisateur n'existe pas, afficher un message d'erreur
if ($utilisateur1 === null) {
    echo "L'utilisateur demandé n'existe pas.";
    exit();
}

// Si le formulaire est soumis (méthode POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['motdepasse'], $_POST['email'], $_POST['phone'], $_POST['role'])) {
  

    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $motdepasse = $_POST['motdepasse'];  
    $phone = $_POST['phone']; 
    $role = $_POST['role'];


    $utilisateur1 = new User($name, $email, $motdepasse, $phone, $role);

    // Mise à jour de l'utilisateur dans la base de données
    $utilisateursController->updateUser($utilisateur1, $utilisateur1Id);

    // Redirection vers le tableau de bord avec l'ID de l'utilisateur dans l'URL
    header('Location: ../../View/BackOffice/dashboard backoffice.php');
    exit();
}
?>


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
            <h1>Dashboard</h1>
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

    <!-- Contenu principal -->
    <main class="main-content">
        <header class="user-info">
            <span>Bienvenue ,</strong> <?= htmlspecialchars($utilisateur1['Utilisateur']); ?> </span>
            <a href="http://localhost/projet%20web/View/Frontend/First_Interface/login&signUp/login.php">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"> </i> Déconnexion</button>
            </a>
        </header>

        <div class="content">
            <div id="profile-content" class="section-content">

                <h1>Modifier l'utilisateur</h1>
                <form method="POST">
                 

                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($utilisateur1['Utilisateur']); ?>" required>

                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur1['Email']); ?>" required>

                    <label for="motdepasse">Mot De Passe :</label>
                    <input type="password" id="motdepasse" name="motdepasse" value="<?= htmlspecialchars($utilisateur1['MotDePasse']); ?>" required>

                    <label for="phone">Téléphone :</label>
                    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($utilisateur1['Telephone']); ?>" required>

                    <label for="role">Rôle :</label>
                    <select name="role" id="role">
                        <option value="0" <?= $utilisateur1['Role'] == '0' ? 'selected' : ''; ?>>Admin</option>
                        <option value="1" <?= $utilisateur1['Role'] == '1' ? 'selected' : ''; ?>>Utilisateur</option>
                    </select>

                    <button type="submit" class="btn-update">Mettre à jour</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Fonction pour afficher la section correspondante
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => section.style.display = 'none');
            const selectedSection = document.getElementById(sectionId + '-content');
            if (selectedSection) selectedSection.style.display = 'block';
        }

        // Afficher par défaut la section 'profile' lors du chargement de la page
        document.addEventListener('DOMContentLoaded', () => {
            showSection('profile');
        });
    </script>
</body>
</html>

