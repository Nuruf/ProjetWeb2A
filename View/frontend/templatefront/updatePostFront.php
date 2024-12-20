<!-- /*
* Template Name: Learner
* Template Author: Untree.co
* Tempalte URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->

<?php
    require_once '../../../controller/PostssController.php';
    session_start();

    // Vérifiez si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        // Rediriger vers la page de connexion si non connecté ou rôle incorrect
       header('Location: ../../frontend/templatefront/index.php');
        exit;
    }
    $currentUserId = $_SESSION['user_id'];

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
            $postController->updatePost($id, $title, $content, $videoFile,$currentUserId);
            echo "<div class='alert alert-success'>Post updated successfully.</div>";
             header("Location: blogg.php");
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
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
            <li><a href="blogg.php">Blog</a></li>
            <li><a href="quiz.html">Quiz</a></li>
            <li><a href="reclamation.php">Reclamation</a></li>
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
                   <a href="../../../assets/videos/<?php echo htmlspecialchars($postData->getVideoName()); ?>" target="_blank">
                       <?php echo htmlspecialchars($postData->getVideoName()); ?>
                   </a>
               </p>
           <?php endif; ?>
           <input type="file" class="form-control" id="video" name="video">
           <div id="videoError" class="text-danger d-none">Please upload a valid video file.</div>
           <small class="form-text text-muted">Leave blank if you don't want to change the video.</small>
           <?php if (!empty($postData->getVideoName())): ?>
           <video width="320" height="240" controls>
               <source src="../../../assets/videos/<?php echo htmlspecialchars($postData->getVideoName()); ?>" type="video/mp4">
               Your browser does not support the video tag.
           </video>
       <?php endif; ?>
               </div>
               <button type="submit" class="btn btn-primary">Update Post</button>
           </form>
           

      
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
