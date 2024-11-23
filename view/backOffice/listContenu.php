<?php
include '../../controller/ContenuController.php';
$contenuController = new contenuController();
$list = $contenuController->listContenus();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content List</title>
</head>
<body>
    <td><a href="deleteContenu.php?id=<?php echo $contenu['idContenu']; ?>">Delete</a></td>
    <td><a href="editContenu.php?id=<?php echo $contenu['idContenu']; ?>">Edit</a></td>

    <h1>Contenu</h1>
    <a href="createContenu.php">Add New Content</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $contenu): ?>
                <tr>
                    <td><?php echo htmlspecialchars($contenu['idContenu']); ?></td>
                    <td><?php echo htmlspecialchars($contenu['nomContenu']); ?></td>
                    <td><?php echo htmlspecialchars($contenu['descriptionContenu']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
