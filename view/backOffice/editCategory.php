<?php
require_once '../../controller/categoryController.php';

$error="";

$category= null;
$categoryController = new categoriesController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate that none of the fields are empty
    if (
        isset($_POST["nomCat"]) && $_POST["descriptionCat"]) {
        if (!empty($_POST["nomCat"]) && !empty($_POST["descriptionCat"])) {
            

            // Create the Event object with or without the new image
            $category = new category(
                null,
                $_POST['nomCat'],
                $_POST['descriptionCat'],
            );

            // Update the event in the database
            $categoryController->updateCategory($category, $_POST['idCat']);

            // Redirect to the event list page
            header('Location:listCategories.php');
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
        if (isset($_POST['idCat'])) {
            $category = $categoryController->showCategory($_POST['idCat']);
        ?>
            <form  action="" method="POST" > <!-- Added enctype for file upload -->
                <div class="mb-3">
                    <label for="id" class="form-label">ID category:</label>
                    <input class="form-control" type="text" id="idCat" name="idCat" readonly value="<?php echo $_POST['idCat'] ?>">
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom category:</label>
                    <input class="form-control" type="text" id="nomCat" name="nomCat" value="<?php echo $category['nomCat'] ?>">
                    <span id="name_error"></span>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="descriptionCat" name="descriptionCat"><?php echo $category['descriptionCat'] ?></textarea>
                    <span id="description_error"></span>
                </div>
            
                <button type="submit" class="btn btn-primary">Update category</button>
            </form>
        <?php
        }
        ?>
</body>
</html>