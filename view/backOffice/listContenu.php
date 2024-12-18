<?php
include '../../controller/ContenuController.php';

$contenuController = new contenuController();
if (isset($_GET['idCat'])) {
    $idCat = $_GET['idCat'];
    $contenu = $contenuController->listContenuByIdCat($idCat);
} else {
    die('Error: idCat not provided.');
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
    <h1 class="section-title">Contenu</h1>
    <p class="section-description">
        Échangez vos compétences avec d'autres membres de la communauté. Découvrez de nouvelles opportunités d'apprentissage et d'enseignement.
    </p>
    <a href="createContenu.php?idCat=<?= htmlspecialchars($idCat); ?>" class="btn btn-primary">Ajouter un nouveau contenu</a><br><br>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($contenu)): ?>
            <?php foreach ($contenu as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['idContenu']); ?></td>
                    <td><?= htmlspecialchars($item['nomContenu']); ?></td>
                    <td><?= htmlspecialchars($item['descriptionContenu']); ?></td>
                    <td>
                        <a href="deleteContenu.php?idContenu=<?= htmlspecialchars($item['idContenu']); ?>&idCat=<?= htmlspecialchars($idCat); ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                    <td>
                        <form method="POST" action="editContenu.php" class="d-inline">
                            <input type="hidden" name="idContenu" value="<?= htmlspecialchars($item['idContenu']); ?>">
                            <input type="hidden" name="idCat" value="<?= htmlspecialchars($idCat); ?>">
                            <input type="submit" name="update" value="Modifier" class="btn btn-warning">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Aucun contenu trouvé pour cette catégorie.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
