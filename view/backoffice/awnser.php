<?php
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $reclamationController = new ReclamationController();

    // Fetch the specific reclamation
    $reclamation = $reclamationController->getReclamationById($_GET['id']);
    if (!$reclamation) {
        echo "Reclamation not found.";
        exit();
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Optional: Your CSS file -->
    <title>Answer Reclamation</title>
</head>
<body>
    <h1>Answer Reclamation</h1>
    <h2>Reclamation Details</h2>
    <p><strong>ID:</strong> <?= htmlspecialchars($reclamation['id']) ?></p>
    <p><strong>Description:</strong> <?= htmlspecialchars($reclamation['description']) ?></p>
   
    <h2>Provide Your Answer</h2>
    <form action="saveAnswer.php" method="POST">
        <!-- Hidden field to pass the reclamation ID -->
        <input type="hidden" name="id_reclamation" value="<?= htmlspecialchars($reclamation['id']) ?>">

        <label for="contenu">Your Answer:</label><br>
        <textarea id="contenu" name="contenu" rows="6" cols="50" placeholder="Write your answer here..." required></textarea><br><br>

        <button type="submit">Submit Answer</button>
    </form>
</body>
</html>
