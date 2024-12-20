<?php
include 'C:\xampp\htdocs\projet web\conf.php';
include 'C:\xampp\htdocs\projet web\controller\commentController.php';  // Include CommentController

// Initialize the CommentController
$commentController = new CommentController();

// Check if the 'id' parameter is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $commentId = (int)$_GET['id'];

    // Fetch the existing comment to edit
    $comment = $commentController->getComment($commentId);

    if (!$comment) {
        // If the comment doesn't exist, display an error
        echo "Comment not found.";
        exit;
    }
} else {
    // If the 'id' parameter is not set or is invalid, show an error
    echo "Invalid or missing comment ID.";
    exit;
}

// Handle form submission to update the comment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['comment'])) {
        // Get the new comment text from the form
        $newCommentText = $_POST['comment'];

        // Validate the new comment
        if (!empty($newCommentText)) {
            // Update the comment in the database
            $updateSuccess = $commentController->updateComment($commentId, $newCommentText);

            if ($updateSuccess) {
                // Redirect back to the post page after successful update
                header("Location: create.php");
                exit;
            } else {
                $error = "Error updating comment.";
            }
        } else {
            $error = "Comment cannot be empty.";
        }
    }
}
?>

<!-- HTML for the Edit Comment Form -->
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Edit Comment</h5>
                </div>
                <div class="card-body">
                    <!-- Edit comment form -->
                    <form action="edit_comment.php?id=<?= $comment->getId() ?>" method="POST">
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea name="comment" class="form-control" rows="4"><?= htmlspecialchars($comment->getComment()) ?></textarea>
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger mt-2"><?= $error ?></div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Comment</button>
                        <a href="create.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
