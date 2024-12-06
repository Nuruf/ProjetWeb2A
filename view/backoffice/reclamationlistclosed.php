<?php
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php';
require_once 'C:\xampp\htdocs\projet web\conf.php';

$reclamationController = new ReclamationController();
$reclamations = $reclamationController->getReclamationsByStatus('Closed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Closed Reclamations</title>
    <style>
/* General Body Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    padding: 20px;
    margin: 0;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: #ffffff;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #007acc;
    color: white;
}

/* Table Row Styles */
tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Heading Styles */
h1 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Form Button Styles */
button {
    padding: 10px 20px;
    background-color: #007acc;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #005f99;
}

/* Filter Form Styles */
form {
    margin-bottom: 20px;
    text-align: center;
}

/* Checkbox Label Styles */
label {
    font-size: 16px;
    margin-right: 10px;
}

/* Action Buttons Container Styles */
form button {
    margin-top: 10px;
}

/* Additional Styling for "Actions" Buttons */
form button[type="submit"] {
    padding: 5px 15px;
    background-color: #007acc;
    color: white;
    border-radius: 5px;
    font-size: 14px;
    margin-top: 10px;
}

form button[type="submit"]:hover {
    background-color: #005f99;
}

/* No Reclamations Found Message */
td[colspan="6"] {
    text-align: center;
    font-size: 18px;
    color: #888;
}

/* Style for Delete, Update, Answer buttons */
form {
    display: inline;
    margin: 0 5px;
}

form button {
    padding: 5px 10px;
    background-color: #007acc;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 12px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #005f99;
}

    </style>
</head>
<body>
    <h1>Closed Reclamations</h1>
     <!-- Back Button -->
     <div style="text-align: center; margin-bottom: 20px;">
        <a href="reclamationlistadmin.php">
            <button type="button">Back to Reclamation List</button>
        </a>
    </div>
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
                <td colspan="5">No closed reclamations found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
