<?php
include 'C:\xampp\htdocs\projet web\conf.php';
include 'C:\xampp\htdocs\projet web\controller\commentController.php';  // Include CommentController

// Initialize the controller
$commentController = new CommentController();

// Check if the 'id' parameter is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $commentId = (int)$_GET['id'];

    // Fetch the comment to ensure it exists before deletion
    $comment = $commentController->getComment($commentId);

    if ($comment) {
        // If the comment exists, delete it
        $deleteSuccess = $commentController->deleteComment($commentId);
        if ($deleteSuccess) {
            // Redirect after deletion
            header("Location: create.php");  // Redirect back to the create page (or wherever you want)
            exit;
        } else {
            echo "Error deleting comment.";
            exit;
        }
    } else {
        // Comment not found
        echo "Comment not found.";
        exit;
    }
} else {
    // Invalid or missing comment ID
    echo "Invalid or missing comment ID.";
    exit;
}
?>
