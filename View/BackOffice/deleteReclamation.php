<?php
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php';

// Check if ID is provided
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $reclamationController = new ReclamationController();

    try {
        // Call delete function
        $userId = $reclamationController->getUserIdByReclamationId($_POST['id']); // Fetch the user ID
        echo $userId;
        $reclamationController->deleteReclamation($_POST['id']);
        header("Location: reclamationlist.php?id_user=" . urlencode($userId));
        exit();
    } catch (Exception $e) {
        echo 'Error deleting reclamation: ' . $e->getMessage();
    }
} else {
    echo "Invalid reclamation ID.";
}
?>
