<?php
require_once '../../controller/ContenuController.php';

$error="";

$contenu= null;
$contenuController = new contenuController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate that none of the fields are empty
    if (
        isset($_POST["nomContenu"]) && $_POST["descriptionContenu"]) {
        if (!empty($_POST["nomContenu"]) && !empty($_POST["descriptionContenu"])) {
            

            // Create the Event object with or without the new image
            $contenu = new contenu(
                null,
                $_POST['nomContenu'],
                $_POST['descriptionContenu'],
            );

            // Update the event in the database
            $contenuController->updateContenu($contenu, $_POST['idContenu']);

            // Redirect to the event list page
            header('Location:listContenu.php');
            exit; // Ensure no further processing occurs after the redirect
        } else {
            $error = "Missing information";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin UNIBOARD</title>

    <?php
        if (isset($_GET['idContenu'])) {
            $contenu = $contenuController->showContenu($_GET['idContenu']);
        ?>
            <form  action="" method="POST" > <!-- Added enctype for file upload -->
                <div class="mb-3">
                    <label for="id" class="form-label">ID Contenu:</label>
                    <input class="form-control" type="text" id="idContenu" name="idContenu" readonly value="<?php echo $_GET['idContenu'] ?>">
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom Contenu:</label>
                    <input class="form-control" type="text" id="nomContenu" name="nomContenu" value="<?php echo $contenu['nomContenu'] ?>">
                    <span id="name_error"></span>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="descriptionContenu" name="descriptionContenu"><?php echo $contenu['descriptionContenu'] ?></textarea>
                    <span id="description_error"></span>
                </div>
            
                <button type="submit" class="btn btn-primary">Update Contenu</button>
            </form>
        <?php
        }
        ?>
</body>
</html>