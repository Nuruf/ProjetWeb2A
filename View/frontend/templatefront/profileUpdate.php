<!-- /*
* Template Name: Learner
* Template Author: Untree.co
* Tempalte URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB1/Controller/controllerUser.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB1/Model/modelUser.php');

$utilisateur1 = null;

// Récupérer l'ID de l'utilisateur à modifier depuis l'URL
if (isset($_GET['id'])) {
    $utilisateur1Id = $_GET['id'];

    $utilisateursController = new CoursController();
    $utilisateur1 = $utilisateursController->getUserById($utilisateur1Id);
}

// Si l'utilisateur n'existe pas, afficher un message d'erreur
if ($utilisateur1 === null) {
    echo "L'utilisateur demandé n'existe pas.";
    exit();
}

// Si le formulaire est soumis (méthode POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['motdepasse'], $_POST['email'], $_POST['phone'], $_POST['role'])) {
  

    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $motdepasse = $_POST['motdepasse'];  
    $phone = $_POST['phone']; 
    $role = $_POST['role'];


    $utilisateur1 = new User($name, $email, $motdepasse, $phone, $role);

    // Mise à jour de l'utilisateur dans la base de données
    $utilisateursController->updateUser($utilisateur1, $utilisateur1Id);

    // Redirection vers le tableau de bord avec l'ID de l'utilisateur dans l'URL
      header('Location: ../../frontend\templatefront\profile.php?id=' . urlencode($utilisateur1Id) );
    exit();
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


        </div>
      </div>
    </div>
    <div class="sticky-nav js-sticky-header">
      <div class="container position-relative">
        <div class="site-navigation text-center">
          <a href="index.php" class="logo menu-absolute m-0">Learner<span class="text-primary">.</span></a>

          <ul class="js-clone-nav d-none d-lg-inline-block site-menu">
            <li><a href="index.php">Home</a></li>
            
            <li class="active"><a href="profile.php">Profile</a></li>
            <li><a href="forum.php">Forum</a></li>
            <li><a href="skillswap.php">SKILL SWAP</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="quiz.php">Quiz</a></li>
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
  






  <?php



$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$userController = new CoursController();


if ($id > 0) {
    $user = $userController->getUserByIdd($id);
} else {
    $user = null;
}
?>




  

  <div class="untree_co-hero overlay" style="background-image: url('images/img-school-3-min.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12">
          <div class="row justify-content-center ">
            <div class="col-lg-6 text-center ">
              <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Profile</h1>
              <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
           
              <h3>Bienvenue, <strong style="color: red;"><?= htmlspecialchars($user['Utilisateur']); ?></strong></h3>


          

              <p>
        Découvrez une communauté de passionnés prêts à échanger leurs savoirs. 
        Apprenez de nouvelles compétences ou enseignez les vôtres, tout en élargissant votre réseau.
    </p>
             
             
             
              </div>
              <p class="mb-0" data-aos="fade-up" data-aos-delay="300"><a href="#" class="btn btn-secondary">Explore nos skills</a></p>

            </div>


          </div>

        </div>

      </div> <!-- /.row -->
    </div> <!-- /.container -->

  </div> <!-- /.untree_co-hero -->

  <div class="untree_co-section bg-light">












    <div class="container">

    <h1>Modifier l'utilisateur</h1>

                <form method="POST">
                 

                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($utilisateur1['Utilisateur']); ?>" required>

                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur1['Email']); ?>" required>

                    <label for="motdepasse">Mot De Passe :</label>
                    <input type="password" id="motdepasse" name="motdepasse" value="<?= htmlspecialchars($utilisateur1['MotDePasse']); ?>" required>

                    <label for="phone">Téléphone :</label>
                    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($utilisateur1['Telephone']); ?>" required>

                    <label for="role">Rôle :</label>
                    <select name="role" id="role">
                        <option value="0" <?= $utilisateur1['Role'] == '0' ? 'selected' : ''; ?>>Admin</option>
                        <option value="1" <?= $utilisateur1['Role'] == '1' ? 'selected' : ''; ?>>Utilisateur</option>
                    </select>

                    <button type="submit" class="btn-update">Mettre à jour</button>
                </form>
            </div>
        </div>
    </main>


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

  </body>

  </php>
