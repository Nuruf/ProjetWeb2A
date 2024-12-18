<!-- /*
* Template Name: Learner
* Template Author: Untree.co
* Tempalte URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
  <style>
        /* Style pour le bouton du chatbot */
        .chatbot-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    z-index: 1000;
    transition: background-color 0.3s ease, transform 0.3s ease;
}
.chatbot-btn:hover {
    background-color: #45a049;
    transform: scale(1.1); 
}

.chatbot-btn i {
    font-size: 24px;
}

/* Interface du chatbot cachée par défaut */
#chatbot-interface {
    display: none;
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 400px;
    height: 440px;
    background-color: white;
    border: 1px solid #ccc;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    z-index: 1001;
    padding: 10px;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
}

/* Style du chatbot */
#chatbox {
    width: 400px;
    background: white;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Ombre plus douce */
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
}

/* Section des messages */
#messages {
    height: 270px;
    overflow-y: auto;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    background-color: #fafafa; /* Ajout d'un fond légèrement gris */
    display: flex;
    flex-direction: column; /* Les messages seront affichés de haut en bas */
}

/* Messages dans les paragraphes */
#messages p {
    margin: 5px 0;
    padding: 10px;
    border-radius: 5px;
    max-width: 80%;
    word-wrap: break-word;
}

/* Messages de l'utilisateur */
#messages p.user {
    background: #007bff;
    color: white;
    text-align: right;
    margin-left: auto;
}

/* Messages du bot */
#messages p.bot {
    background: #f1f1f1;
    color: #333;
    text-align: left;
    margin-right: auto;
}

/* Zone d'entrée de texte - maintenant en bas */
#inputArea {
    display: flex;
    padding: 10px;
    box-sizing: border-box;
    background-color: #fff;
    border-top: 1px solid #ddd;
}

/* Champ de saisie */
#inputArea input {
    flex: 1;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-right: 10px;
    outline: none;
}

/* Bouton d'envoi */
#inputArea button {
    padding: 10px 20px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#inputArea button:hover {
    background: #0056b3;
}

/* Effet de survol pour l'input */
#inputArea input:focus {
    border-color: #007bff;
}

/* Bouton de fermeture */
.close-btn {
    background: none;
    border: none;
    color: gray; /* Couleur du bouton */
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    position: absolute; /* Position absolue pour le placer */
   
    top: 10px; /* Position en haut */
    right: 10px; /* Position à droite */
}

.close-btn:hover {
    color: white;
    background-color:red;
}

.search-bar {
        text-align: center;
        margin: 20px 0;
    }

    .search-bar input {
        padding: 12px 20px;
        font-size: 16px;
        width: 60%;
        border: 1px solid #3498db;
        border-radius: 8px;
        outline: none;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .search-bar input:focus {
        border-color: #0056b3;
        box-shadow: 0px 4px 8px rgba(0, 91, 187, 0.3);
    }

    .search-bar button {
        padding: 12px 20px;
        font-size: 16px;
        margin-left: 10px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-bar button:hover {
        background-color: #0056b3;
    }

    .pagination {
    display: flex;
    justify-content: center;
    margin: 20px 0;
    gap: 10px;
}

.pagination a {
    display: inline-block;
    padding: 10px 15px;
    text-decoration: none;
    font-size: 16px;
    color: #007bff; /* Couleur du texte */
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: all 0.3s ease;
    background-color: #f9f9f9; /* Couleur de fond */
}

.pagination a:hover {
    background-color: #007bff; /* Fond bleu au survol */
    color: white; /* Texte blanc au survol */
    border-color: #007bff;
}

.pagination a.active {
    background-color: #007bff; /* Couleur de fond pour la page active */
    color: white; /* Texte blanc pour la page active */
    border-color: #007bff;
    pointer-events: none; /* Désactive le clic sur la page active */
}

    </style>
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
            <li><a href="forum.html">Forum</a></li>
            <li><a href="skillswap.html">SKILL SWAP</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li class="active"><a href="gestion_quiz.php">Quiz</a></li>
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
  

  <div class="untree_co-hero overlay" style="background-image: url('images/img-school-2-min.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12">
          <div class="row justify-content-center ">
            <div class="col-lg-6 text-center ">
              <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">HISTORIC</h1>
              <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
              
              
              </div>

              <p class="mb-0" data-aos="fade-up" data-aos-delay="300"><a href="#historiques" class="btn btn-secondary">Explore Historic</a></p>

            </div>


          </div>

        </div>

      </div> <!-- /.row -->
    </div> <!-- /.container -->

  </div> <!-- /.untree_co-hero -->
<p id="historiques"></p>
  <?php
include '../../Controller/historiqueController.php';
$historiqueC= new HistoriqueController();
$liste=$historiqueC->listHistorique();

$liste = $historiqueC->listHistorique();  // Liste complète des historiques
$totalHistorique = count($liste);         // Total des éléments

// Nombre d'éléments par page
$elementsParPage = 10;

// Calcul du nombre total de pages
$totalPages = ceil($totalHistorique / $elementsParPage);  // Si $totalHistorique = 25, ceil(25/10) renverra 3

// Page actuelle (par défaut : 1)
$pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$pageActuelle = max($pageActuelle, 1); // Évite les pages négatives ou 0

// Calcul de l'index de départ pour la pagination
$indexDepart = ($pageActuelle - 1) * $elementsParPage;

// Extraire les éléments pour la page actuelle
$historiquePaginated = array_slice($liste, $indexDepart, $elementsParPage);
?>
<br><br>
<br><br>

<h1 align='center'>Historiques</h1>


<table class="quiz-table" align='center' border="2">
    <thead>
        <tr>
        
            <th>Titre</th>
            <th>Description</th>
            <th>Note</th> 
            <th>Date De Remise</th> 
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($historiquePaginated)): ?>
            <?php foreach ($historiquePaginated as $historique): 
              $note_parts = explode('/', $historique['note']);
                $numerateur = (int)$note_parts[0];
                $denominateur = (int)$note_parts[1];

                // Calcul de la moyenne
                $moyenne = $denominateur / 2;
                $background_color = $numerateur < $moyenne ? 'red' : 'green';?>
                <tr>
                    
                    <td><?php echo $historique['titre']; ?></td>
                    <td><?php echo $historique['description1']; ?></td>
                    <td style="background-color: <?php echo $background_color; ?>; color: white; text-align: center;"><?php echo $historique['note']; ?></td>
                    <td><?php echo $historique['date_validation']; ?></td>
                 
                 
                    
           
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Aucune quiz trouvée.</td>
            </tr>
        <?php endif; 
?>
    </tbody>
</table>

        
<?php
echo "<div class='pagination'>";
if ($pageActuelle > 1) {
    echo "<a href='?page=" . ($pageActuelle - 1) . "'>Précédent</a>";
}

for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href='?page=$i'" . ($i == $pageActuelle ? " class='active'" : "") . ">$i</a>";
}

