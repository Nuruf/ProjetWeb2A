<!-- /*
* Template Name: Learner
* Template Author: Untree.co
* Tempalte URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
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
<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    // Rediriger vers la page de connexion si non connecté ou rôle incorrect
    header('Location: ../../frontend/templatefront/index.php');
    exit;
}


$pp= $_SESSION['user_id'];
?>
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

include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Model/modelUser.php';
include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Controller/controllerUser.php';
include $_SERVER['DOCUMENT_ROOT'] . '/PROJET WEB/Controller/metierController.php';


$userController = new CoursController();


if ($pp> 0) {
    $user = $userController->getUserByIdd($pp);
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


    </div>





    <!-- Contenu principal -->
    <main class="main-content">
       

        <div class="content">
            <div id="profile-content" class="section-content">
                <h1>Profile</h1>


                <?php
                  
                
                if ($user): ?>
                    <div class="profile-info">
    <p><strong>Nom :</strong> <?= htmlspecialchars($user['Utilisateur']); ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($user['Email']); ?></p>
    <p><strong>telephone :</strong> <?= htmlspecialchars($user['Telephone']); ?></p>
    <p><strong>mot de passe :</strong> <?= htmlspecialchars($user['MotDePasse']); ?></p>
          
<?php else: ?>
    <p>Utilisateur non trouvé ou ID invalide.</p>
<?php endif; ?>


                     <form method="GET" action="profileUpdate.php">
                        <input type="hidden" value="<?= $user['Id']; ?>" name="id">
                        <button class="btn-update" type="submit">Modifier</button>
                    </form>

</div>
       <!-- Fin des Statistiques -->
       </table>
<button onclick="toggleForm()" class="chatbot-toggle-btn">
    <span class="bot-icon">🤖</span> Parler avec Chatbot
</button>
<div id="chatbot-container" style="position: fixed; bottom: 10px; right: 10px; width: 300px; background: #f9f9f9; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div id="chatbot-messages" style="height: 300px; overflow-y: auto; padding: 10px;">
        <!-- Les messages apparaîtront ici -->
    </div>
    <form id="chatbot-form" style="display: flex; border-top: 1px solid #ccc;">
        <input type="text" id="chatbot-input" placeholder="Posez une question..." style="flex: 1; padding: 10px; border: none; border-radius: 0;">
        <button type="submit" style="background: #007BFF; color: white; border: none; padding: 10px 15px;">Envoyer</button>
    </form>
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
























    
    <script>
function toggleForm() {
        const formContainer = document.getElementById('chatbot-container');
        if (formContainer.style.display === 'none') {
            formContainer.style.display = 'block';
        } else {
            formContainer.style.display = 'none';
        }
    }


/********************************************************* */

document.addEventListener('DOMContentLoaded', () => {
        const chatForm = document.getElementById('chatbot-form');
        const chatInput = document.getElementById('chatbot-input');
        const chatMessages = document.getElementById('chatbot-messages');
        chatForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const userMessage = chatInput.value.trim();
    if (!userMessage) return;

    // Ajouter le message utilisateur à l'interface
    appendMessage('Vous', userMessage);

    // Envoyer une requête AJAX au serveur
    try {
        const response = await fetch('chatbotHandler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ message: userMessage })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();

    
        appendMessage('Chatbot', data.response);
    } catch (error) {
        console.error('Erreur:', error);
        appendMessage('Erreur', "Une erreur est survenue. Veuillez réessayer.");
    }

    chatInput.value = '';
});



        function appendMessage(sender, message) {
            const messageElement = document.createElement('div');
            messageElement.classList.add('message');
            messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
            chatMessages.appendChild(messageElement);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
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

  </php>
