<?php
include '../config.php';
include '../controller/postController.php';

// Initialize the PostController and fetch posts
$controller = new PostController($pdo);
$posts = $controller->getAllPosts();

// Fetch posts directly from the database (for fallback usage)
$stmt = $pdo->query("SELECT * FROM posts");
$tab = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
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
    <!-- Barre latérale -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="logoo.png" alt="Logo" class="logo">
            <link rel="shortcut icon" href="favicon.png">
            <title>SKILL SWAP ADMIN</title>
            
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
            <span>Bienvenue, <b>username</b></span>
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
        </header>

        <div class="content">
            <div id="profile-content" class="section-content">
                <h2>Profile</h2>
                <p>Gérez vos informations personnelles et vos préférences.</p>
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
                            <a href="../view/delete.php?id=<?= $post['id']; ?>" class="btn-delete">
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
                                        <form method="POST" action="../view/deletecomment.php" class="delete-comment-form">
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
