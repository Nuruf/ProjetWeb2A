<?php 
include '../../controller/CategoryController.php';
$categoriesController = new categoriesController(); 
$categories = $categoriesController->showCategory();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories</title>
</head>
<body>
    <h1>All Categories</h1>
    <?php foreach ($categories as $category): ?>
        <div>
            <h2><?php echo htmlspecialchars($category['nomCat']); ?></h2>
            <p><?php echo htmlspecialchars($category['descriptionCat']); ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
