<!DOCTYPE html>
<html lang="fr">

<link rel="styleSheet" href="../BackOffice/styleliste1.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard1.css">
    
</head>

    
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
include '../../controller/QuestionController.php';
$id=$_GET['id'];
$Question= new QuestionController();
$liste=$Question->listQuestion($id);
?>

    <br>

<h1 align='center'>Liste des Question pour ce quiz</h1>
<br>

<table class="styled-table" align='center' border="2">
    <thead>
        <tr>
        <th>Id du question</th>
            <th>Id du quiz</th>
            <th> question</th>
            <th>points du question</th> 
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($liste)): ?>
            <?php foreach ($liste as $Question): ?>
                <tr>
                    <td><?php echo $Question['id_question']; ?></td>
                    <td><?php echo $Question['idquiz']; ?></td>
                    <td><?php echo $Question['question_text']; ?></td>
                    <td><?php echo $Question['points']; ?></td>
                    <td>
                    <a href="listeReponces.php?id=<?php echo $Question['id_question'];?>" >Afficher la liste des reponses</a><br><br>
                        
            <a href="deletequestion.php?id=<?php echo $Question['id_question'];?>" onclick="return confirm('Voulez-vous vraiment supprimer cette question ?');">Supprimer cette question</a><br><br>
            <a href="updateQUESTION+REPONSES.php?id=<?php echo $Question['id_question']; ?>&quiz_id=<?php echo $Question['idquiz']; ?>">Modifier cette question</a>

            </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Aucune question trouvée.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


</html>