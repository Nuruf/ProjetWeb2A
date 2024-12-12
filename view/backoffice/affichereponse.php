<?php
require_once 'C:\xampp\htdocs\projet web\controller\ReponseController.php'; 
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php'; 

// Initialize controllers
$reponseController = new ReponseController();
$reclamationController = new ReclamationController();

// Check if a reclamation ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_reclamation = intval($_GET['id']);

    // Fetch the specific reclamation
    $reclamation = $reclamationController->getReclamationById($id_reclamation);

    if (!$reclamation) {
        echo "Reclamation not found.";
        exit();
    }

    // Fetch responses for the given reclamation ID
    $responses = $reponseController->getResponsesByReclamationId($id_reclamation);
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
    <title>Responses for Reclamation</title>
    <link rel="stylesheet" href="../frontend\affichereponse.css">
</head>
<body>
    <h1>Responses for Reclamation #<?= htmlspecialchars($reclamation['id']) ?></h1>
    <p><strong>Description:</strong> <?= htmlspecialchars($reclamation['description']) ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars($reclamation['status']) ?></p>
    
    <h2>Responses:</h2>
    <?php if (!empty($responses)): ?>
        <ul>
            <?php foreach ($responses as $response): ?>
                <li>
                    <strong>Content:</strong> <?= htmlspecialchars($response['contenu']) ?><br>
                    <strong>Date:</strong> <?= htmlspecialchars($response['date_reponse']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>This reclamation is not treated yet.</p>
    <?php endif; ?>
    
    <!-- see awnser button-->
    <form action="reclamationlist.php" method="post" style="display:inline;">
    <input type="hidden" name="id_user" value="<?= htmlspecialchars($reclamation['id_user']) ?>">
    <button type="submit">Back to Reclamation List</button>
</form>
</body>
</html>
