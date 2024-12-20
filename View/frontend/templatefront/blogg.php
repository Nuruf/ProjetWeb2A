<!-- /*
* Template Name: Learner
* Template Author: Untree.co
* Tempalte URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->



<?php
require '../../../controller/PostssController.php';
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si non connecté ou rôle incorrect
   header('Location: ../../frontend/templatefront/index.php');
    exit;
}
$currentUserId = $_SESSION['user_id'];
$postController = new PosttController();

$posts = $postController->getAllpostt();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_FILES['video'])) {
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $videoFile = $_FILES['video'];

        // Validate video upload
        $allowedFormats = ['video/mp4', 'video/webm', 'video/ogg'];
        $maxFileSize = 50 * 1024 * 1024; // 50MB

        if (!in_array($videoFile['type'], $allowedFormats)) {
            echo "Invalid video format. Only MP4, WebM, and OGG are allowed.";
            exit;
        }

        if ($videoFile['size'] > $maxFileSize) {
            echo "File size exceeds 50MB.";
            exit;
        }

        try {
            // Call your postController
            $postId = $postController->createPFront($title, $content, $videoFile,$currentUserId);
            header("Location: postDetailsFront.php?id=" . $postId);
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all required fields.";
    }
      if (isset($_POST['delete'])) {
          $postController->deletePost($postId);
          header("Location: blogg.php");
          exit;
      }
}

?>

<!doctype php>
<php lang="en">
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
            <a href="#" class="small mr-3"><span class="icon-phone mr-2"></span> <span class="d-none d-lg-inline-block">10 20 123 456</span></a> 
            <a href="#" class="small mr-3"><span class="icon-envelope mr-2"></span> <span class="d-none d-lg-inline-block">info@mydomain.com</span></a> 
          </div>

          <div class="col-6 col-lg-3 text-right">
            <a href="login.php" class="small mr-3">
              <span class="icon-lock"></span>
              Log In
            </a>
            <a href="register.php" class="small">
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
          <a href="index.php" class="logo menu-absolute m-0">Learner<span class="text-primary">.</span></a>

          <ul class="js-clone-nav d-none d-lg-inline-block site-menu">
            <li><a href="index.php">Home</a></li>
            
            <li><a href="profile.php">Profile</a></li>
            <li><a href="create.php">Forum</a></li>
            <li><a href="skillswap.php">SKILL SWAP</a></li>
            <li class="active"><a href="blogg.php">Blog</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="reclamation.php">Reclamation</a></li>
            <li><a href="logout.php">Log out</a></li>

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

              <p class="mb-0" data-aos="fade-up" data-aos-delay="300"><a href="#" class="btn btn-secondary">Explore courses</a></p>

            </div>


          </div>

        </div>

      </div> <!-- /.row -->
    </div> <!-- /.container -->

  </div> <!-- /.untree_co-hero -->



  <div class="untree_co-section bg-light">
  <div class="search-filter-section mb-4">
    <div class="row g-3 align-items-center justify-content-center">
        <div class="col-md-6 col-lg-4">
            <input type="text" class="form-control shadow-sm" placeholder="Search posts by title..." id="searchInput" onkeyup="filterPosts()">
        </div>
        <div class="col-md-6 col-lg-4">
            <button type="button" class="btn btn-info shadow-sm" id="voiceSearchButton">
                <i class="fas fa-microphone"></i> Speak
            </button>
        </div>
    </div>
</div>

  <!-- <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"></h1>
        <a  onclick="createPost()" class="btn btn-success">Create New Post</a>
    </div> -->
  <div class="container">
    <div class="row align-items-stretch">
      <!-- Create Post Button -->
      <div class="col-12 mb-4">
    <button type="button" class="btn btn-success" onclick="createPost()">Create Post</button>
</div>
    
      <?php foreach ($posts as $post): ?>
        <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="media-h d-flex h-100">
            <figure>
              <a href="postDetailsFront.php?id=<?php echo htmlspecialchars($post['id']); ?>">
                <img class="img-fluid" src="https://images.rawpixel.com/image_800/czNmcy1wcml2YXRlL3Jhd3BpeGVsX2ltYWdlcy93ZWJzaXRlX2NvbnRlbnQvbHIvcm0zMTQtYWRqLTEwLmpwZw.jpg" alt="<?php echo htmlspecialchars($post['title']); ?>" loading="lazy">
              </a>
            </figure>
            <div class="media-h-body">
              <h2 class="mb-3">
                <a href="postDetailsFront.php?id=<?php echo htmlspecialchars($post['id']); ?>">
                  <?php echo htmlspecialchars($post['title']); ?>
                </a>
              </h2>
              <div class="meta">
                <span class="icon-calendar mr-2"></span>
                <span><?php echo htmlspecialchars($post['created_at']); ?></span>
              </div>
              <p><?php echo htmlspecialchars($post['content']); ?></p>
              <?php if ($_SESSION['user_id'] == $post['user_id']): ?>
                <div class="post-actions">
                  <a href="updatePostFront.php?id=<?php echo $post['id']; ?>" class="btn btn-warning updatePostBtn">Update</a>
                  <form action="deletePostFront.php" method="GET" style="display:inline;">
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>" />
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
  
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>

    <div class="row mt-5">
      <div class="col-12 text-center">
        <ul class="list-unstyled custom-pagination">
          <li><a href="#">1</a></li>
          <li class="active"><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
        </ul>
      </div>
    </div>
  </div>
</div> <!-- /.untree_co-section -->


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
              <li><a href="#">php5</a></li>
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

    <div id="createPostModal" class="modal fade" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createPostModalLabel">Create New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="postForm" enctype="multipart/form-data" action="" method="post" onsubmit="return validateForm();">
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter post title">
                    <div id="titleError" class="text-danger d-none">Title must be at least 5 characters.</div>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">Content</label>
                    <textarea id="content" name="content" class="form-control" rows="8" placeholder="Write your content here..."></textarea>
                    <div id="contentError" class="text-danger d-none">Content must be at least 20 characters.</div>
                </div>
                <div class="mb-3">
                    <label for="video" class="form-label fw-bold">Upload Video</label>
                    <input type="file" id="video" name="video" class="form-control" accept="video/*">
                    <div id="videoError" class="text-danger d-none">Please upload a valid video file.</div>
                </div>

                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-primary btn-lg">Create Post</button>
                        <a href="#" onclick="$('#createPostModal').modal('hide');" class="btn btn-secondary btn-lg">Back to Post List</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



    </main>
    <script>
    function createPost() {
        $('#createPostModal').modal('show'); 
    }

    function filterPosts() {
    const searchQuery = document.getElementById('searchInput').value.toLowerCase();
    const posts = document.querySelectorAll('.col-lg-6'); // Select all posts
    let visiblePosts = 0;

    posts.forEach(post => {
        // Check if the title and content elements exist
        const titleElement = post.querySelector('.media-h-body h2 a');
        const contentElement = post.querySelector('.media-h-body p');
        
        if (titleElement && contentElement) {
            const title = titleElement.textContent.toLowerCase(); // Title text
            const content = contentElement.textContent.toLowerCase(); // Content text

            // If title or content matches search query, show post, otherwise hide it
            if (title.includes(searchQuery) || content.includes(searchQuery)) {
                post.style.display = 'block';
                visiblePosts++;
            } else {
                post.style.display = 'none';
            }
        } else {
            // Hide the post if elements are missing (or handle as needed)
            post.style.display = 'none';
        }
    });
    console.log(titleElement, contentElement);

}



function validateForm() {
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
    if (!video) {
        videoError.textContent = "Please upload a video.";
        videoError.classList.remove('d-none');
        isValid = false;
    } else if (!['video/mp4', 'video/webm', 'video/ogg'].includes(video.type)) {
        videoError.textContent = "Only MP4, WebM, and OGG formats are allowed.";
        videoError.classList.remove('d-none');
        isValid = false;
    }

    // Prevent modal from closing if invalid
    return isValid;
}

let recognition;

if ('webkitSpeechRecognition' in window) {
    recognition = new webkitSpeechRecognition(); // Webkit-specific for Chrome/Edge
    recognition.continuous = false;  
    recognition.interimResults = false;  
    recognition.lang = 'en-US';  

    // When speech is recognized, set the search input to the recognized text
    recognition.onresult = function(event) {
        const transcript = event.results[0][0].transcript;
        const cleanedTranscript = transcript.replace(/\.$/, '');
        document.getElementById('searchInput').value = cleanedTranscript;
        filterPosts();  // Trigger the filter function with the spoken input
    };

    recognition.onerror = function(event) {
        console.error("Speech recognition error:", event.error);
    };

    // Start recognition when the button is clicked
    document.getElementById('voiceSearchButton').addEventListener('click', function() {
        recognition.start();
    });
} else {
    console.log("Speech recognition not supported in this browser.");
}

</script>

  </body>

  </php>
