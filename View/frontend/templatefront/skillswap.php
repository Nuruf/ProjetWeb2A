<?php
include '../../../controller/CategoryController.php';

// Initialize the categories controller and fetch the categories.
$categoriesController = new categoriesController();
$list = $categoriesController->listCategories();
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

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">

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

  <style>
    .text-center {
      text-align: center;
      margin-top: 8px;
    }

    .category-name {
      font-size: 14px;
      font-weight: bold;
      color: #333;
      margin-bottom: 4px;
    }

    .category-description {
      font-size: 12px;
      color: #555;
      margin: 0;
    }

    .item-wrap {
      position: relative;
    }

    .item-wrap:hover .icon-search2 {
      transform: scale(1.2);
      transition: 0.3s;
    }
  </style>
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
            <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span>Have a question?</a>
            <a href="#" class="small mr-3"><span class="icon-phone mr-2"></span>10 20 123 456</a>
            <a href="#" class="small mr-3"><span class="icon-envelope mr-2"></span>info@mydomain.com</a>
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
            <li class="active"><a href="skillswap.php">Skill Swap</a></li>
            <li><a href="blogg.php">Blog</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="reclamation.php">Reclamation</a></li>
          </ul>
          <a href="#" class="btn-book btn btn-secondary btn-sm menu-absolute">Enroll Now</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="untree_co-hero overlay" style="background-image: url('images/img-school-4-min.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 text-center">
          <h1 class="mb-4 heading text-white">Skill Swap</h1>
          <p class="mb-5 text-white">Welcome to the Skill Swap platform where you can exchange skills with others. Learn something new today!</p>
          <p><a href="#" class="btn btn-secondary">Explore Courses</a></p>
        </div>
      </div>
    </div>
  </div>

  <div class="untree_co-section">
    <div class="container">
      <div class="row">
        <?php if (!empty($list) && is_array($list)): ?>
          <?php foreach ($list as $category): ?>
            <div class="col-md-6 col-lg-4 item">
              <a href="images/img-school-5-min.jpg" class="item-wrap fancybox mb-4">
                <span class="icon-search2"></span>
                <img class="img-fluid" src="images/img-school-5-min.jpg" alt="">
                <div class="text-center mt-2">
                  <h4 class="category-name"><?php echo htmlspecialchars($category['nomCat']); ?></h4>
                  <p class="category-description"><?php echo htmlspecialchars($category['descriptionCat']); ?></p>
                </div>
              </a>
              <a href="ContenuView.php?idCat=<?php echo htmlspecialchars($category['idCat']); ?>" class="btn">Cour</a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No categories available.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 mr-auto">
          <div class="widget">
            <h3>About Us</h3>
            <p>Contact us for any potential issues.</p>
          </div>
        </div>

        <div class="col-lg-2 ml-auto">
          <div class="widget">
            <h3>Projects</h3>
            <ul class="list-unstyled">
              <li><a href="#">Web Design</a></li>
              <li><a href="#">PHP</a></li>
              <li><a href="#">CSS3</a></li>
              <li><a href="#">jQuery</a></li>
              <li><a href="#">Bootstrap</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="widget">
            <h3>Gallery</h3>
            <ul class="list-unstyled">
              <li><img src="images/gal_1.jpg" alt="" width="72" height="72"></li>
              <li><img src="images/gal_2.jpg" alt="" width="72" height="72"></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="widget">
            <h3>Contact</h3>
            <address>43 Raymouth Rd. London</address>
            <p><a href="mailto:info@mydomain.com">info@mydomain.com</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>