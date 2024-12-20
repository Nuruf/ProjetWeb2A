<?php
require_once 'C:\xampp\htdocs\projet web\conf.php'; 
require_once 'C:\xampp\htdocs\projet web\controller\postController.php'; 

// Initialize the PostController without passing PDO
$controller = new PostController();
$posts = $controller->getAllPosts();

// If you need to fetch posts directly from the database
$pdo = DatabaseConfig::getConnexion();
$stmt = $pdo->query("SELECT * FROM posts");
$tab = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<style>iframe {
        width: 100%; /* Set width of iframe */
        height: 100vh; /* Set height relative to viewport */
        margin: auto;
        border: 2px solid #007bff; /* Add border for clarity */
        border-radius: 8px; /* Rounded corners for iframe */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for a clean look */
        display: block; /* Center the iframe horizontally */
        background-color: white; /* White background for clarity */}   
    </style>
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
    include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Model/modelUser.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Controller/controllerUser.php';

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
            <a href="http://localhost/PROJET%20WEB/View/frontend/templatefront/login.php">
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
    <section id="forum-content" class="forum-section">
        <h2 class="section-title">Forum</h2>
        <div class="content-panel">
            <h5 class="panel-header">Post List</h5>
            <table class="forum-table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tab as $post): ?>
                    <tr class="post-row">
                        <td class="text-center"><?= $post['id']; ?></td>
                        <td><strong><?= htmlspecialchars($post['title']); ?></strong></td>
                        <td><?= htmlspecialchars(substr($post['content'], 0, 100)); ?>...</td>
                        <td class="text-center">
                            <a href="delete.php?id=<?= $post['id']; ?>" class="btn-delete">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="comments-section">
                                <h6 class="comments-title">Comments:</h6>
                                <?php
                                $stmt = $pdo->prepare("SELECT * FROM comments WHERE post_id = :postId");
                                $stmt->execute(['postId' => $post['id']]);
                                $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <?php if (!empty($comments)): ?>
                                <ul class="comments-list">
                                    <?php foreach ($comments as $comment): ?>
                                    <li class="comment-item">
                                        <p class="comment-text">&ldquo;<?= htmlspecialchars($comment['comment']); ?>&rdquo;</p>
                                        <form method="POST" action="deletecomment.php" class="delete-comment-form">
                                            <input type="hidden" name="comment_id" value="<?= $comment['id']; ?>">
                                            <button type="submit" class="btn-delete-comment">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php else: ?>
                                <p class="no-comments">No comments yet. Be the first to comment!</p>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
            <div id="skillSwapp-content" class="section-content">
                <h2>Skill Swap</h2>
                <iframe src="../backoffice/listCategories.php" frameborder="0"></iframe>
                <p>Échangez vos compétences avec d'autres membres.</p>
            </div>

            <div id="blog-content" class="section-content">
                <h2>Blog</h2>
                <iframe src="../backoffice/Post_CommentDashboard.php" frameborder="0"></iframe>
            </div>

            <div id="quiz-content" class="section-content">
                <h2>Quiz</h2>
                <iframe src="../backoffice/listeQuiz.php" frameborder="0"></iframe>
                <p>Testez vos connaissances sur divers sujets.</p>
            </div>

            <div id="reclamation-content" class="section-content">
            <iframe src="../backoffice/reclamationlistadmin.php" frameborder="0"></iframe>
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
