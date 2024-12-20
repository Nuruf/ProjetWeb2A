<!-- /*
* Template Name: Learner
* Template Author: Untree.co
* Tempalte URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!DOCTYPE html>
<html lang="en">.
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
            <a href="http://localhost/PROJET%20WEB1/View/frontend/templatefront/index.php"class="small mr-3"><span class="d-none d-lg-inline-block">page principale</span></a> 
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
              <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Register</h1>

            </div>
          </div>
        </div>
      </div> <!-- /.row -->
    </div> <!-- /.container -->

  </div> <!-- /.untree_co-hero -->




  <div class="untree_co-section">
    <div class="container">

      <div class="row mb-5 justify-content-center">
        <div class="col-lg-5 mx-auto order-1" data-aos="fade-up" data-aos-delay="200">
          <form class="form-box" onsubmit="return validateForm()" method="POST">
            <div class="row">
              <div class="col-12 mb-3">

              <label for="username">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="utilisateur" placeholder="Entrez votre nom">
                <p id="errorMessageUsername" style="color: red;"></p> <!-- Unique ID -->
              </div>


              <div class="col-12 mb-3">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder=" entrez votre Email">
                <p id="errorMessageEmail" style="color: red;"></p> <!-- Unique ID -->
              </div>

              <div class="col-12 mb-3">
                 <label for="password">Mot de passe</label>
                 <input type="password" class="form-control" id="password" name ="motdepasse" placeholder="Donner votre mot de passe">
                 <p id="errorMessagePassword" style="color: red;"></p> <!-- Unique ID -->
              </div>

              <div class="col-12 mb-3">
                <label for="confirm-password">Confirmez le mot de passe</label>
                <input type="password"  id="confirm-password"  class="form-control" placeholder="Retapez le mot de passe">
                <p id="errorMessageConfirmPassword" style="color: red;"></p> <!-- Unique ID -->
              </div>


              <div class="col-12 mb-3">
                 <label for="password">Telephone</label>
                 <input type="tel" class="form-control"  id="telephone" name="telephone"  placeholder="Donner votre mot de passe">
                 <p id="errorMessageTelephone" style="color: red;"></p> <!-- Unique ID -->
              </div>


              <div class="col-12 mb-3">
                     <input type="radio" name="role" value="0"> Admin
                    <input type="radio" name="role" value="1"> Client
              
                <p id="errorMessageRole" style="color: red;"></p> <!-- Unique ID -->
              </div>


              <div class="col-12">
                <input type="submit"  class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>

      
    </div>
      <!--******************************************************************************--->
      <?php
include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Model/modelUser.php';
include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Controller/controllerUser.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];
    $telephone = $_POST['telephone'];
    $utilisateur = $_POST['utilisateur'];
    $role = $_POST['role'];

    // Créer un objet Utilisateur avec les données récupérées
    $user1 = new User( $utilisateur,$email, $motdepasse, $telephone, $role);

    // Créer une instance du contrôleur Utilisateur
    $v1 = new CoursController ();

    // Appeler la méthode pour ajouter l'utilisateur
    try {
        $v1->addUser($user1);
      
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}

?>




        <!--*********************************-->
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
  
    <script>
    function validateForm() {
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const confirmPassword = document.getElementById('confirm-password').value.trim();
        const telephone = document.getElementById('telephone').value.trim();
        const errorMessageUsername = document.getElementById('errorMessageUsername');
        const errorMessageEmail = document.getElementById('errorMessageEmail');
        const errorMessagePassword = document.getElementById('errorMessagePassword');
        const errorMessageConfirmPassword = document.getElementById('errorMessageConfirmPassword');
        const errorMessageTelephone = document.getElementById('errorMessageTelephone');
        const errorMessageRole = document.getElementById('errorMessageRole');

        // Effacer les messages d'erreur précédents
        errorMessageUsername.textContent = '';
        errorMessageEmail.textContent = '';
        errorMessagePassword.textContent = '';
        errorMessageConfirmPassword.textContent = '';
        errorMessageTelephone.textContent = '';
        errorMessageRole.textContent = '';

        // Validation des champs requis
        if (username === '' || email === '' || password === '' || confirmPassword === '' || telephone === '') {
            if (username === '') {
                errorMessageUsername.textContent = 'Veuillez entrer votre nom';
            }
            if (email === '') {
                errorMessageEmail.textContent = 'Veuillez entrer votre email';
            }
            if (password === '') {
                errorMessagePassword.textContent = 'Veuillez entrer votre mot de passe';
            }
            if (confirmPassword === '') {
                errorMessageConfirmPassword.textContent = 'Veuillez confirmer votre mot de passe';
            }
            if (telephone === '') {
                errorMessageTelephone.textContent = 'Veuillez entrer votre numéro de téléphone';
            }
            
            const roleSelected = document.querySelector('input[name="role"]:checked');
            if (!roleSelected) {
            errorMessageRole.textContent = 'Veuillez choisir un rôle (Admin ou Client)';
        
        }
        return false;
        }

        // Validation si les mots de passe correspondent
        if (password !== confirmPassword) {
            errorMessageConfirmPassword.textContent = 'Les mots de passe ne correspondent pas';
            return false;
        }

     

        // Validation du téléphone (vérification d'un format simple de numéro de téléphone)
        const phonePattern = /^[0-9]{8}$/;  // Exemple de format de numéro de téléphone (10 chiffres)
        if (!phonePattern.test(telephone)) {
            errorMessageTelephone.textContent = 'Veuillez entrer un numéro de téléphone valide (8 chiffres)';
            return false;
        }

        return true; // Si tout est valide, le formulaire peut être soumis
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
