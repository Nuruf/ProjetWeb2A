<?php
include '../../controller/CategoryController.php';
$CategoryController = new CategoryController();
$CategoryController->deleteCategory($_GET["idCat"]);
header('Location:listCategory.php');
?>