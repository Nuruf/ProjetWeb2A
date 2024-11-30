<?php
include '../../controller/ContenuController.php';
$contenuController = new contenuController();
$contenuController->deleteContenu($_GET["idContenu"]);
header('Location:listContenu.php');
?>