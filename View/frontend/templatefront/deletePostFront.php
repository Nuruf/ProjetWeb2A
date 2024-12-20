<?php
require '../../../controller/PostssController.php';
session_start();
$userId = $_SESSION['user_id'];
if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    $postController = new PosttController();

    $postController->deletePost($postId,$userId);

    header("Location: blogg.php");
    exit;
}
?>
