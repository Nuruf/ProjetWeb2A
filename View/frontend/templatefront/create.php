<?php 
require_once 'C:\xampp\htdocs\projet web\conf.php';
require_once 'C:\xampp\htdocs\projet web\controller\postController.php';
require_once 'C:\xampp\htdocs\projet web\controller\commentController.php';

// Initializing controllers without PDO parameter
$postController = new PostController();
$commentController = new CommentController();

$error = ''; 
$commentError = ''; 
$success = ''; // Added success message variable

// Handle POST requests for creating a post or comment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['title']) && isset($_POST['content'])) {
        // Handle post creation
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        // Validate input
        if (!empty($title) && !empty($content)) {
            try {
                $newPost = $postController->createPost($title, $content);
                if ($newPost) {
                    $success = "Post created successfully!";
                    // Optional: Redirect with success message
                    header("Location: create.php?success=post_created");
                    exit;
                } else {
                    $error = "Failed to create post. Please try again.";
                }
            } catch (Exception $e) {
                $error = "Error: " . $e->getMessage();
            }
        } else {
            $error = "Both title and content are required.";
        }
    } elseif (isset($_POST['comment']) && isset($_POST['post_id'])) {
        // Handle comment creation
        $comment = trim($_POST['comment']);
        $postId = filter_var($_POST['post_id'], FILTER_VALIDATE_INT);

        // Validate input
        if (!$postId) {
            $commentError = "Invalid post ID.";
        } elseif (empty($comment)) {
            $commentError = "Comment cannot be empty.";
        } else {
            try {
                $result = $commentController->createComment($postId, $comment);
                if ($result) {
                    $success = "Comment added successfully!";
                    // Optional: Redirect with success message
                    header("Location: create.php?success=comment_added#post-" . $postId);
                    exit;
                } else {
                    $commentError = "Unable to create comment.";
                }
            } catch (Exception $e) {
                $commentError = $e->getMessage();
            }
        }
    }
}

// Fetch posts based on sort type
try {
    $sortType = isset($_GET['sort_type']) ? filter_var($_GET['sort_type'], FILTER_SANITIZE_STRING) : 'recent'; 

    $getPosts = match($sortType) {
        'popular' => $postController->getPostsByMostComments(),
        'recent' => $postController->getRecentPosts(),
        default => $postController->getRecentPosts(),
    };
} catch (Exception $e) {
    $error = "Error loading posts: " . $e->getMessage();
    $getPosts = [];
}

// If there's a success message in URL parameters, store it
if (isset($_GET['success'])) {
    switch($_GET['success']) {
        case 'post_created':
            $success = "Post created successfully!";
            break;
        case 'comment_added':
            $success = "Comment added successfully!";
            break;
    }
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
            
            <li><a href="profile.php">Profile</a></li>
            <li class="active"><a href="create.php">Forum</a></li>
            <li><a href="skillswap.php">SKILL SWAP</a></li>
            <li><a href="blogg.php">Blog</a></li>
            <li ><a href="gestion_quiz.php">Quiz</a></li>
            <li ><a href="reclamation.php">Reclamation</a></li>
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
                        <input type="text" name="title" class="form-control">
                        <div class="error-message" id="titleError"></div>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" class="form-control" rows="5"></textarea>
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
                    <!-- Like/Dislike Buttons -->
                    <div class="d-flex align-items-center reaction-container">
    <form method="POST" action="like_dislike.php" class="mr-3 reaction-form">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <button type="submit" name="like" class="reaction-btn like-btn">
            <div class="thumb-wrapper">
                <svg class="thumb" viewBox="0 0 24 24" width="24" height="24">
                    <path class="thumb-path" d="M2,20V12C2,11.4 2.2,11 2.6,10.6C3,10.2 3.4,10 4,10H8V4C8,3.4 8.2,3 8.6,2.6C9,2.2 9.4,2 10,2H12C12.6,2 13,2.2 13.4,2.6C13.8,3 14,3.4 14,4V10L19,10C19.4,10 19.8,10.2 20.2,10.6C20.6,11 20.8,11.4 20.8,12L19,20C18.8,20.6 18.6,21 18.2,21.4C17.8,21.8 17.4,22 17,22H5C4.4,22 3.8,21.8 3.4,21.4C3,21 2.6,20.6 2,20Z" />
                </svg>
                <div class="particle-burst">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                </div>
            </div>
            <span class="reaction-count"><?= $post['likes'] ?? 0 ?></span>
        </button>
    </form>
    
    <form method="POST" action="like_dislike.php" class="reaction-form">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <button type="submit" name="dislike" class="reaction-btn dislike-btn">
            <div class="thumb-wrapper">
                <svg class="thumb" viewBox="0 0 24 24" width="24" height="24">
                    <path class="thumb-path" d="M22,4V12C22,12.6 21.8,13 21.4,13.4C21,13.8 20.6,14 20,14H16V20C16,20.6 15.8,21 15.4,21.4C15,21.8 14.6,22 14,22H12C11.4,22 11,21.8 10.6,21.4C10.2,21 10,20.6 10,20V14L5,14C4.6,14 4.2,13.8 3.8,13.4C3.4,13 3.2,12.6 3.2,12L5,4C5.2,3.4 5.4,3 5.8,2.6C6.2,2.2 6.6,2 7,2H19C19.6,2 20.2,2.2 20.6,2.6C21,3 21.4,3.4 22,4Z" />
                </svg>
                <div class="particle-burst">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                </div>
            </div>
            <span class="reaction-count"><?= $post['dislikes'] ?? 0 ?></span>
        </button>
    </form>
</div>

<style>
.reaction-container {
    display: flex;
    gap: 20px;
    padding: 12px;
}

.reaction-form {
    margin: 0;
}

.reaction-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.like-btn {
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
}

.dislike-btn {
    background: linear-gradient(135deg, #f44336, #e53935);
    color: white;
}

.thumb-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.thumb {
    width: 24px;
    height: 24px;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.thumb-path {
    fill: currentColor;
}

.reaction-count {
    font-weight: 700;
    font-size: 16px;
    min-width: 24px;
    text-align: center;
}

/* Hover Effects */
.reaction-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}

.reaction-btn:hover .thumb {
    transform: scale(1.2);
}

/* Active Animation */
.reaction-btn:active {
    transform: translateY(1px);
}

/* Particle Animation */
.particle-burst {
    position: absolute;
    display: none;
    width: 100%;
    height: 100%;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: currentColor;
    opacity: 0;
}

.reaction-btn:active .particle-burst {
    display: block;
}

.reaction-btn:active .particle {
    animation: particle-burst 0.6s ease-out forwards;
}

@keyframes particle-burst {
    0% {
        transform: translate(0, 0);
        opacity: 1;
    }
    100% {
        transform: translate(var(--x, 50px), var(--y, 50px));
        opacity: 0;
    }
}

/* Particle Positions */
.particle:nth-child(1) { --x: 20px; --y: -20px; }
.particle:nth-child(2) { --x: -20px; --y: -20px; }
.particle:nth-child(3) { --x: 20px; --y: 20px; }
.particle:nth-child(4) { --x: -20px; --y: 20px; }
.particle:nth-child(5) { --x: 0px; --y: -30px; }

/* Glassmorphism effect */
.reaction-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        45deg,
        rgba(255, 255, 255, 0.1),
        rgba(255, 255, 255, 0.2)
    );
    border-radius: inherit;
    opacity: 0;
    transition: opacity 0.3s;
}

