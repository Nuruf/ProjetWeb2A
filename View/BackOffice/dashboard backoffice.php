<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 0) {
    // Rediriger vers la page de connexion si non connecté ou rôle incorrect
   header('Location: ../../frontend/templatefront/index.php');
    exit;
}
$pp=$_SESSION['user_id'];
?>
<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB1/Model/modelUser.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB1/Controller/controllerUser.php';

    // Récupération des paramètres GET
   
    $userController = new CoursController();

  
        $user = $userController->getUserByIdd($pp);
  
?>
    <!-- Barre latérale -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="logoo.png" alt="Logo" class="logo">
            <h1>Dashboard</h1>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="#profile" onclick="showSection('profile')"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="#forum" onclick="showSection('forum')"><i class="fas fa-comments"></i> Forum</a></li>
                <li><a href="#skillSwap" onclick="showSection('skillSwapp')"><i class="fas fa-exchange-alt"></i> Skill Swap</a></li>
                <li><a href="#blog" onclick="showSection('blog')"><i class="fas fa-blog"></i> Blog</a></li>
                <li><a href="#quiz" onclick="showSection('quiz')"><i class="fas fa-question-circle"></i> Quiz</a></li>
                <li><a href="#reclamation" onclick="showSection('reclamation')"><i class="fas fa-file-alt"></i> Réclamation</a></li>
            </ul>
        </nav>
    </aside>
  
    <!-- Contenu principal -->
    <main class="main-content">
        <header class="user-info">
            <span>Bienvenue      <?= htmlspecialchars($user['Utilisateur'] ?? ''); ?> </span>
            <a href="http://localhost/PROJET%20WEB1/View/frontend/templatefront/login.php">
                <button class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </button>
            </a>
        </header>

        <div class="content">





            <div id="profile-content" class="section-content">

                <h1>Profile</h1>
                <div class="search-container">
                         <form method="GET" action="">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>" />
                                <input type="text" name="search" id="searchInput" placeholder="Rechercher un utilisateur..."
                                value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
                               <button type="submit">Rechercher</button>
                          </form>
                 </div>
<!--***********************************************************************-->
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
                        <form method="GET" action="updateUtilisateur.php">
                            <input type="hidden" value="<?= htmlspecialchars($id); ?>" name="id">
                            <button class="btn-update" type="submit">Modifier</button>
                        </form>
                    </td>
                    <td>
                        <a class="btn-delete" href="DeleteUser.php?id=<?= htmlspecialchars($user['Id']); ?>">Supprimer</a>
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

<!--***********************************************************************-->
              
            </div>

            <div id="forum-content" class="section-content">
                <h2>Forum</h2>
                <p>Participez aux discussions et interagissez avec la communauté.</p>
            </div>

            <div id="skillSwapp-content" class="section-content">
                <h2>Skill Swap</h2>
                <p>Échangez vos compétences avec d'autres membres.</p>
            </div>

            <div id="blog-content" class="section-content">
                <h2>Blog</h2>
                <p>Découvrez ou publiez des articles intéressants.</p>
            </div>

            <div id="quiz-content" class="section-content">
                <h2>Quiz</h2>
                <p>Testez vos connaissances sur divers sujets.</p>
            </div>

            <div id="reclamation-content" class="section-content">
                <h2>Réclamation</h2>
                <p>Envoyez vos réclamations ou signalez des problèmes.</p>
            </div>
        </div>
    </main>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => section.style.display = 'none');
            const selectedSection = document.getElementById(sectionId + '-content');
            if (selectedSection) selectedSection.style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSection('profile');
        });
    </script>
</body>
</html>
