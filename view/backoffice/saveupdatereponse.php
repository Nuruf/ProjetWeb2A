<?php
require_once 'C:\xampp\htdocs\projet web\controller\ReponseController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required fields are set
    if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['contenu']) && !empty($_POST['contenu'])) {
        $id = $_POST['id'];
        $contenu = $_POST['contenu'];

        // Initialize the ReponseController
        $reponseController = new ReponseController();

        // Attempt to update the response
        $result = $reponseController->updateReponse($id, $contenu);

        if ($result) {
            // Success message and redirect
            header('Location: reponselist.php?success=1');
            exit();
        } else {
            // Error message and redirect
            header('Location: updatereponse.php?id=' . urlencode($id) . '&error=update_failed');
            exit();
        }
    } else {
        // Redirect back with an error if the required fields are missing
        header('Location: updatereponse.php?id=' . urlencode($_POST['id'] ?? '') . '&error=missing_fields');
        exit();
    }
} else {
    // Reject non-POST requests
    header('HTTP/1.1 405 Method Not Allowed');
    echo "Invalid request method.";
    exit();
}
