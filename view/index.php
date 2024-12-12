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
    <link rel="shortcut icon" href="favicon.png">
    <title>SKILL SWAP ADMIN</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <!-- User Information Section -->
    <header class="user-info">
        <img src="logoo.png" alt="User Profile" class="user-avatar">
        <span>Bienvenue sur notre site : <strong>username</strong></span>
    </header>

    <!-- Navigation Menu -->
    <nav>
        <ul class="nav-menu">
            <li><a href="#profile" onclick="showSection('profile')">Profile</a></li>
            <li><a href="#forum" onclick="showSection('forum')">Forum</a></li>
            <li><a href="#skillSwap" onclick="showSection('skillSwapp')">Skill Swap</a></li>
            <li><a href="#blog" onclick="showSection('blog')">Blog</a></li>
            <li><a href="#quiz" onclick="showSection('quiz')">Quiz</a></li>
            <li><a href="#reclamation" onclick="showSection('reclamation')">Réclamation</a></li>
        </ul>
    </nav>

    <!-- Content Section -->
    <main class="content">
        <!-- Profile Section -->
        <section id="profile-content" class="section-content">
            <h2 class="section-title">Profile</h2>
            <p class="section-description">
                Welcome to your profile. Here you can manage your personal information, preferences, and settings.
            </p>
        </section>

        <!-- Forum Section -->
<section id="forum-content" class="forum-section">
    <h2 class="section-title">Forum</h2>
    <div class="content-panel">
        <h5 class="panel-header">Post List</h5>
        <table class="forum-table">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tab as $post): ?>
                    <!-- Post Section -->
                    <tr class="post-row">
                        <td class="text-center"><?= $post['id']; ?></td>
                        <td><strong><?= htmlspecialchars($post['title']); ?></strong></td>
                        <td><?= htmlspecialchars(substr($post['content'], 0, 50)); ?></td>
                        <td>
                            <a href="../view/delete.php?id=<?= $post['id']; ?>" class="btn btn-danger btn-sm">
                                Delete Post
                            </a>
                        </td>
                    </tr>
                    <!-- Comments Section -->
                    <tr>
                        <td colspan="4">
                            <div class="comments-section">
                                <h6>Comments:</h6>
                                <?php
                                // Fetch comments for the current post
                                $stmt = $pdo->prepare("SELECT * FROM comments WHERE post_id = :postId");
                                $stmt->execute(['postId' => $post['id']]);
                                $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <?php if (count($comments) > 0): ?>
                                    <ul class="list-group">
                                        <?php foreach ($comments as $comment): ?>
                                            <li class="list-group-item">
                                                <p><?= htmlspecialchars($comment['comment']); ?></p>
                                                <form method="POST" action="../view/deletecomment.php" class="d-inline">
                                                    <input type="hidden" name="comment_id" value="<?= $comment['id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Delete Comment
                                                    </button>
                                                </form>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p>No comments yet. Be the first to comment!</p>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    //rating 
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>


        <!-- Skill Swap Section -->
        <section id="skillSwapp-content" class="section-content">
            <h2 class="section-title">Skill Swap</h2>
            <p class="section-description">
                Exchange skills with other members of the community. Find new opportunities for learning and teaching.
            </p>
        </section>

        <!-- Blog Section -->
        <section id="blog-content" class="section-content">
            <h2 class="section-title">Blog</h2>
            <p class="section-description">
                Contribute to or read interesting posts in our community blog. Stay updated with the latest trends.
            </p>
        </section>

        <!-- Quiz Section -->
        <section id="quiz-content" class="section-content">
            <h2 class="section-title">Quiz</h2>
            <p class="section-description">
                Test your knowledge on various topics with our fun quizzes. Challenge yourself and others!
            </p>
        </section>

        <!-- Réclamation Section -->
        <section id="reclamation-content" class="section-content">
            <h2 class="section-title">Réclamation</h2>
            <p class="section-description">
                Submit any issues or complaints to the admin. We are here to help resolve any problems.
            </p>
        </section>
    </main>

    <!-- JavaScript for Section Navigation -->
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
