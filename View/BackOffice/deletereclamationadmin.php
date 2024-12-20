<?php
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php';

// Check if ID is provided
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $reclamationController = new ReclamationController();

    try {
        // Call delete function
        $reclamationController->deleteReclamation($_POST['id']);
        header("Location: reclamationlistadmin.php");
        exit();
    } catch (Exception $e) {
        echo 'Error deleting reclamation: ' . $e->getMessage();
    }
} else {
    echo "Invalid reclamation ID.";
}
?>
