<?php
include '../../Controller/controllerUser.php';
$cc = new CoursController();

$cc->deleteUser($_GET["id"]);  

header('Location: dashboard backoffice.php');

?>
