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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styleForm11.css">
    <link rel="stylesheet" href="dashboard1.css">
    <title>SKILL SWAP</title>
</head>
<body>

    
    <script>
        // Function to show the selected section and hide others
        function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => {
                section.style.display = 'none';
            });

            // Show the selected section
            const selectedSection = document.getElementById(sectionId + '-content');
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        }

        // Show the first section by default
        document.addEventListener('DOMContentLoaded', () => {
            showSection('profile');
        });
    </script>
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

</html>

