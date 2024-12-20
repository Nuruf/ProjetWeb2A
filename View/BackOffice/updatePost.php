<?php
require_once '../../controller/PostssController.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Projet Web/model/modelUser.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Projet Web/controller/controllerUser.php';
session_start();
// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 0) {
    // Rediriger vers la page de connexion si non connecté ou rôle incorrect
   header('Location: ../../frontend/templatefront/index.php');
    exit;
}
$pp=$_SESSION['user_id'];

// Récupération des paramètres GET

$userController = new CoursController();


    $user = $userController->getUserByIdd($pp);

$postController = new PosttController();
$postId = isset($_GET['id']) ? $_GET['id'] : null;
$postData = $postController->getPostById($postId);

if (!$postData) {
    echo "Post not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $videoFile = isset($_FILES['video']) ? $_FILES['video'] : null;
    // Validate video upload
    $allowedFormats = ['video/mp4', 'video/webm', 'video/ogg'];
    $maxFileSize = 50 * 1024 * 1024; // 50MB

    if ($videoFile['size'] > $maxFileSize) {
        echo "File size exceeds 50MB.";
        exit;
    }

    try {
        $postController->updatePostAdmin($id, $title, $content, $videoFile);
        echo "<div class='alert alert-success'>Post updated successfully.</div>";
         header("Location: Post_CommentDashboard.php");
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}

?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
       
       

<div class="container my-5">
    <h1>Update Post</h1>
    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateUpdateForm();">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($postData->getId()); ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($postData->getTitle()); ?>" >
            <div id="titleError" class="text-danger d-none">Title must be at least 5 characters.</div>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4" ><?php echo htmlspecialchars($postData->getContent()); ?></textarea>
            <div id="contentError" class="text-danger d-none">Content must be at least 20 characters.</div>

        </div>
        <div class=" mb-3">
        <label for="video" class="form-label">Video (optional)</label>
    <?php if (!empty($postData->getVideoName())): ?>
        <p>Current Video: 
            <a href="../../assets/videos/<?php echo htmlspecialchars($postData->getVideoName()); ?>" target="_blank">
                <?php echo htmlspecialchars($postData->getVideoName()); ?>
            </a>
        </p>
    <?php endif; ?>
    <input type="file" class="form-control" id="video" name="video">
    <div id="videoError" class="text-danger d-none">Please upload a valid video file.</div>
    <small class="form-text text-muted">Leave blank if you don't want to change the video.</small>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
    <?php if (!empty($postData->getVideoName())): ?>
    <video width="320" height="240" controls>
        <source src="../../assets/videos/<?php echo htmlspecialchars($postData->getVideoName()); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
<?php endif; ?>

</div>
</body>
<script>
   function validateUpdateForm() {
    let isValid = true;

    // Get form fields
    const title = document.getElementById('title').value.trim();
    const content = document.getElementById('content').value.trim();
    const video = document.getElementById('video').files[0];

    // Error elements
    const titleError = document.getElementById('titleError');
    const contentError = document.getElementById('contentError');
    const videoError = document.getElementById('videoError');

    // Reset errors
    titleError.classList.add('d-none');
    contentError.classList.add('d-none');
    videoError.classList.add('d-none');

    // Title validation
    if (title.length < 5) {
        titleError.classList.remove('d-none');
        isValid = false;
    }

    // Content validation
    if (content.length < 20) {
        contentError.classList.remove('d-none');
        isValid = false;
    }

    // Video validation
    if (video) {
        if (!['video/mp4', 'video/webm', 'video/ogg'].includes(video.type)) {
            videoError.textContent = "Only MP4, WebM, and OGG formats are allowed.";
            videoError.classList.remove('d-none');
            isValid = false;
        } else if (video.size > 50 * 1024 * 1024) {  // 50MB size limit
            videoError.textContent = "File size exceeds 50MB.";
            videoError.classList.remove('d-none');
            isValid = false;
        }
    } 

    return isValid;
}


</script>
</html>