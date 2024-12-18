<?php
require_once '../../controller/categoryController.php';

$error = "";
$category = null;
$categoryController = new categoriesController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate that none of the fields are empty
    if (isset($_POST["nomCat"]) && isset($_POST["descriptionCat"])) {
        if (!empty($_POST["nomCat"]) && !empty($_POST["descriptionCat"])) {
            // Create the Category object
            $category = new category(
                null,
                $_POST['nomCat'],
                $_POST['descriptionCat']
            );

            // Update the category in the database
            $categoryController->updateCategory($category, $_POST['idCat']);

            // Redirect to the category list page
            header('Location:listCategories.php');
            exit; // Ensure no further processing occurs after the redirect
        } else {
            $error = "Missing information";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<aside class="sidebar">
        <div class="sidebar-header">
            <img src="logoo.png" alt="Logo" class="logo">
            <h3>Dashboard</h3>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="#profile" onclick="showSection('profile')"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="#forum" onclick="showSection('forum')"><i class="fas fa-comments"></i> Forum</a></li>
                <li><a href="listCategories.php" onclick="showSection('skillSwapp')"><i class="fas fa-exchange-alt"></i> Skill Swap</a></li>
                <li><a href="dashboardStatistics.php">Statistics</a></li>
                <li><a href="#blog" onclick="showSection('blog')"><i class="fas fa-blog"></i> Blog</a></li>
                <li><a href="#quiz" onclick="showSection('quiz')"><i class="fas fa-question-circle"></i> Quiz</a></li>
                <li><a href="#reclamation" onclick="showSection('reclamation')"><i class="fas fa-file-alt"></i> Réclamation</a></li>
            </ul>
        </nav>
    </aside>

    <div class="container mt-5">
        <div id="skillSwapp-content" class="section-content">
            <h2 class="section-title">Update Category</h2>
            <p class="section-description">Please fill in the details below to update the category.</p>

            <?php
            if (isset($_POST['idCat'])) {
                $category = $categoryController->showCategory($_POST['idCat']);
            ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="id" class="form-group">ID category:</label>
                        <input class="form-control" type="text" id="idCat" name="idCat" readonly value="<?php echo htmlspecialchars($_POST['idCat']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-group">Nom category:</label>
                        <input class="form-control" type="text" id="nomCat" name="nomCat" value="<?php echo htmlspecialchars($category['nomCat']); ?>">
                        <span id="name_error" style="color:red;"><?php echo $error; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-group">Description:</label>
                        <textarea class="form-control" id="descriptionCat" name="descriptionCat"><?php echo htmlspecialchars($category['descriptionCat']); ?></textarea>
                        <span id="description_error" style="color:red;"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Update category</button>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>