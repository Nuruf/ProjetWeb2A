<?php
include '../../controller/ContenuController.php';

$error = "";
$idCat=null;

if (isset($_GET['idCat'])) {
    $idCat = htmlspecialchars($_GET['idCat']);
}

// Create an instance of the controller
$contenuController = new contenuController(); 
$categoriesController = new categoriesController();
$categories = $categoriesController->showCategory($idCat);

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
                $_POST['descriptionContenu'],
                $_POST['idCat']
            );

            // Add the content using the controller
            $contenuController->addContenu($contenu,$idCat); 

            // Redirect to the list page
            header('Location: listContenu.php?idCat=' . urlencode($idCat)); 
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
        <h2>Create New Content</h2>
        <a href="listContenu.php?idCat=<?= htmlspecialchars($idCat); ?>" class="btn btn-secondary"><--</a>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data" >
            <input type="hidden" name="idCat" value="<?php echo htmlspecialchars($idCat); ?>">
            <div class="form-group">
                <label for="nomContenu">Content Name</label>
                <input type="text" class="form-control" id="nomContenu" name="nomContenu" required>
            </div>
            <div class="form-group">
                <label for="descriptionContenu">Content Description</label>
                <textarea class="form-control" id="descriptionContenu" name="descriptionContenu" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Content</button>
        </form>
    </div>
    <script src="view/backOffice/js/scriptcontenu.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>