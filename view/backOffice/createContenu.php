<?php
include '../../controller/ContenuController.php';
$error = "";

// Create an instance of the controller
$contenuController = new contenuController(); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if required fields are set and not empty
    if (
        isset($_POST["nomContenu"]) && 
        isset($_POST["descriptionContenu"]) 
    ) {
        if (
            !empty($_POST["nomContenu"]) && 
            !empty($_POST["descriptionContenu"]) 
            
        ) {
            // Create a new content object
            $contenu = new contenu( 
                null, 
                $_POST['nomContenu'], 
                $_POST['descriptionContenu']
            );

            // Add the content using the controller
            $contenuController->addContenu($contenu); 

            // Redirect to the list page
            header('Location: listContenu.php'); 
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
    <title>Create Content</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Create New Content</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nomContenu">Content Name</label>
                <input type="text" class="form-control" id="nomContenu" name="nomContenu" required>
            </div>
            <div class="form-group">
                <label for="descriptionCat">Content Description</label>
                <textarea class="form-control" id="descriptionContenu" name="descriptionContenu" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Content</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>