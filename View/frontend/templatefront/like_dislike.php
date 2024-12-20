<?php
// Include required files and initialize the controller
require_once 'C:\xampp\htdocs\projet web\conf.php';  // Database configuration
require_once 'C:\xampp\htdocs\projet web\controller\postController.php';  // Include the PostController

// Initialize the PostController
$postController = new PostController();

$error = ''; // Variable to hold error messages
$userId = 1; // Assume a logged-in user ID, this should be dynamically set based on your authentication system

// Handle the like/dislike request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['post_id']) && (isset($_POST['like']) || isset($_POST['dislike']))) {
        $postId = $_POST['post_id'];

        // Determine the action (like or dislike)
        if (isset($_POST['like'])) {
            $updatedPost = $postController->likePost($postId);
        } elseif (isset($_POST['dislike'])) {
            $updatedPost = $postController->dislikePost($postId);
        }

        // Handle success or error
        if (isset($updatedPost)) {
            // Optionally handle success, e.g., display updated like/dislike counts
            header("Location: create.php");  // Redirect to the page showing posts
            exit;
        } else {
            $error = "Failed to update likes or dislikes.";
        }
    } else {
        $error = "Invalid request.";
    }
}
?>

<!-- Display Error Message -->
<?php if (!empty($error)): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<!-- Like/Dislike Buttons -->
<form method="POST" action="like_dislike.php">
    <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['id']) ?>">
    <button type="submit" name="like" class="btn btn-success">Like</button>
    <button type="submit" name="dislike" class="btn btn-danger">Dislike</button>
</form>
