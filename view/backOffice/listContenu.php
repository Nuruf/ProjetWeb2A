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

    <h1>Contenu</h1>
    <a href="createContenu.php">Add New Content</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $contenu): ?>
                <tr>
                    <td><?php echo htmlspecialchars($contenu['idContenu']); ?></td>
                    <td><?php echo htmlspecialchars($contenu['nomContenu']); ?></td>
                    <td><?php echo htmlspecialchars($contenu['descriptionContenu']); ?></td>
                    <td><a href="deleteContenu.php?idContenu=<?php echo $contenu['idContenu']; ?>">Delete</a></td>
                    <td><a href="editContenu.php?idContenu=<?php echo $contenu['idContenu']; ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
