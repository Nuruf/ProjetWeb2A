<?php
require_once '../../model/categories.php';

$categoryModel = new category();
$category = null; // Initialize the category variable

if (isset($_GET['idCat'])) {
    $id = $_GET['idCat'];
    $category = $categoryModel->getIdCat($id); // Fetch category details
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $id = $_POST['idCat'];
    $name = $_POST['nomCat'];
    $description = $_POST['descriptionCat'];

    // Update category in the database
    $categoryModel->updateCategory($id, $name, $description);
    header('Location: listCategories.php'); // Redirect to the list page
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
</head>
<body>
    <h1>Edit Category</h1>

    <?php if ($category): ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idCat" value="<?php echo htmlspecialchars($category['idCat']); ?>">
            <label for="nomCat">Category Name:</label>
            <input type="text" name="nomCat" id="nomCat" value="<?php echo htmlspecialchars($category['nomCat']); ?>" required>
            <br>
            <label for="descriptionCat">Description:</label>
            <textarea name="descriptionCat" id="descriptionCat" required><?php echo htmlspecialchars($category['descriptionCat']); ?></textarea>
            <br>
            <button type="submit">Update Category</button>
        </form>
    <?php else: ?>
        <p>Category not found. Please check the ID or try again.</p>
    <?php endif; ?>
</body>
</html>
