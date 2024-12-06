<?php
require_once 'C:/xampp/htdocs/projet web/controller/reclamationcontroller.php'; // Update to match your file structure
require_once 'C:\xampp\htdocs\projet web\conf.php';

$error = "";
$reclamation = null;

// Create an instance of the controller
$reclamationController = new ReclamationController();

if (isset($_POST["user_id"]) && isset($_POST["description"])) {
    if (!empty($_POST["user_id"]) && !empty($_POST["description"])) {
        $reclamation = new Reclamation(
            null, // ID will be auto-incremented
            $_POST["user_id"], // User-provided ID
            $_POST["description"], // User-provided description
        );

        $reclamationController->addReclamation($reclamation);

        header('Location: ../frontend/user1.html'); // Redirect to a reclamation list page
        exit(); // Always call exit after header redirect to stop further script execution
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>
