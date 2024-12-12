<?php
include '../config.php';
include '../controller/postController.php';
include '../controller/commentController.php';

// Initialize controllers
$postController = new PostController($pdo);
$commentController = new CommentController($pdo);

$error = ''; // Variable to hold error messages

// Handle POST requests for creating a post or comment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['title']) && isset($_POST['content'])) {
        // Handle post creation
        $title = $_POST['title'];
        $content = $_POST['content'];

        // Validate input
        if (!empty($title) && !empty($content)) {
            $postController->createPost($title, $content);
            header("Location: create.php");  // Redirect after creating post
            exit;
        } else {
            $error = "Both title and content are required.";
        }
    } elseif (isset($_POST['comment']) && isset($_POST['post_id'])) {
        // Handle comment creation
        $comment = $_POST['comment'];
        $postId = $_POST['post_id'];

        // Validate input
        if (!empty($comment) && !empty($postId)) {
            $commentController->createComment($postId, $comment);
            header("Location: create.php");  // Redirect after creating comment
            exit;
        } else {
            $error = "Comment cannot be empty.";
        }
    }
}

// Fetch the selected posts based on user choice (recent or most popular)
$sortType = isset($_GET['sort_type']) ? $_GET['sort_type'] : 'recent'; // Default to recent if no option selected

if ($sortType === 'recent') {
    // Fetch recent posts sorted by creation time
    $getPosts = $postController->getRecentPosts();
} else if ($sortType === 'popular') {
    // Fetch posts sorted by the most comments
    $getPosts = $postController->getPostsByMostComments();
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
            <a href="#" class="small mr-3"><span class="icon-phone mr-2"></span> <span class="d-none d-lg-inline-block">+216 11111111</span></a> 
            <a href="#" class="small mr-3"><span class="icon-envelope mr-2"></span> <span class="d-none d-lg-inline-block">skillswap@gmail.com</span></a> 
          </div>

          

        </div>
      </div>
    </div>
    <div class="sticky-nav js-sticky-header">
      <div class="container position-relative">
        <div class="site-navigation text-center">
          <a href="index.html" class="logo menu-absolute m-0">SKILL SWAP<span class="text-primary">.</span></a>

          <ul class="js-clone-nav d-none d-lg-inline-block site-menu">
            <li><a href="index.html">Home</a></li>
            
            <li><a href="profile.html">Profile</a></li>
            <li class="active"><a href="forum.html">Forum</a></li>
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
    

  <div class="untree_co-hero overlay" style="background-image: url('images/img-school-6-min.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12">
          <div class="row justify-content-center ">
            <div class="col-lg-6 text-center ">
              <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Post</h1>
              <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
              </div>

              <p class="mb-0" data-aos="fade-up" data-aos-delay="300">slide down and create new posts to help with solving your problems and comment to help others </p>
              

            </div>


          </div>

        </div>

      </div> <!-- /.row -->
    </div> <!-- /.container -->

  </div> <!-- /.untree_co-hero -->


<!-- HTML for Post Creation and Viewing -->
<div class="container">
    <!-- Create Post Section -->
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Create Post</h5>
                </div>
                <div class="card-body">
                    <form action="create.php" method="POST" name="postForm" onsubmit="return validatePostForm()">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                            <div class="error-message" id="titleError"></div>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" class="form-control" rows="5" required></textarea>
                            <div class="error-message" id="contentError"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-round">Save</button>
                    </form>
                    <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger mt-3"><?= $error ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Dropdown for Sorting Posts -->
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <form method="GET" action="create.php">
              <h1>POSTS</h1>
                <label for="sort_type">Sort Posts By:</label>
                <select name="sort_type" id="sort_type" class="form-control" onchange="this.form.submit()">
                    <option value="recent" <?= $sortType === 'recent' ? 'selected' : '' ?>>Recent Posts</option>
                    <option value="popular" <?= $sortType === 'popular' ? 'selected' : '' ?>>Most Popular (By Comments)</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Display Posts Based on Selected Sort Type -->
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <?php if (!empty($getPosts)) :
                foreach ($getPosts as $post) :
            ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6><?= htmlspecialchars($post['title']) ?></h6>
                        </div>
                        <div class="card-body">
                            <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                            <!-- Edit Button -->
                            <a href="edit.php?id=<?= $post['id'] ?>" class="btn btn-primary">Edit</a>
                        </div>
                        <div class="card-footer">
                            <!-- Display Comments -->
                            <h6>Comments (<?= $post['comment_count'] ?>):</h6>
                            <div class="comments-section">
                                <?php 
                                $comments = $commentController->getCommentsByPostId($post['id']);
                                if (!empty($comments)) : 
                                    foreach ($comments as $comment) : ?>
                                        <div class="comment mb-2">
                                            <p><?= htmlspecialchars($comment->getComment()) ?></p>
                                            <form method="POST" action="delete_comment.php" class="d-inline">
                                                <input type="hidden" name="comment_id" value="<?= $comment->getId() ?>">
                                                <a href="deletecomment.php?id=<?= $comment->getId() ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </form>
                                            <a href="edit_comment.php?id=<?= $comment->getId() ?>" class="btn btn-warning btn-sm">Edit</a>
                                        </div>
                                    <?php endforeach; 
                                else : ?>
                                    <p>No comments yet. Be the first to comment!</p>
                                <?php endif; ?>
                            </div>

                            <!-- Add New Comment Form -->
                            <form method="POST" action="create.php">
                                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                <div class="form-group">
                                    <textarea name="comment" class="form-control" rows="2" placeholder="Write a comment..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Comment</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="alert alert-info">No posts to display yet. Create the first one!</div>
            <?php endif; ?>
        </div>
    </div>
</div>
//ratings
   

<!-- End of Create Post Form -->


<script>
  function validatePostForm() {
    let isValid = true;

    // Clear all error messages
    document.querySelectorAll('.error-message').forEach(error => error.textContent = '');

    // Get form fields
    const title = document.forms["postForm"]["title"].value.trim();
    const content = document.forms["postForm"]["content"].value.trim();

    // Title Validation
    if (title === "") {
      document.getElementById('titleError').textContent = "Title cannot be empty.";
      isValid = false;
    } else if (title.length < 5) {
      document.getElementById('titleError').textContent = "Title must be at least 5 characters long.";
      isValid = false;
    } else if (/\d/.test(title)) {
      document.getElementById('titleError').textContent = "Title must not contain numbers.";
      isValid = false;
    }

    // Content Validation
    if (content === "") {
      document.getElementById('contentError').textContent = "Content cannot be empty.";
      isValid = false;
    } else if (content.length < 1) {
      document.getElementById('contentError').textContent = "Content must be at least 1 character.";
      isValid = false;
    }

    return isValid;
  }
</script>



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


