<?php
include '../../controller/CategoryController.php';
$error = "";

// Create an instance of the controller
$categoriesController = new categoriesController(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if required fields are set and not empty
    if (isset($_POST["nomCat"]) && isset($_POST["descriptionCat"])) {
        
        if (!empty($_POST["nomCat"]) && !empty($_POST["descriptionCat"])) {
            // Create a new category object
            $category = new category( 
                null, 
                $_POST['nomCat'], 
                $_POST['descriptionCat'], 
            );

            // Add the category using the controller
            $categoriesController->addCategory($category); 

            // Redirect to the list page
            header('Location: listCategories.php'); 
            exit();
        } else {
            $error = "Missing information";
        }
    } else {
        $error = "File upload error or missing fields";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Create New Category</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nomCat">Category Name</label>
                <input type="text" class="form-control" id="nomCat" name="nomCat" required>
            </div>
            <div class="form-group">
                <label for="descriptionCat">Category Description</label>
                <textarea class="form-control" id="descriptionCat" name="descriptionCat" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>