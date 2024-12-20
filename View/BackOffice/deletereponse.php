<?php
require_once 'C:\xampp\htdocs\projet web\controller\ReponsessController.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Initialize the ReponseController
    $reponseController = new ReponseController();

    // Attempt to delete the response
    $result = $reponseController->deleteReponse($id);

    if ($result) {
        // Redirect to the response list with success message
        header('Location: allreponseslist.php?success=deleted');
        exit();
    } else {
        // Redirect to the response list with error message
        header('Location: allreponseslist.php?error=delete_failed');
        exit();
    }
} else {
    // Redirect back with an error if the ID is invalid or missing
    header('Location: allreponseslist.php?error=missing_id');
    exit();
}
