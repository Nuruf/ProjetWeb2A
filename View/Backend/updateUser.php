<?php

include_once('../../Controller/controllerUser.php');
include_once('../../Model/modelUser.php');  

$user = null;

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $utilisateursController = new CoursController();
    $user = $utilisateursController->getUserById($userId);
}

if ($user === null) {
    echo "L'utilisateur demandé n'existe pas.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['motdepasse'], $_POST['email'], $_POST['phone'], $_POST['role'])) {
    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $motdepasse = $_POST['motdepasse']; 
    $phone = $_POST['phone']; 
    $role = $_POST['role'];

    // Création de l'objet User
    $user = new User($name, $email, $motdepasse, $phone, $role); 

    // Mise à jour de l'utilisateur
    $utilisateursController->updateUser($user, $userId);

    // Redirection vers le dashboard
    header('Location: dashboard.php?id=' . urlencode($userId));
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'utilisateur</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="user-info">
        <img src="logoo.png" alt="User Profile">
        <span>Bienvenue sur notre site : <?= htmlspecialchars($user['Utilisateur']); ?></span> <!-- Correction ici -->
        <h1>Dashboard</h1>
    <a href=" http://localhost/projet%20web/View/Frontend/First_Interface/login&signUp/login.php ">
    <button type="submit" class="logout-btn" name="logout">Se déconnecter</button>
    </a>
    </div>

    <nav>
        <ul>
            <li><a href="#profile" onclick="showSection('profile')">Profile</a></li>
            <li><a href="#forum" onclick="showSection('forum')">Forum</a></li>
            <li><a href="#skillSwap" onclick="showSection('skillSwapp')">Skill Swapp</a></li>
            <li><a href="#blog" onclick="showSection('blog')">Blog</a></li>
            <li><a href="#Quiz" onclick="showSection('quiz')">Quiz</a></li>
            <li><a href="#Reclamation" onclick="showSection('reclamation')">Réclamation</a></li>
        </ul>
    </nav>

    <div class="content">
        <div id="profile-content" class="section-content">
            <h2 class="section-title">Modifier l'utilisateur</h2>
            
            <!-- Formulaire de mise à jour -->
            <form method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($user['Id']); ?>">

                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['Utilisateur']); ?>" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['Email']); ?>" required>

                <label for="motdepasse">Mot De Passe :</label>
                <input type="password" id="motdepasse" name="motdepasse" value="<?= htmlspecialchars($user['MotDePasse']); ?>" required>

                <label for="phone">Téléphone :</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['Telephone']); ?>" required>

                <label for="role">Rôle :</label>
                <select name="role" id="role">
                    <option value="0" <?= $user['Role'] == '0' ? 'selected' : ''; ?>>Admin</option>
                    <option value="1" <?= $user['Role'] == '1' ? 'selected' : ''; ?>>Utilisateur</option>
                </select>

                <button type="submit" class="btn-update">Mettre à jour</button>
            </form>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => {
                section.style.display = 'none';
            });

            const selectedSection = document.getElementById(sectionId + '-content');
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSection('profile');
        });
    </script>
</body>
</html>
