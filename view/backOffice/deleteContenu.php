<?php
include '../../controller/ContenuController.php';
$contenuController = new contenuController();

// Check if the id and eventId are set in the URL
if (isset($_GET["idContenu"]) && isset($_GET["idCat"])) {
    $idCat = $_GET['idCat'];
    $contenuController->deleteContenu($_GET["idContenu"]);
    header('Location:listContenu.php?idCat=' . urlencode($idCat));
    exit; // Ensure no further processing occurs after the redirect
} else {
    die('Error: Missing parameters.');
}
?>