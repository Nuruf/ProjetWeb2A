<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    height: 400px;
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
</head>
<body>
    <!-- Barre latérale -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="logoo.png" alt="Logo" class="logo">
            <h3>Dashboard</h3>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="#profile" onclick="showSection('profile')"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="#forum" onclick="showSection('forum')"><i class="fas fa-comments"></i> Forum</a></li>
                <li><a href="#skillSwap" onclick="showSection('skillSwapp')"><i class="fas fa-exchange-alt"></i> Skill Swap</a></li>
                <li><a href="#blog" onclick="showSection('blog')"><i class="fas fa-blog"></i> Blog</a></li>
                <li><a href="listeQuizFront.php" onclick="showSection('quiz')"><i class="fas fa-question-circle"></i> Quiz</a></li>
                <li><a href="#reclamation" onclick="showSection('reclamation')"><i class="fas fa-file-alt"></i> Réclamation</a></li>
            </ul>
        </nav>
    </aside>
    <main class="main-content">
        <header class="user-info">
            <span>Bienvenue, <b>username</b></span>
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
        </header>

        <?php
        include '../../Controller/QuizController.php';
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
</body>
</html>
