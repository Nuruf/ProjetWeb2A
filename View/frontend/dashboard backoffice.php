<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>iframe {
        width: 100%; /* Set width of iframe */
        height: 100vh; /* Set height relative to viewport */
        margin: auto;
        border: 2px solid #007bff; /* Add border for clarity */
        border-radius: 8px; /* Rounded corners for iframe */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for a clean look */
        display: block; /* Center the iframe horizontally */
        background-color: white; /* White background for clarity */}   
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
                <li><a href="#quiz" onclick="showSection('quiz')"><i class="fas fa-question-circle"></i> Quiz</a></li>
                <li><a href="#reclamation" onclick="showSection('reclamation')"><i class="fas fa-file-alt"></i> Réclamation</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Contenu principal -->
    <main class="main-content">
        <header class="user-info">
            <span>Bienvenue, <b>username</b></span>
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
        </header>

        <div class="content">
            <div id="profile-content" class="section-content">
                <h2>Profile</h2>
                <p>Gérez vos informations personnelles et vos préférences.</p>
            </div>
            <div id="forum-content" class="section-content">
                <h2>Forum</h2>
                <p>Participez aux discussions et interagissez avec la communauté.</p>
            </div>
            <div id="skillSwapp-content" class="section-content">
                <h2>Skill Swap</h2>
                <p>Échangez vos compétences avec d'autres membres.</p>
            </div>
            <div id="blog-content" class="section-content">
                <h2>Blog</h2>
                <p>Découvrez ou publiez des articles intéressants.</p>
            </div>
            <div id="quiz-content" class="section-content">
                <h2>Quiz</h2>
                <p>Testez vos connaissances sur divers sujets.</p>
            </div>
            <div id="reclamation-content" class="section-content">
                <h2>Réclamation</h2>
                <iframe src="../backoffice/reclamationlistadmin.php" frameborder="0"></iframe>
            </div>
        </div>
    </main>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => section.style.display = 'none');
            const selectedSection = document.getElementById(sectionId + '-content');
            if (selectedSection) selectedSection.style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSection('profile');
        });
    </script>
</body>
</html>
