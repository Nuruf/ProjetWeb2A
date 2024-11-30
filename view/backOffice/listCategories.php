<?php
include '../../controller/CategoryController.php';
$categoriesController = new categoriesController();
$list = $categoriesController->listCategories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
</head>
<body>
    <h1>Categories</h1>
    <a href="createCategory.php">Add New Category</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th colspan="2">CRUD</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $category): ?>
                <tr>
                    <td><?php echo htmlspecialchars($category['idCat']); ?></td>
                    <td><?php echo htmlspecialchars($category['nomCat']); ?></td>
                    <td><?php echo htmlspecialchars($category['descriptionCat']); ?></td>                    
                    <td><a href="deleteCategory.php?idCat=<?php echo htmlspecialchars($category['idCat']); ?>">Delete</a></td>
                    <td><a href="editCategory.php?idCat=<?php echo htmlspecialchars($category['idCat']); ?>">Edit</a></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
