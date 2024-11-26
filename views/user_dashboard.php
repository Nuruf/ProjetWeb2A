<?php 
require_once __DIR__ . '/../controllers/PostController.php';

$postController = new PostController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'addPost') {
        $postController->addPost($_POST['title'], $_POST['content']);
    } elseif ($_POST['action'] === 'addComment') {
        $postController->addComment($_POST['post_id'], $_POST['comment']);
    } elseif ($_POST['action'] === 'editPost') {
        $postController->editPost($_POST['id'], $_POST['title'], $_POST['content']);
    } elseif ($_POST['action'] === 'editComment') {
        $postController->editComment($_POST['id'], $_POST['comment']);
    }
}

$posts = $postController->getPosts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="userstyle.css">
    <style>
        /* General Styles */
        

    </style>
</head>
<body>

<header>Dashboard</header>

<!-- User Info -->
<div class="user-info">
    <img src="logoo.png" alt="User Profile">
    <span>Bienvenue sur notre site : username</span>
</div>

<!-- Navigation Bar -->
<nav>
    <ul>
        <li><a href="#profile" onclick="showSection('profile')">Profile</a></li>
        <li><a href="#forum" onclick="showSection('forum')">Forum</a></li>
        <li><a href="#skillSwap" onclick="showSection('skillSwapp')">Skill Swap</a></li>
        <li><a href="#blog" onclick="showSection('blog')">Blog</a></li>
        <li><a href="#Quiz" onclick="showSection('quiz')">Quiz</a></li>
        <li><a href="#Reclamation" onclick="showSection('reclamation')">Réclamation</a></li>
    </ul>
</nav>

<!-- Content Area -->
<div class="content">
    <!-- Profile Section -->
    <div id="profile-content" class="section-content">
        <h2 class="section-title">Profile</h2>
        <p>Manage your personal information, preferences, and settings.</p>
    </div>

    <!-- Blog Section with Posts -->
    <div id="blog-content" class="section-content">
        <h2 class="section-title">Blog</h2>

        <form method="POST">
            <h3>Create a Post</h3>
            <input type="hidden" name="action" value="addPost">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Content" required></textarea>
            <button type="submit">Post</button>
        </form>

        <!-- Display Posts -->
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h4><?= htmlspecialchars($post['title']) ?></h4>
                <p><?= htmlspecialchars($post['content']) ?></p>

                <!-- Edit Post Form -->
                <form method="POST">
                    <input type="hidden" name="action" value="editPost">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
                    <textarea name="content" required><?= htmlspecialchars($post['content']) ?></textarea>
                    <button type="submit">Edit Post</button>
                </form>

                <!-- Comments Section -->
                <div class="comment-section">
                    <h4>Comments:</h4>

                    <?php $comments = $postController->getComments($post['id']);
                    foreach ($comments as $comment): ?>
                        <div class="comment">
                            <p><?= htmlspecialchars($comment['comment']) ?></p>

                            <!-- Edit Comment Form -->
                            <form method="POST">
                                <input type="hidden" name="action" value="editComment">
                                <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                                <textarea name="comment" required><?= htmlspecialchars($comment['comment']) ?></textarea>
                                <button type="submit">Edit Comment</button>
                            </form>
                        </div>
                    <?php endforeach; ?>

                    <!-- Add Comment Form -->
                    <form method="POST">
                        <input type="hidden" name="action" value="addComment">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <textarea name="comment" placeholder="Add your comment here" required></textarea>
                        <button type="submit">Add Comment</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.section-content');
        sections.forEach(section => section.style.display = 'none');

        const selectedSection = document.getElementById(sectionId + '-content');
        if (selectedSection) selectedSection.style.display = 'block';
    }

    document.addEventListener('DOMContentLoaded', () => showSection('profile'));
</script>

</body>
</html>