if ($pageActuelle < $totalPages) {
    echo "<a href='?page=" . ($pageActuelle + 1) . "'>Suivant</a>";
}
echo "</div>"?>
    <!-- Interface du chatbot (initialement cachée) -->
    <div id="chatbot-interface">
        <h3>Chatbot</h3>
        <button class="close-btn" onclick="closeChatbot()">&times;</button>
        <div class="chatbot-body">
        <p>Bienvenue dans le chatbot !</p>
    </div>
    <!-- Zone de saisie et bouton "Envoyer" -->
    <div class="chatbot-footer">
    <div id="messages"></div>  
    <div id="inputArea">
        <input type="text" class="chatbot-input" id="userInput" placeholder="Tapez votre message...">
        <button class="send-btn" onclick="sendMessage()">Envoyer</button>
    </div>
    </div>
    </div>

    <!-- Bouton de chatbot -->
    <button class="chatbot-btn" onclick="openChatbot()">
        <i class="fas fa-comments"></i>
    </button>

    <script>
        // Fonction pour ouvrir le chatbot
        function openChatbot() {
            const chatbot = document.getElementById('chatbot-interface');
            chatbot.style.display = 'block';
        }

        // Fonction pour fermer le chatbot
        function closeChatbot() {
            const chatbot = document.getElementById('chatbot-interface');
            chatbot.style.display = 'none';
        }

        // Fonction pour afficher les sections
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => {
                section.style.display = 'none';
            });

            const selectedSection = document.getElementById(sectionId + '-content');
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            const chatbot = document.getElementById('chatbot-interface');
            chatbot.style.display = 'none'; });

            function sendMessage() {
            const userInput = document.getElementById('userInput');
            const message = userInput.value.trim();
            if (message) {
                // Afficher le message de l'utilisateur
                const messagesDiv = document.getElementById('messages');
                messagesDiv.innerHTML += `<p class="user">${message}</p>`;
                userInput.value = '';

                // Envoyer la requête au serveur PHP
                fetch('chatbot.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'message=' + encodeURIComponent(message)
                })
                .then(response => response.text())
                .then(reply => {
                    // Afficher la réponse du bot
                    messagesDiv.innerHTML += `<p class="bot">${reply}</p>`;
                    messagesDiv.scrollTop = messagesDiv.scrollHeight; // Scroller vers le bas
                })
                .catch(error => {
                    console.error('Erreur:', error);
                });
            }
        }




        function filterTable() {
            const filter = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#quizTable tbody tr');

            rows.forEach(row => {
                const title = row.children[0].textContent.toLowerCase();
                const description = row.children[1].textContent.toLowerCase();
                row.style.display = title.includes(filter) || description.includes(filter) ? '' : 'none';
            });
        }
    </script>

<br><br>
        <br><br>

  
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
