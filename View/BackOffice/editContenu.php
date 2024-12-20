<?php

include '../../controller/ContenuController.php';

$error = "";
$contenu = null;

// Create an instance of the controller
$contenuController = new contenuController();

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idContenu'], $_POST['nomContenu'], $_POST['descriptionContenu'], $_POST['idCat']) &&
        !empty($_POST['idContenu']) && !empty($_POST['nomContenu']) && !empty($_POST['descriptionContenu']) &&
        !empty($_POST['idCat'])
    ) {
        // Create the Book object
        $contenu = new contenu(
            null,
            $_POST['nomContenu'],
            $_POST['descriptionContenu'],
            $_POST['idCat']
        );

        // Update the book in the database
        $contenuController->updateContenu($contenu, $_POST['idContenu']);

        // Redirect to the book list page
        header('Location: listContenu.php?idCat=' . urlencode($_POST['idCat']));
        exit; // Ensure no further processing
    } else {
        $error = "Missing or empty fields";
    }
}

// Display the error message if any
if (!empty($error)) {
    echo "<p>Error: " . htmlspecialchars($error) . "</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contenu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
 
        
        <!-- Begin Page Content -->
        <?php
            if (isset($_POST['idContenu'])) {
                $contenu = $contenuController->showContenuById($_POST['idContenu']);
        ?>
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Update Contenu for Category : <?= htmlspecialchars($contenu['idCat']); ?></h1>
            </div>
            <div class="container-fluid">
                <br>
                <a href="listContenu.php?idCat=<?= htmlspecialchars($contenu['idCat']); ?>" class="btn btn-secondary"><</a>
                <br>
                <div class="row">
                    <div class="col-xl-12 col-md- 6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <label for="id" class="form-label">ID Contenu:</label>
                                            <input class="form-control" type="text" id="idContenu" name="idContenu" readonly value="<?php echo htmlspecialchars($contenu['idContenu']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom Contenu:</label>
                                            <input class="form-control" type="text" id="nomContenu" name="nomContenu" value="<?php echo htmlspecialchars($contenu['nomContenu']); ?>">
                                            <span id="name_error"></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description:</label>
                                            <textarea class="form-control" id="descriptionContenu" name="descriptionContenu"><?php echo htmlspecialchars($contenu['descriptionContenu']); ?></textarea>
                                            <span id="description_error"></span>
                                        </div>
                                        <input type="hidden" name="idCat" value="<?php echo htmlspecialchars($contenu['idCat']); ?>">
                                        <button type="submit" class="btn btn-primary">Update Contenu</button>
                                    </form>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <footer class="footer">
        <p>&copy; 2024 UNIBOARD - Tous droits réservés.</p>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</div>
</body>
</html>