.reaction-btn:hover::before {
    opacity: 1;
}

/* Pulse Animation on Count Change */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

.reaction-count.animate {
    animation: pulse 0.3s ease-out;
}
</style>

<script>
document.querySelectorAll('.reaction-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        // Create particles
        const particles = this.querySelectorAll('.particle');
        particles.forEach(particle => {
            particle.style.animation = 'none';
            particle.offsetHeight; // Trigger reflow
            particle.style.animation = null;
        });

        // Animate count
        const count = this.querySelector('.reaction-count');
        count.classList.add('animate');
        setTimeout(() => count.classList.remove('animate'), 300);
    });
});
</script>

                    <!-- Display Comments -->
                    <h6>Comments (<?= $post['comment_count'] ?>):</h6>
                    <div class="comments-section">
                        <?php if(isset($commentError)): ?>
                            <div class="alert alert-danger">
                                <?= htmlspecialchars($commentError) ?>
                            </div>
                        <?php endif; ?>
                        <?php 
                        $comments = $commentController->getCommentsByPostId($post['id']);
                        if (!empty($comments)) : 
                            foreach ($comments as $comment) : ?>
                                <div class="comment mb-2">
                                    <p><?= htmlspecialchars($comment->getComment()) ?></p>
                                    <form method="POST" action="delete_comment.php" class="d-inline">
                                        <input type="hidden" name="comment_id" value="<?= $comment->getId() ?>">
                                        <a href="deletecomment.php?id=<?= $comment->getId() ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</a>
                                    </form>
                                    <a href="edit_comment.php?id=<?= $comment->getId() ?>" class="btn btn-warning btn-sm">Edit</a>
                                </div>
                            <?php endforeach; 
                        else : ?>
                            <p>No comments yet. Be the first to comment!</p>
                        <?php endif; ?>
                    </div>

                    <!-- Add New Comment Form -->
                    <form method="POST" action="create.php" onsubmit="return validateComment(this)">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <div class="form-group">
                            <textarea name="comment" class="form-control" rows="2" placeholder="Write a comment..." required maxlength="1000" oninput="checkComment(this)"></textarea>
                            <small class="text-danger d-none" id="commentError"></small>
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















   

<script>
function validateComment(form) {
    const commentText = form.querySelector('textarea[name="comment"]').value.trim();
    const errorElement = form.querySelector('#commentError');
    
    if (commentText === '') {
        errorElement.textContent = 'Comment cannot be empty!';
        errorElement.classList.remove('d-none');
        return false;
    }
    
    // Check for minimum length
    if (commentText.length < 2) {
        errorElement.textContent = 'Comment is too short!';
        errorElement.classList.remove('d-none');
        return false;
    }
    
    const badWords = ['badword1', 'badword2', 'offensiveWord'];
    for (const word of badWords) {
        if (commentText.toLowerCase().includes(word.toLowerCase())) {
            errorElement.textContent = 'Please keep comments appropriate!';
            errorElement.classList.remove('d-none');
            return false;
        }
    }
    
    return true;
}

function checkComment(textarea) {
    const errorElement = textarea.parentElement.querySelector('#commentError');
    errorElement.classList.add('d-none');
}
</script>

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


