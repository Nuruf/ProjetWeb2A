    <?php
    require '../../controller/PostController.php';
    require '../../controller/CommentController.php';
    require '../../controller/LikeDislikeController.php';


    $postController = new PostController();
    $commentController = new CommentController();
    $likeDislikeController = new LikeDislikeController();
    $likeDislikeModel = new LikeDislike();


    $postId = isset($_GET['id']) ? $_GET['id'] : null;

    $postData = $postController->getPostById($postId);

    $comments = $commentController->getByPostId($postId);

    $userId = 1;


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete'])) {
            $postController->deletePost($postId);
            header("Location: ../../View/BackOffice/posts_list.php");
            exit;
        } else {
            $userId = 1;
            $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

            if (!empty($comment)) {
                $commentController->create($postId, $userId, $comment);
                header("Location: ?id=" . $postId);
                exit;
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_comment'])) {
        $commentId = $_POST['commentId'];
        $content = $_POST['content'];
        $commentController->update($commentId, $content);
        header("Location: postDetails.php?id=$postId");
        exit();
    }

    if (isset($_POST['delete_comment'])) {
        $commentId = $_POST['commentId'];
        $commentController->delete($commentId);
        header("Location: postDetails.php?id=$postId");
        exit();
    }


    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($postData->getTitle()); ?></title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="dashboard.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="postDetails.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>

    <div class="user-info">
        <img src="logoo.png" alt="User Profile">
        <span>bienvenue sur notre site  : username</span>
    </div>

    <nav>
        <ul>
            <li><a href="#profile" onclick="showSection('profile')">Profile</a></li>
            <li><a href="posts_list.php" onclick="showSection('forum')">Forum</a></li>
            <li><a href="#skillSwap" onclick="showSection('skillSwapp')">Skill Swapp</a></li>
            <li><a href="#blog" onclick="showSection('blog')">Blog</a></li>
            <li><a href="#Quiz" onclick="showSection('quiz')">Quiz</a></li>
            <li><a href="#Reclamation" onclick="showSection('reclamation')">Réclamation</a></li>
        </ul>
    </nav>
        <div class="container">
            <!-- Post Card -->
            <div class="post-card">
                <a href="posts_list.php"><i class="bi bi-arrow-left-circle me-2"></i>Go Back</a>

                <?php if ($postData): ?>
                    <div class="video-section">
                        <!-- Add Bootstrap classes for responsiveness -->
                        <video controls class="w-100">
                            <source src="../../assets/videos/<?php echo $postData->getVideoName(); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    <!-- Details Section -->
                    <div class="details-section">
                        <!-- Author -->
                        <div class="author">
                            <img src="https://via.placeholder.com/50" alt="Author">
                            <div>
                                <h6>John Doe</h6>
                                <small>2 days ago</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h3 class="fw-bold text-primary">Post Title:<br><?php echo htmlspecialchars($postData->getTitle()); ?></h3>
                            <p class="description">
                                Description: 
                                <?php echo nl2br(htmlspecialchars($postData->getContent())); ?>
                                <br>
                                Video Name: <?php echo $postData->getVideoName(); ?>
                            </p>
                        </div>
                        <!-- Actions -->
                            <!-- <div class="actions">
                            <button id="postLikeBtn" class="btn btn-outline-primary" onclick="vote(<?php echo $postId; ?>, null, 1)">Like
                            <i class="fa-regular fa-thumbs-up"></i>
                            </button>
                            <button id="postDislikeBtn" class="btn btn-outline-danger" onclick="vote(<?php echo $postId; ?>, null, 0)">Dislike
                            <i class="fa-regular fa-thumbs-down"></i>
                            </button>
                            </div> -->


                        <div>
                            <!-- Post Actions -->
                            <form action="" method="POST" class="mt-4">
                                <input type="hidden" name="delete" value="1">
                                <button type="submit" class="btn btn-danger">Delete Post</button>
                                <a href="updatePost.php?id=<?php echo $postId ?>" class="btn btn-warning">Update Post</a>
                            </form>
                        </div>
                    <?php else: ?>
                        <p class="alert alert-warning">Post not found.</p>
                    <?php endif; ?>

                        <!-- Comments Section -->
                        <div class="comments-section">
                            <h5>Comments</h5>

                            <!-- Comment Form
                            <form method="POST" class="comment-form mb-3">
                                <textarea name="comment" rows="2" placeholder="Write a comment..." required></textarea>
                                <button type="submit" class="btn btn-sm btn-primary mt-2">Post Comment</button>
                            </form> -->

                            <!-- Display Comments -->
                            <?php if (!empty($comments)): ?>
                                <?php foreach ($comments as $comment):
                                    $commentLiked = $likeDislikeModel->isCommentLikedByUser($userId, $comment->getId());
                                    $commentDisliked = $likeDislikeModel->isCommentDislikedByUser($userId, $comment->getId());
                                
                                    $commentVotes[$comment->getId()] = [
                                        'liked' => $commentLiked,
                                        'disliked' => $commentDisliked,
                                    ]; ?>
                                    
                                    <div class="comment mb-3">
                                        <img src="https://via.placeholder.com/40" alt="User" class="rounded-circle">
                                        <div class="comment-content">
                                            <h6>User <?php echo htmlspecialchars($comment->getUserId()); ?> <p><?php echo htmlspecialchars($comment->getCreatedAt()); ?></p></h6>
                                            <p><?php echo nl2br(htmlspecialchars($comment->getComment())); ?></p>
                                            <div class="comment-actions">
                                                <!-- <button id="likeComment<?php echo $comment->getId(); ?>" class="btn btn-outline-primary" onclick="vote(null, <?php echo $comment->getId(); ?>, 1)">Like
                                                <i class="fa-regular fa-thumbs-up"></i>
                                                </button>
                                                <button id="dislikeComment<?php echo $comment->getId(); ?>" class="btn btn-outline-danger" onclick="vote(null, <?php echo $comment->getId(); ?>, 0)">Dislike
                                                <i class="fa-regular fa-thumbs-down"></i>
                                                </button> -->
                                                <button type="button" class="btn btn-sm btn-warning" onclick="editComment(<?php echo $comment->getId(); ?>, '<?php echo addslashes($comment->getComment()); ?>')"><i class="fa-solid fa-pen"></i> Modify</button>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="hidden" name="commentId" value="<?php echo htmlspecialchars($comment->getId()); ?>">
                                                    <button type="submit" name="delete_comment" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-info" role="alert">
                                    No comments yet. Be the first to share your thoughts!
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Edit Comment Modal -->
                <div id="editCommentModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <input type="hidden" name="commentId" id="editCommentId">
                                    <textarea name="content" id="editCommentContent" class="form-control" rows="4"></textarea>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="update_comment" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
    </div>

    <script>
// function vote(postId, commentId, isLike) {
//     $.ajax({
//         url: 'postDetails.php?id=' + postId,
//         type: 'POST',
//         contentType: 'application/json',
//         data: JSON.stringify({
//             action: 'vote',
//             post_id: postId,
//             comment_id: commentId,
//             is_like: isLike
//         }),
//         success: function(response) {
//             try {
//                 const data = JSON.parse(response);
//                 if (data.success) {
//                     updateButtonColors(postId, commentId, isLike);
//                 } else {
//                     alert(data.error || "An error occurred while voting.");
//                 }
//             } catch (e) {
//                 alert("Unexpected response: " + response);
//             }
//         },
//         error: function(xhr, status, error) {
//             alert('Error occurred while processing your vote. ' + error);
//         }
//     });
// }

// function updateButtonColors(postId, commentId, isLike) {
//     if (postId) {
//         $('#postLikeBtn').removeClass('btn-primary btn-outline-primary').addClass(isLike == 1 ? 'btn-success' : 'btn-outline-primary');
//         $('#postDislikeBtn').removeClass('btn-danger btn-outline-danger').addClass(isLike == 0 ? 'btn-danger' : 'btn-outline-danger');
//     } else if (commentId) {
//         const likeBtn = $(`#likeComment${commentId}`);
//         const dislikeBtn = $(`#dislikeComment${commentId}`);
//         likeBtn.removeClass('btn-primary btn-outline-primary').addClass(isLike == 1 ? 'btn-success' : 'btn-outline-primary');
//         dislikeBtn.removeClass('btn-danger btn-outline-danger').addClass(isLike == 0 ? 'btn-danger' : 'btn-outline-danger');
//     }

  

// }
        </script>
        <script>
            function editComment(commentId, content) {
                $('#editCommentId').val(commentId);
                $('#editCommentContent').val(content);
                $('#editCommentModal').modal('show');
            }
        </script>
<script>
    // Pass these variables from your PHP (see the PHP code in the previous response)
    const postLiked = <?php echo json_encode($postLiked); ?>; 
    const postDisliked = <?php echo json_encode($postDisliked); ?>; 
    const commentVotes = <?php echo json_encode($commentVotes); ?>; 

    $(document).ready(function() {
        const postId = <?php echo $postId; ?>;
        const comments = <?php echo json_encode($comments); ?>;

        // Highlight post buttons
        if (postLiked) {
            $('#postLikeBtn').removeClass('btn-outline-primary').addClass('btn-primary');
        } else if (postDisliked) {
            $('#postDislikeBtn').removeClass('btn-outline-danger').addClass('btn-danger');
        }

        // Highlight comment buttons
        comments.forEach(comment => {
            const commentId = comment.id;
            if (commentVotes[commentId] && commentVotes[commentId]['liked']) {
                $(`#likeComment${commentId}`).removeClass('btn-outline-primary').addClass('btn-primary');
            } else if (commentVotes[commentId] && commentVotes[commentId]['disliked']) {
                $(`#dislikeComment${commentId}`).removeClass('btn-outline-danger').addClass('btn-danger');
            }
        });
    });
</script>

    </body>

    </html>
