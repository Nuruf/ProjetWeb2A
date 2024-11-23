<?php
echo "Looking for config.php in: " . __DIR__ . "/config.php";
require_once 'categories.php';

$categoryModel = new Categories();
$categories = $categoryModel->getAllCategories(); // Fetch all categories
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
</head>
<body>
    <td><a href="deleteCategory.php?id=<?php echo $category['idCat']; ?>">Delete</a></td>
    <td><a href="editCategory.php?id=<?php echo $category['idCat']; ?>">Edit</a></td>

    <h1>Categories</h1>
    <a href="createCategory.php">Add New Category</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo htmlspecialchars($category['idCat']); ?></td>
                    <td><?php echo htmlspecialchars($category['nomCat']); ?></td>
                    <td><?php echo htmlspecialchars($category['descriptionCat']); ?></td>
                    <td><img src="../../images/<?php echo htmlspecialchars($category['imageCat']); ?>" alt="" width="100"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
