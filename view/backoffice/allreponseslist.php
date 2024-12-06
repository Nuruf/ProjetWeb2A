<?php
/*require_once 'C:\xampp\htdocs\projet web\controller\ReponseController.php'; 

$reponseController = new ReponseController();
$reponses = $reponseController->getAllReponses();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de toutes les réponses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #ffffff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007acc;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .btn {
            padding: 5px 10px;
            background-color: #007acc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn:hover {
            background-color: #005f99;
        }
    </style>
</head>
<body>
    <h1>Liste de toutes les réponses</h1>
    <?php if ($reponses && count($reponses) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Réponse</th>
                    <th>awnser</th>
                    <th>Date Réponse</th>
                    <th>ID Réclamation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reponses as $reponse): ?>
                    <tr>
                        <td><?= htmlspecialchars($reponse['id_reponse']) ?></td>
                        <td><?= htmlspecialchars($reponse['contenu']) ?></td>
                        <td><?= htmlspecialchars($reponse['date_reponse']) ?></td>
                        <td><?= htmlspecialchars($reponse['id_reclamation']) ?></td>
                        <td>
                            <form action="updatereponse.php" method="GET" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($reponse['id_reponse']) ?>">
                                <button type="submit" class="btn">update</button>
                            </form>
                            <form action="deletereponse.php" method="GET" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($reponse['id_reponse']) ?>">
                                <button type="submit" class="btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réponse ?')">delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune réponse trouvée.</p>
    <?php endif; ?>
</body>
</html>*/

require_once 'C:\xampp\htdocs\projet web\controller\ReponseController.php';

$reponseController = new ReponseController();
$reponses = $reponseController->getReponsesWithReclamation();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de toutes les réponses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #ffffff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007acc;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .btn {
            padding: 5px 10px;
            background-color: #007acc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn:hover {
            background-color: #005f99;
        }
    </style>
</head>
<body>
    <h1>Liste de toutes les réponses</h1>
    <form action="reclamationlistadmin.php" method="post" style="display:inline;">
    <input type="hidden" name="id_user" value="<?= htmlspecialchars($reclamation['id_user']) ?>">
    <button type="submit">Back to Reclamation List</button>
    </form>
    <?php if ($reponses && count($reponses) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Contenu de la Réclamation</th>
                    <th>Contenu de la Réponse</th>
                    <th>Date Réponse</th>
                    <th>ID Réponse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reponses as $reponse): ?>
                    <tr>
                        <td><?= htmlspecialchars($reponse['reclamation_content']) ?></td>
                        <td><?= htmlspecialchars($reponse['contenu']) ?></td>
                        <td><?= htmlspecialchars($reponse['date_reponse']) ?></td>
                        <td><?= htmlspecialchars($reponse['id_reponse']) ?></td>
                        <td>
                            <form action="updatereponse.php" method="GET" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($reponse['id_reponse']) ?>">
                                <button type="submit" class="btn">update</button>
                            </form>
                            <form action="deletereponse.php" method="GET" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($reponse['id_reponse']) ?>">
                                <button type="submit" class="btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réponse ?')">delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune réponse trouvée.</p>
    <?php endif; ?>
</body>
</html>
