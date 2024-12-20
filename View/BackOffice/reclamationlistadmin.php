<?php
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php'; // Adjust path if needed
require_once 'C:\xampp\htdocs\projet web\conf.php';

// Create an instance of the controller
$reclamationController = new ReclamationController();

// Retrieve all reclamations
$reclamations = $reclamationController->getAllReclamations();

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
    <form action="allreponseslist.php" method="GET" style="display:inline;">
                    
        <button type="submit">see all awnsers</button>
    </form>
     <!-- Filter Form -->
    <form action="filterreclamations.php" method="GET">
        <label>
            <input type="checkbox" name="status" value="Closed" id="closed-checkbox">
            Closed
        </label>
        <label>
            <input type="checkbox" name="status" value="Open" id="open-checkbox">
            Open
        </label>
        <button type="submit">Display</button>
    </form>
    <form action="statistique.php" method="GET" style="display:inline;">
                    
        <button type="submit">stats</button>
    </form>
                
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
                    <form action="deletereclamationadmin.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($reclamation['id']) ?>">
                        <button type="submit">Delete</button>
                    </form>

                    <!-- Update Button -->
                    <form action="updatereclamationadmin.php" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($reclamation['id']) ?>">
                        <button type="submit">Update</button>
                    </form>
                    <!-- awnser button-->
                    <form action="awnser.php" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($reclamation['id']) ?>">
                        <button type="submit">awnser</button>
                    </form>
                    <!-- see awnser button-->
                    <form action="affichereponseadmin.php" method="GET" style="display:inline;">
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

    </table>
</body>
</html>
