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
} else {
    echo "Invalid reclamation ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user.css">
    <title>Update Reclamation</title>
</head>
<body>
    <h1>Update Reclamation</h1>
    <form action="saveUpdatedReclamation.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($reclamation['id']) ?>">
        <label for="description">Description:</label><br>
        <textarea name="description" id="description" rows="4" cols="50"><?= htmlspecialchars($reclamation['description']) ?></textarea><br><br>
        <label for="status">Status:</label><br>
        <select name="status" id="status">
            <option value="open" <?= $reclamation['status'] === 'open' ? 'selected' : '' ?>>Open</option>
            <option value="closed" <?= $reclamation['status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
        </select><br><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
