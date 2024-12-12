<?php
include '../../Model/quiz.php';
include '../../Controller/QuizController.php';

$quiz = null;
// create an instance of the controller
$quizC = new QuizController();

if (isset($_POST["nomQuiz"]) && isset($_POST["description1"])) {
    if (!empty($_POST["nomQuiz"]) && !empty($_POST["description1"])) {
        $quiz = new quiz(
            $_POST['nomQuiz'],
            $_POST['description1']
        );
        // Update quiz
        $quizC->updatequiz($quiz, $_GET['id']);

        header('Location:ListeQuiz.php');
        exit();  // Ensure no further script execution
    } else {
        $error = "Missing information";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleForm.css">
    <link rel="stylesheet" href="dashboard.css">
    <title>SKILL SWAP</title>
</head>
<body>

<div class="user-info">
    <img src="logoo.png" alt="User Profile">
    <span>Bienvenue sur notre site : username</span>
</div>

<nav>
    <ul>
        <li><a href="#profile" onclick="showSection('profile')">Profile</a></li>
        <li><a href="#forum" onclick="showSection('forum')">Forum</a></li>
        <li><a href="#skillSwap" onclick="showSection('skillSwapp')">Skill Swap</a></li>
        <li><a href="#blog" onclick="showSection('blog')">Blog</a></li>
        <li><a href="listeQuiz.php" onclick="showSection('quiz')">Quiz</a></li>
        <li><a href="#Reclamation" onclick="showSection('reclamation')">Réclamation</a></li>
    </ul>
</nav>

<?php
if (isset($_GET['id'])) {
    $quiz = $quizC->showQuiz($_GET['id']); // Assuming 'GET' is used for passing quiz ID
?>
<h2 align="center">Modifier ce quiz</h2>

<form  align="center" action="" method="POST" onsubmit="return validerFormulaire()">
    <label for="id">ID Quiz:</label><br>
    <input type="text" id="id" name="idquiz" readonly value="<?php echo $quiz['idquiz']; ?>"><br>

    <label for="title">Nom du quiz :</label><br>
    <input type="text" id="title" name="nomQuiz" value="<?php echo $quiz['nomQuiz']; ?>">
    <div id="m1"></div><br>

    <label for="description">Description:</label><br>
    <input type="text" id="description" name="description1" value="<?php echo $quiz['description1']; ?>">
    <div id="m2"></div><br>

    <button type="submit">Modifier le quiz</button>
</form>

<?php
}



?>
<script>
    function validerFormulaire() {
        var N = document.getElementById("title").value;
        var description = document.getElementById("description").value;

        var message = "";
        if (N.length < 3) {
            message += "* Le titre du quiz doit contenir au moins 3 caractères.\n";
        }
        if (description.length < 3) {
            message += "* La description doit contenir au moins 3 caractères.\n";
        }

        if (message !== "") {
            alert(message);
            return false;
        } else {
            return true;
        }
    }

    function validertestName(event) {
        event.preventDefault();
        var t = document.getElementById("title").value;
        var messageTitre = document.getElementById("m1");
        var valide = true;

        if (t.length < 3) {
            messageTitre.innerText = "* Le nom doit contenir au moins 3 caractères";
            messageTitre.style.color = "red";
            valide = false;
        } else {
            messageTitre.innerText = "* correct";
            messageTitre.style.color = "green";
        }
    }

    function validerDescription(event) {
        event.preventDefault();
        var description = document.getElementById("description").value;
        var messageDescription = document.getElementById("m2");

        if (description.length < 3) {
            messageDescription.innerText = "* La description doit contenir au moins 3 caractères";
            messageDescription.style.color = "red";
            valide = false;
        } else {
            messageDescription.innerText = "* correct";
            messageDescription.style.color = "green";
        }
    }

    document.querySelector("#title").addEventListener("keyup", validertestName);
    document.querySelector("#description").addEventListener("keyup", validerDescription);
</script>



</body>
<footer>
        <br>
        <br>
        <p>You can contact us at: <a href="mailto:yosrmoussa63@gmail.com">contact@esprit.tn</a></p>
        <p>1,2 rue André Ampère -2083</p>
        <p>Technological Pole - El Ghazala</p>
     <p align="center"> <small> Copyright © Your Website 2024</small></p>

    </footer>
</html>

