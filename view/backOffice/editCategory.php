<?php
require_once '../../model/categories.php';

$categoryModel = new Categories();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $category = $categoryModel->getCategoryById($id); // Fetch category details
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $id = $_POST['idCat'];
    $name = $_POST['nomCat'];
    $description = $_POST['descriptionCat'];
    $image = $_FILES['imageCat'];

    // Check if a new image was uploaded
    if ($image['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($image['name']);
        $uploadDir = '../../images/';
        move_uploaded_file($image['tmp_name'], $uploadDir . $imageName);
    } else {
        $imageName = $category['imageCat']; // Use the existing image if no new one was uploaded
    }

    // Update category in the database
    $categoryModel->updateCategory($id, $name, $description, $imageName);
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
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idCat" value="<?php echo htmlspecialchars($category['idCat']); ?>">
        <label for="nomCat">Category Name:</label>
        <input type="text" name="nomCat" id="nomCat" value="<?php echo htmlspecialchars($category['nomCat']); ?>" required>
        <br>
        <label for="descriptionCat">Description:</label>
        <textarea name="descriptionCat" id="descriptionCat" required><?php echo htmlspecialchars($category['descriptionCat']); ?></textarea>
        <br>
        <label for="imageCat">Image:</label>
        <input type="file" name="imageCat" id="imageCat">
        <p>Current Image: <img src="../../images/<?php echo htmlspecialchars($category['imageCat']); ?>" alt="" width="100"></p>
        <br>
        <button type="submit">Update Category</button>
    </form>
</body>
</html>
