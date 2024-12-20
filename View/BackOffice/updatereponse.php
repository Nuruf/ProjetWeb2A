<?php
require_once 'C:\xampp\htdocs\projet web\controller\ReponseController.php';

$reponseController = new ReponseController();

// Check if a valid ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $reponse = $reponseController->getReponseById($_GET['id']);
    if (!$reponse) {
        echo "Réponse introuvable.";
        exit();
    }
} else {
    echo "ID de réponse invalide.";
    exit();
}

// Handle the form submission for updating the response
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $contenu = $_POST['contenu'] ?? null;

    if ($id && $contenu) {
        $result = $reponseController->updateReponse($id, $contenu);
        if ($result) {
            echo "Réponse mise à jour avec succès.";
            header('Location: allreponseslist.php');
            exit();
        } else {
            echo "Erreur lors de la mise à jour de la réponse.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour la réponse</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        textarea, button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            font-size: 1rem;
        }
        button {
            background-color: #007acc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #005b99;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Mettre à jour la réponse</h2>
        <input type="hidden" name="id" value="<?= htmlspecialchars($reponse['id_reponse'] ?? '') ?>">
        <label for="contenu">Contenu de la réponse :</label>
        <textarea name="contenu" id="contenu" rows="6" required><?= htmlspecialchars($reponse['contenu'] ?? '') ?></textarea>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
