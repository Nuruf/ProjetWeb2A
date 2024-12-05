<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Model/modelUser.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Controller/controllerUser.php';

    // Récupération des paramètres GET
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $userController = new CoursController();

    // Récupérer l'utilisateur si un ID est présent
    if ($id > 0) {
        $user = $userController->getUserByIdd($id);
    } else {
        $user = null;
    }
?>

<div class="user-info">
    <img src="logoo.png" alt="User Profile">
    <span>Bienvenue sur notre site :
        <?= htmlspecialchars($user['Utilisateur'] ?? ''); ?>
    </span>
    <h1>Dashboard</h1>
    <a href="http://localhost/projet%20web/View/Frontend/First_Interface/login&signUp/login.php">
        <button type="submit" class="logout-btn" name="logout">Se déconnecter</button>
    </a>
</div>

<nav>
    <ul>
        <li><a href="#profile" onclick="showSection('profile')">Profile</a></li>
        <li><a href="#forum" onclick="showSection('forum')">Forum</a></li>
        <li><a href="#skillSwap" onclick="showSection('skillSwapp')">Skill Swapp</a></li>
        <li><a href="#blog" onclick="showSection('blog')">Blog</a></li>
        <li><a href="#Quiz" onclick="showSection('quiz')">Quiz</a></li>
        <li><a href="#Reclamation" onclick="showSection('reclamation')">Réclamation</a></li>
    </ul>
</nav>

<div class="content">
    <!-- Profile Section -->
    <div id="profile-content" class="section-content">
        <h2 class="section-title">Profile</h2>
        <div class="search-container">
            <form method="GET" action="">
                <!-- Champ masqué pour inclure l'ID -->
                <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>" />
                <!-- Champ de recherche -->
                <input type="text" name="search" id="searchInput" placeholder="Rechercher un utilisateur..."
                       value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
                <button type="submit">Rechercher</button>
            </form>
        </div>

        <?php
        // Inclure les contrôleurs nécessaires
        include_once('../../Controller/controllerUser.php');
        include_once('../../Controller/metierController.php');

        $utilisateursController = new CoursController();
        $metierController = new metierController();

        // Récupération des résultats de recherche ou de la liste complète
        $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
        if (!empty($searchTerm)) {
            $list = $metierController->searchUsers($searchTerm);
        } else {
            $list = $utilisateursController->listUser();
        }
        ?>

        <!-- Affichage des données dans une table -->
        <table class="styled-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Password</th>
                <th>Telephone</th>
                <th>Rôle</th>
                <th colspan="2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Parcourir la liste des utilisateurs et afficher chaque utilisateur dans une ligne
            foreach ($list as $user) {
                ?>
                <tr>
                    <td><?= htmlspecialchars($user['Id']); ?></td>
                    <td><?= htmlspecialchars($user['Utilisateur']); ?></td>
                    <td><?= htmlspecialchars($user['Email']); ?></td>
                    <td><?= htmlspecialchars($user['MotDePasse']); ?></td>
                    <td><?= htmlspecialchars($user['Telephone']); ?></td>
                    <td><?= htmlspecialchars($user['Role']); ?></td>
                    <td align="center">
                        <form method="GET" action="updateUser.php">
                            <input type="hidden" value="<?= htmlspecialchars($id); ?>" name="id">
                            <button class="btn-update" type="submit">Modifier</button>
                        </form>
                    </td>
                    <td>
                        <a class="btn-delete" href="deleteUser.php?id=<?= htmlspecialchars($user['Id']); ?>">Supprimer</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>

        <?php
        // Appel de la fonction pour récupérer les statistiques
        $usersStats = $metierController->getUsersPercentage();
        ?>
        <br><br>
        <hr>
        <hr>
        <br><br>
        <h2 style="text-align: center;">Statistiques des Utilisateurs</h2>

        <!-- Tableau des résultats -->
        <table class="table-stats">
            <thead>
            <tr>
                <th>Rôle</th>
                <th>Nombre</th>
                <th>Pourcentage</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Clients</td>
                <td><?= $usersStats['clientCount']; ?></td>
                <td class="percentage"><?= $usersStats['clientPercentage']; ?>%</td>
            </tr>
            <tr>
                <td>Administrateurs</td>
                <td><?= $usersStats['adminCount']; ?></td>
                <td class="percentage"><?= $usersStats['adminPercentage']; ?>%</td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Other Sections -->
    <div id="forum-content" class="section-content">
        <h2 class="section-title">Forum</h2>
    </div>
    <div id="skillSwapp-content" class="section-content">
        <h2 class="section-title">Skill Swap</h2>
    </div>
    <div id="blog-content" class="section-content">
        <h2 class="section-title">Blog</h2>
    </div>
    <div id="quiz-content" class="section-content">
        <h2 class="section-title">Quiz</h2>
    </div>
    <div id="reclamation-content" class="section-content">
        <h2 class="section-title">Réclamation</h2>
    </div>
</div>

<script>
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.section-content');
        sections.forEach(section => {
            section.style.display = 'none';
        });
        const selectedSection = document.getElementById(sectionId + '-content');
        if (selectedSection) {
            selectedSection.style.display = 'block';
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
        showSection('profile');
    });
</script>
</body>
</html>
