<!-- /*
* Template Name: Learner
* Template Author: Untree.co
* Tempalte URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->

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
      // Handling new comment submission
      if (isset($_POST['comment'])) {
          $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';
  
          if (!empty($comment)) {
              $commentController->create($postId, $userId, $comment);
              header("Location: ?id=" . $postId);
              exit;
          }
      }
  
      // Handling comment update
      if (isset($_POST['update_comment'])) {
          $commentId = $_POST['commentId'];
          $content = $_POST['content'];
  
          if (!empty($content)) {
              $commentController->update($commentId, $content);
              header("Location: postDetailsFront.php?id=$postId");
              exit();
          }
      }
        // handeling comment delete
      if (isset($_POST['delete_comment'])) {
        $commentId = $_POST['commentId'];
        $commentController->delete($commentId);
        header("Location: postDetailsFront.php?id=$postId");
        exit();
    }
  }

  // Handle like/dislike actions via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $postData = json_decode(file_get_contents('php://input'), true);
  if (isset($postData['action']) && $postData['action'] === 'vote') {
      $postId = $postData['post_id'] ?? null;
      $commentId = $postData['comment_id'] ?? null;
      $isLike = $postData['is_like'] ?? null;

      if (!$postId && !$commentId) {
          echo json_encode(["error" => "Either post_id or comment_id must be provided."]);
          exit();
      }

      try {
          $existingVote = $likeDislikeModel->hasVoted($userId, $postId, $commentId);
          if ($existingVote) {
              if ($existingVote['is_like'] == $isLike) {
                  $likeDislikeController->cancelVote($userId, $postId, $commentId);
                  echo json_encode(["success" => true, "message" => "Vote cancelled."]);
              } else {
                  $likeDislikeController->updateVote($userId, $postId, $commentId, $isLike);
                  echo json_encode(["success" => true, "message" => "Vote updated."]);
              }
          } else {
              $likeDislikeController->vote($userId, $postId, $commentId, $isLike);
              echo json_encode(["success" => true, "message" => "Vote processed."]);
          }
      } catch (Exception $e) {
          echo json_encode(["error" => "Failed to record vote. Please try again later."]);
      }
      exit();
  }
  echo json_encode(["error" => "Invalid action"]);
  exit();
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../BackOffice/postDetails.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <title>Skill Swap</title>
</head>

<body>

  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>


  
  <nav class="site-nav mb-5">
    <div class="pb-2 top-bar mb-3">
      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-lg-9">
            <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> <span class="d-none d-lg-inline-block">Have a questions?</span></a> 
            <a href="#" class="small mr-3"><span class="icon-phone mr-2"></span> <span class="d-none d-lg-inline-block">10 20 123 456</span></a> 
            <a href="#" class="small mr-3"><span class="icon-envelope mr-2"></span> <span class="d-none d-lg-inline-block">info@mydomain.com</span></a> 
          </div>

          <div class="col-6 col-lg-3 text-right">
            <a href="login.html" class="small mr-3">
              <span class="icon-lock"></span>
              Log In
            </a>
            <a href="register.html" class="small">
              <span class="icon-person"></span>
              Register
            </a>
          </div>

        </div>
      </div>
    </div>
    <div class="sticky-nav js-sticky-header">
      <div class="container position-relative">
        <div class="site-navigation text-center">
          <a href="index.html" class="logo menu-absolute m-0">Learner<span class="text-primary">.</span></a>

          <ul class="js-clone-nav d-none d-lg-inline-block site-menu">
            <li><a href="index.html">Home</a></li>
            
            <li><a href="profile.html">Profile</a></li>
            <li><a href="forum.php">Forum</a></li>
            <li><a href="skillswap.html">SKILL SWAP</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="quiz.html">Quiz</a></li>
            <li><a href="reclamation.html">Reclamation</a></li>
          </ul>

          <a href="#" class="btn-book btn btn-secondary btn-sm menu-absolute">Enroll Now</a>

          <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
            <span></span>
          </a>

        </div>
      </div>
    </div>
  </nav>
  

  <div class="untree_co-hero inner-page overlay" style="background-image: url('images/img-school-5-min.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12">
          <div class="row justify-content-center ">
            <div class="col-lg-6 text-center ">
              <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Login</h1>

            </div>
          </div>
        </div>
      </div> <!-- /.row -->
    </div> <!-- /.container -->

  </div> <!-- /.untree_co-hero -->




  <div class="untree_co-section">
    <div class="container">

      <!-- Post Card -->
      <div class="post-card">
                <a href="forum.php"><i class="bi bi-arrow-left-circle me-2"></i>Go Back</a>

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
                            <div class="actions">
                            <button id="postLikeBtn" class="btn btn-outline-primary" onclick="vote(<?php echo $postId; ?>, null, 1)">Like
                            <i class="fa-regular fa-thumbs-up"></i>
                            </button>
                            <button id="postDislikeBtn" class="btn btn-outline-danger" onclick="vote(<?php echo $postId; ?>, null, 0)">Dislike
                            <i class="fa-regular fa-thumbs-down"></i>
                            </button>
                            </div>


                        <div>
                            <!-- Post Actions
                            <form action="" method="POST" class="mt-4">
                                <input type="hidden" name="delete" value="1">
                                <button type="submit" class="btn btn-danger">Delete Post</button>
                                <a href="updatePost.php?id=<?php echo $postId ?>" class="btn btn-warning">Update Post</a>
                            </form> -->
                        </div>
                    <?php else: ?>
                        <p class="alert alert-warning">Post not found.</p>
                    <?php endif; ?>

                        <!-- Comments Section -->
                        <div class="comments-section">
                            <h5>Comments</h5>

                            <!-- Comment Form -->
                            <form method="POST" class="comment-form mb-3">
                                <textarea name="comment" rows="2" placeholder="Write a comment..." required></textarea>
                                <button type="submit" class="btn btn-sm btn-primary mt-2">Post Comment</button>
                            </form>

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
                                                <button id="likeComment<?php echo $comment->getId(); ?>" class="btn btn-outline-primary" onclick="vote(null, <?php echo $comment->getId(); ?>, 1)">Like
                                                <i class="fa-regular fa-thumbs-up"></i>
                                                </button>
                                                <button id="dislikeComment<?php echo $comment->getId(); ?>" class="btn btn-outline-danger" onclick="vote(null, <?php echo $comment->getId(); ?>, 0)">Dislike
                                                <i class="fa-regular fa-thumbs-down"></i>
                                                </button>
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

      
    </div>
  </div> <!-- /.untree_co-section -->

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

  <div class="site-footer">


    <div class="container">

      <div class="row">
        <div class="col-lg-3 mr-auto">
          <div class="widget">
            <h3>About Us<span class="text-primary">.</span> </h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div> <!-- /.widget -->
          <div class="widget">
            <h3>Connect</h3>
            <ul class="list-unstyled social">
              <li><a href="#"><span class="icon-instagram"></span></a></li>
              <li><a href="#"><span class="icon-twitter"></span></a></li>
              <li><a href="#"><span class="icon-facebook"></span></a></li>
              <li><a href="#"><span class="icon-linkedin"></span></a></li>
              <li><a href="#"><span class="icon-pinterest"></span></a></li>
              <li><a href="#"><span class="icon-dribbble"></span></a></li>
            </ul>
          </div> <!-- /.widget -->
        </div> <!-- /.col-lg-3 -->

        <div class="col-lg-2 ml-auto">
          <div class="widget">
            <h3>Projects</h3>
            <ul class="list-unstyled float-left links">
              <li><a href="#">Web Design</a></li>
              <li><a href="#">HTML5</a></li>
              <li><a href="#">CSS3</a></li>
              <li><a href="#">jQuery</a></li>
              <li><a href="#">Bootstrap</a></li>
            </ul>
          </div> <!-- /.widget -->
        </div> <!-- /.col-lg-3 -->

        <div class="col-lg-3">
          <div class="widget">
            <h3>Gallery</h3>
            <ul class="instafeed instagram-gallery list-unstyled">
              <li><a class="instagram-item" href="images/gal_1.jpg" data-fancybox="gal"><img src="images/gal_1.jpg" alt="" width="72" height="72"></a>
              </li>
              <li><a class="instagram-item" href="images/gal_2.jpg" data-fancybox="gal"><img src="images/gal_2.jpg" alt="" width="72" height="72"></a>
              </li>
              <li><a class="instagram-item" href="images/gal_3.jpg" data-fancybox="gal"><img src="images/gal_3.jpg" alt="" width="72" height="72"></a>
              </li>
              <li><a class="instagram-item" href="images/gal_4.jpg" data-fancybox="gal"><img src="images/gal_4.jpg" alt="" width="72" height="72"></a>
              </li>
              <li><a class="instagram-item" href="images/gal_5.jpg" data-fancybox="gal"><img src="images/gal_5.jpg" alt="" width="72" height="72"></a>
              </li>
              <li><a class="instagram-item" href="images/gal_6.jpg" data-fancybox="gal"><img src="images/gal_6.jpg" alt="" width="72" height="72"></a>
              </li>
            </ul>
          </div> <!-- /.widget -->
        </div> <!-- /.col-lg-3 -->


        <div class="col-lg-3">
          <div class="widget">
            <h3>Contact</h3>
            <address>43 Raymouth Rd. Baltemoer, London 3910</address>
            <ul class="list-unstyled links mb-4">
              <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
              <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
              <li><a href="mailto:info@mydomain.com">info@mydomain.com</a></li>
            </ul>
          </div> <!-- /.widget -->
        </div> <!-- /.col-lg-3 -->

      </div> <!-- /.row -->

      <div class="row mt-5">
        <div class="col-12 text-center">
          <p class="copyright">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a>  Distributed By <a href="https://themewagon.com">ThemeWagon</a> <!-- License information: https://untree.co/license/ -->
          </div>
        </div>
      </div> <!-- /.container -->
    </div> <!-- /.site-footer -->

    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    
    
    
    
    
    
    
    
    
    <script>
function vote(postId, commentId, isLike) {
    $.ajax({
        url: 'postDetailsFront.php?id=' + postId,
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            action: 'vote',
            post_id: postId,
            comment_id: commentId,
            is_like: isLike
        }),
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if (data.success) {
                    updateButtonColors(postId, commentId, isLike);
                } else {
                    alert(data.error || "An error occurred while voting.");
                }
            } catch (e) {
                alert("Unexpected response: " + response);
            }
        },
        error: function(xhr, status, error) {
            alert('Error occurred while processing your vote. ' + error);
        }
    });
}

function updateButtonColors(postId, commentId, isLike) {
    if (postId) {
        $('#postLikeBtn').removeClass('btn-primary btn-outline-primary').addClass(isLike == 1 ? 'btn-success' : 'btn-outline-primary');
        $('#postDislikeBtn').removeClass('btn-danger btn-outline-danger').addClass(isLike == 0 ? 'btn-danger' : 'btn-outline-danger');
    } else if (commentId) {
        const likeBtn = $(`#likeComment${commentId}`);
        const dislikeBtn = $(`#dislikeComment${commentId}`);
        likeBtn.removeClass('btn-primary btn-outline-primary').addClass(isLike == 1 ? 'btn-success' : 'btn-outline-primary');
        dislikeBtn.removeClass('btn-danger btn-outline-danger').addClass(isLike == 0 ? 'btn-danger' : 'btn-outline-danger');
    }

  

}
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

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/custom.js"></script>

  </body>

  </html>
