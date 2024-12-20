<?php
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $reclamationController = new ReclamationController();

    // Fetch the specific reclamation
    $reclamation = $reclamationController->getReclamationById($_GET['id']);
    if (!$reclamation) {
        echo "Reclamation not found.";
        exit();
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Answer Reclamation</title>
</head>
<body>
    <h1>Answer Reclamation</h1>
    <h2>Reclamation Details</h2>
    <p><strong>ID:</strong> <?= htmlspecialchars($reclamation['id']) ?></p>
    <p><strong>Description:</strong> <?= htmlspecialchars($reclamation['description']) ?></p>
   
    <h2>Provide Your Answer</h2>
    <form action="saveAnswer.php" method="POST">
        <!-- Hidden field to pass the reclamation ID -->
        <input type="hidden" name="id_reclamation" value="<?= htmlspecialchars($reclamation['id']) ?>">

        <label for="contenu">Your Answer:</label><br>
        <textarea id="contenu" name="contenu" rows="6" cols="50" placeholder="Write your answer here..." required></textarea><br><br>

        <button type="submit">Submit Answer</button>
    </form>
</body>
</html>
