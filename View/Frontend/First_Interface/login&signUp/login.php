<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Controller/controllerUser.php';

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email'], $_GET['password'])) {
    $email = $_GET['email'];
    $password = $_GET['password'];

    $userController = new CoursController();
    $user = $userController->checkUser($email, $password);

    if (is_array($user)) {
        // Si les informations d'identification sont correctes
        if ($user['Role'] == 0) {
            // Rediriger vers le tableau de bord admin
            echo "<script>alert('connexion réussi page admin.');</script>";
            header('Location: /PROJET%20WEB/View/Backend/dashboard.php?id=' . urlencode($user['Id'])  );
            exit;
        } elseif ($user['Role'] == 1) {
            // Rediriger vers le tableau de bord utilisateur
            echo "<script>alert('correction reussi .');</script>";
            header('Location: ../../dashbordfront.Office/dashboard frontoffice.php?id=' . urlencode($user['Id']) );
            exit;
        }
    } else {

        echo "<script>alert('Email ou mot de passe incorrect.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>Bienvenue sur notre site Skill Swap</h2>
        <img id="pp" src="asseets/logoo.png" alt="logo">
        <form onsubmit="return validateForm()" method="GET">
            <div class="input-group">
                <label for="email">Email</label>
                <input class="styled-input" type="email" id="email" name="email">
                <p id="errorMessage" style="color: red;"></p>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input class="styled-input" type="password" id="password" name="password">
                <p id="errorMessage2" style="color: red;"></p>
            </div>
            <button type="submit" class="login-btn">Connexion</button>
            <div class="extra-options">
                <a href=" MotdePasse.php  ">Mot de passe oublié ?</a>
                <a href="SignUp.php">Créer un compte</a>
            </div>
        </form>
        <!-- Section des icônes -->
        <div class="social-icons">
            <img src="asseets/facebook-svgrepo-com (2).svg" alt="Facebook" class="icon">
            <img src="asseets/instagram-svgrepo-com.svg" alt="Instagram" class="icon">
            <img src="asseets/inbox-svgrepo-com (1).svg" alt="Email" class="icon">
        </div>
    </div>
</body>
<script>
    function validateForm() {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const errorMessage = document.getElementById('errorMessage');
        const errorMessage2 = document.getElementById('errorMessage2');

        // Effacer les messages d'erreur précédents
        errorMessage.textContent = '';
        errorMessage2.textContent = '';

        if (email === '' && password === '') {
            errorMessage.textContent = 'Veuillez entrer votre email.';
            errorMessage2.textContent = 'Veuillez entrer votre mot de passe.';
            return false;
        }

        if (email === '') {
            errorMessage.textContent = 'Veuillez entrer votre email.';
            return false; // Empêche l'envoi du formulaire
        }

        if (password === '') {
            errorMessage2.textContent = 'Veuillez entrer votre mot de passe.';
            return false;
        }

        return true;
    }
</script>
</html>
