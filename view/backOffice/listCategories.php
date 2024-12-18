<?php
include '../../controller/CategoryController.php';
$categoriesController = new categoriesController();
$list = $categoriesController->listCategories();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<aside class="sidebar">
        <div class="sidebar-header">
            <img src="logoo.png" alt="Logo" class="logo">
            <h3>Dashboard</h3>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="#profile" onclick="showSection('profile')"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="#forum" onclick="showSection('forum')"><i class="fas fa-comments"></i> Forum</a></li>
                <li><a href="listCategories.php" onclick="showSection('skillSwapp')"><i class="fas fa-exchange-alt"></i> Skill Swap</a></li>
                <li><a href="dashboardStatistics.php">Statistics</a></li>
                <li><a href="#blog" onclick="showSection('blog')"><i class="fas fa-blog"></i> Blog</a></li>
                <li><a href="#quiz" onclick="showSection('quiz')"><i class="fas fa-question-circle"></i> Quiz</a></li>
                <li><a href="#reclamation" onclick="showSection('reclamation')"><i class="fas fa-file-alt"></i> Réclamation</a></li>
            </ul>
        </nav>
    </aside>

<div class="container mt-5">
    <div id="skillSwapp-content" >
        <h1 class="section-title">Categories</h1>
        <p class="section-description">Exchange skills with other members of the community. Find new opportunities for learning and teaching.</p>
        <a href="createCategory.php" class="btn btn-primary">Add New Category</a><br>
    </div><br>
    <table border="1" class="form-group">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $category): ?>
                <tr onclick="window.location.href='listContenu.php?idCat=<?= htmlspecialchars($category['idCat']); ?>'" style="cursor: pointer;">
                    <td><?php echo htmlspecialchars($category['idCat']); ?></td>
                    <td><?php echo htmlspecialchars($category['nomCat']); ?></td>
                    <td><?php echo htmlspecialchars($category['descriptionCat']); ?></td>                    
                    <td><a href="deleteCategory.php?idCat=<?php echo htmlspecialchars($category['idCat']); ?>" class="btn">Delete</a></td>
                    <td>
                        <form method="POST" action="editCategory.php" class="btn btn-primary"> 
                            <input type="submit" name="update" value="Update" class="btn btn-primary">
                            <input type="hidden" value="<?= htmlspecialchars($category['idCat']); ?>" name="idCat">
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
