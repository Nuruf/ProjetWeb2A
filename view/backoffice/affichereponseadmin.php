<?php
require_once 'C:\xampp\htdocs\projet web\controller\ReponseController.php'; 
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php'; 

// Initialize controllers
$reponseController = new ReponseController();
$reclamationController = new ReclamationController();

// Check if a reclamation ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_reclamation = intval($_GET['id']);

    // Fetch the specific reclamation
    $reclamation = $reclamationController->getReclamationById($id_reclamation);

    if (!$reclamation) {
        echo "Reclamation not found.";
        exit();
    }

    // Fetch responses for the given reclamation ID
    $responses = $reponseController->getResponsesByReclamationId($id_reclamation);
} else {
    echo "Invalid reclamation ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses for Reclamation</title>
    <style>
        /* General Body Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            margin: 0;
        }

        /* Heading Styles */
        h1, h2 {
            color: #333;
            text-align: center;
        }

        /* Text Styles for Description and Status */
        p {
            font-size: 18px;
            color: #555;
            line-height: 1.5;
        }

        /* List Styles for Responses */
        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 10px;
        }

        li strong {
            color: #007acc;
        }

        /* Button Styles */
        button {
            padding: 10px 20px;
            background-color: #007acc;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        button:hover {
            background-color: #005f99;
        }

        /* Form Styles */
        form {
            text-align: center;
            margin-top: 20px;
        }

        /* Optional: Link Styling (if needed for other links) */
        a {
            color: #007acc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Responses for Reclamation #<?= htmlspecialchars($reclamation['id']) ?></h1>
    <p><strong>Description:</strong> <?= htmlspecialchars($reclamation['description']) ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars($reclamation['status']) ?></p>
    
    <h2>Responses:</h2>
    <?php if (!empty($responses)): ?>
        <ul>
            <?php foreach ($responses as $response): ?>
                <li>
                    <strong>Content:</strong> <?= htmlspecialchars($response['contenu']) ?><br>
                    <strong>Date:</strong> <?= htmlspecialchars($response['date_reponse']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>This reclamation is not treated yet.</p>
    <?php endif; ?>
    
    <!-- see awnser button-->
    <form action="reclamationlistadmin.php" method="post" style="display:inline;">
    <input type="hidden" name="id_user" value="<?= htmlspecialchars($reclamation['id_user']) ?>">
    <button type="submit">Back to Reclamation List</button>
</form>
</body>
</html>
