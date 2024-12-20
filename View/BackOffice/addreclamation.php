<?php
require_once 'C:/xampp/htdocs/projet web/controller/reclamationcontroller.php'; // Update to match your file structure
require_once 'C:/xampp/htdocs/projet web/conf.php'; // Fixed file path

$error = "";
$reclamation = null;
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    // Rediriger vers la page de connexion si non connecté ou rôle incorrect
    header('Location: ../../frontend/templatefront/index.php');
    exit;
}

// Récupérer l'ID utilisateur de la session
$user_id = $_SESSION['user_id'];

// Create an instance of the controller
$reclamationController = new ReclamationController();

if (isset($_POST["description"])) { // Check only the description field, user_id is from the session
    if (!empty($_POST["description"])) {
        // Create a new Reclamation object
        $reclamation = new Reclamation(
            null,               // ID will be auto-incremented
            $user_id,           // User ID from session
            $_POST["description"] // User-provided description
        );

        // Ajouter la réclamation via le contrôleur
        $reclamationController->addReclamation($reclamation);

        // Redirection vers une page de confirmation ou de liste
        header('Location: ../frontend/user1.html'); 
        exit; // Stop further execution
    } else {
        // Set an error message if the description is empty
        $error = "Veuillez remplir tous les champs.";
    }
}
?>
