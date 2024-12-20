<?php
include '../../controller/CategoryController.php';
$CategoryController = new categoriesController();
$CategoryController->deleteCategory($_GET["idCat"]);
header('Location:listCategories.php');
?>