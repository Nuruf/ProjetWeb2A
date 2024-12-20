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
          <a href="index.php" class="logo menu-absolute m-0">Learner<span class="text-primary">.</span></a>

          <ul class="js-clone-nav d-none d-lg-inline-block site-menu">
            <li><a href="index.php">Home</a></li>
            
            <li><a href="profile.php">Profile</a></li>
            <li><a href="create.php">Forum</a></li>
            <li><a href="skillswap.php">SKILL SWAP</a></li>
            <li><a href="blogg.php">Blog</a></li>
            <li class="active"><a href="gestion_quiz.php">Quiz</a></li>
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
  

  <div class="untree_co-hero overlay" style="background-image: url('images/img-school-2-min.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12">
          <div class="row justify-content-center ">
            <div class="col-lg-6 text-center ">
              <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Contact Us</h1>
              <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
                <p>Another free template by <a href="https://untree.co/" target="_blank" class="link-highlight">Untree.co</a>. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live.</p>
              </div>

              <p class="mb-0" data-aos="fade-up" data-aos-delay="300"><a href="#" class="btn btn-secondary">Explore courses</a></p>

            </div>


          </div>

        </div>

      </div> <!-- /.row -->
    </div> <!-- /.container -->

  </div> <!-- /.untree_co-hero -->

  <?php
        include '../../../controller/QuizController.php';
        $Quizz = new QuizController();
        $liste = $Quizz->listquiz();
        ?>

        <a href="listehistorique.php">Historique</a> <br><br>
        <h1 align='center'>Liste des Quizz</h1>


        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Rechercher un quiz..." onkeyup="filterTable()">
            <button onclick="filterTable()">Rechercher</button>
        </div>
        <br>
        <table id="quizTable" class="quiz-table" align='center' border="2">
            <thead>
                <tr>
                    <th class="quiz-title">Title</th>
                    <th class="quiz-description">Description</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($liste)): ?>
                    <?php foreach ($liste as $quiz): ?>
                        <tr>
                            <td><?php echo $quiz['nomQuiz']; ?></td>
                            <td><?php echo $quiz['description1']; ?></td>
                            <td>
                                <a href="quiz.php?id=<?php echo $quiz['idquiz']; ?>">Repondre à ce quiz</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Aucune quiz trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <style>
.quiz-table {
    width: 80%;
    border-collapse: collapse;
    margin: 20px auto;
    font-family: Arial, sans-serif;
    font-size: 16px;
    text-align: center;
    background-color: #f8faff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* En-tête du tableau */
.quiz-table thead tr {
    background-color: #007BFF;
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Style des cellules de l'en-tête */
.quiz-table th {
    padding: 12px 15px;
}

/* Style des cellules du corps */
.quiz-table td {
    padding: 10px 12px;
    color: #333333;
}

/* Lignes du tableau */
.quiz-table tbody tr:nth-child(even) {
    background-color: #eaf2ff;
}

.quiz-table tbody tr:nth-child(odd) {
    background-color: #ffffff;
}

/* Style au survol des lignes */
.quiz-table tbody tr:hover {
    background-color: #d0e8ff;
    cursor: pointer;
}

/* Lien dans le tableau */
.quiz-table a {
    text-decoration: none;
    color: #0056b3;
    font-weight: bold;
}

.quiz-table a:hover {
    text-decoration: underline;
}

/* Bordure du tableau */
.quiz-table, .quiz-table th, .quiz-table td {
    border: 1px solid #007BFF;
}

/* Message "Aucune quiz trouvée" */
.quiz-table tbody tr td[colspan="3"] {
    font-style: italic;
    color: #666666;
    text-align: center;
}
</style>

        <br><br>
        <br><br>
    </main>

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
                messagesDiv.innerphp += `<p class="user">${message}</p>`;
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
                    messagesDiv.innerphp += `<p class="bot">${reply}</p>`;
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
