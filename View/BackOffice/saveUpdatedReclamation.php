<?php
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php';
require_once 'C:\xampp\htdocs\projet web\conf.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required fields are set
    if (isset($_POST['id'], $_POST['description'], $_POST['status']) &&
        !empty($_POST['id']) && !empty($_POST['description']) && !empty($_POST['status'])) {
        
        $id = htmlspecialchars($_POST['id']);
        $description = htmlspecialchars($_POST['description']);
        $status = htmlspecialchars($_POST['status']);

        $reclamationController = new ReclamationController();

        // Update the reclamation
        $updated = $reclamationController->updateReclamation($id, $description, $status);

        if ($updated) {
            echo "Reclamation updated successfully.";
            $userId = $reclamationController->getUserIdByReclamationId($id); // Fetch the user ID
            echo $userId;
            header("Location: reclamationlist.php?id_user=" . urlencode($userId));
            exit();

        } else {
            echo "Failed to update reclamation. Please try again.";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
    exit();
}
?>
