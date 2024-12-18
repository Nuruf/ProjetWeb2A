<?php
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php'; // Adjust path if needed
require_once 'C:\xampp\htdocs\projet web\conf.php';

// Create an instance of the controller
$reclamationController = new ReclamationController();
$userId = null;

// Retrieve all reclamations
/*if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_user'])) {
    $userId = (int) $_POST['id_user']; // Sanitize user input
    $reclamations = $reclamationController->getReclamationsByUserId($userId); // Get reclamations by user ID
}*/
// Check for POST or GET
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_user'])) {
    $userId = (int) $_POST['id_user'];
} elseif (isset($_GET['id_user'])) {
    $userId = (int) $_GET['id_user'];
}

// Fetch reclamations
if ($userId !== null) {
    $reclamations = $reclamationController->getReclamationsByUserId($userId);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamation List</title>
    <link rel="stylesheet" href="../frontend\reclamationlist.css">
</head>
<body>
    <h1>Reclamation List</h1>
    <table>
    <thead>
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Description</th>
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php if (!empty($reclamations)) : ?>
        <?php foreach ($reclamations as $reclamation) : ?>
            <tr>
                <td><?= htmlspecialchars($reclamation['id']) ?></td>
                <td><?= htmlspecialchars($reclamation['id_user']) ?></td>
                <td><?= htmlspecialchars($reclamation['description']) ?></td>
                <td><?= htmlspecialchars($reclamation['status']) ?></td>
                <td><?= htmlspecialchars($reclamation['date']) ?></td>
                <td>
                    <!-- Delete Button -->
                    <form action="deleteReclamation.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($reclamation['id']) ?>">
                        <button type="submit">Delete</button>
                    </form>

                    <!-- Update Button -->
                    <form action="updateReclamation.php" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($reclamation['id']) ?>">
                        <button type="submit">Update</button>
                    </form>
                    <!-- 
                    <form action="awnser.php" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($reclamation['id']) ?>">
                        <button type="submit">awnser</button>
                    </form>-->
                    <!-- see awnser button-->
                    <form action="affichereponse.php" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($reclamation['id']) ?>">
                        <button type="submit">see awnser</button>
                    </form>
                    <!-- see awnser button-->
                    
                    
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="6">No reclamations found.</td>
        </tr>
    <?php endif; ?>
</tbody>
<form action="../frontend/user1.html" style="display:inline;">
        <button type="submit">back to user form</button>
    </form>
    </table>
</body>
</html>
