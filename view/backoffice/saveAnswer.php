<?php
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_reclamation = intval($_POST['id_reclamation']); // Sanitize the ID
    $answer = trim($_POST['contenu']); // Sanitize the input

    if (!empty($id_reclamation) && !empty($answer)) {
        $reclamationController = new ReclamationController();
        $success = $reclamationController->addAnswer($id_reclamation, $answer);

        if ($success) {
            echo "Answer saved successfully.";
            header("Location: reclamationlistadmin.php"); // Redirect to a success page
            exit();
        } else {
            echo "Failed to save the answer.";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}
?>
