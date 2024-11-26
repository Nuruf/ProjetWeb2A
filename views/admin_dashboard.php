<?php
require_once __DIR__ . '/../controllers/PostController.php';

$postController = new PostController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'deletePost') {
        $postController->deletePost($_POST['id']);
    } elseif ($_POST['action'] === 'deleteComment') {
        $postController->deleteComment($_POST['id']);
    }
}

$posts = $postController->getPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
    <div class="navbar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="user_dashboard.php">User Dashboard</a>
    </div>

    <h1>Admin Dashboard</h1>

    <h2>Manage Posts</h2>
    <table>
        <thead>
            <tr>
                <th>Post Title</th>
                <th>Content</th>
                <th>Comments</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= htmlspecialchars($post['title']) ?></td>
                    <td><?= nl2br(htmlspecialchars($post['content'])) ?></td>
                    <td>
                        <ul>
                            <?php
                            $comments = $postController->getComments($post['id']);
                            foreach ($comments as $comment): ?>
                                <li><?= htmlspecialchars($comment['comment']) ?>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="action" value="deleteComment">
                                        <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                                        <button type="submit">Delete</button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="action" value="deletePost">
                            <input type="hidden" name="id" value="<?= $post['id'] ?>">
                            <button type="submit">Delete Post</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
