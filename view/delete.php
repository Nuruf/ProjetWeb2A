<?php
include '../config.php';
include '../controller/postController.php';
 // Change controller to PostController

$controller = new PostController($pdo);

// Validate the 'id' parameter
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Fetch the post to ensure it exists before deletion
    $post = $controller->getPost($id);

    if ($post) {
        // If the post exists, delete it
        $controller->deletePost($id);
        // Redirect after deletion
        header("Location: back.php");
        exit;
    } else {
        // Post not found
        echo "Post not found.";
        exit;
    }
} else {
    echo "Invalid or missing ID.";
    exit;
}
?>
