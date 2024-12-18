<?php

include_once '../../config.php';
$pdo = config::getConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = trim($_POST['message']);
    $response = '';

    if (preg_match('/^([\d+\-*\/\s\(\)]+)$/', $message)) {
        try {
            // Évaluation de l'expression mathématique
            $result = eval("return " . $message . ";");
            $response = "Le résultat est : $result";
        } catch (Throwable $e) {
            $response = "Désolé, je n'ai pas pu comprendre cette expression.";
        }
    } elseif (isset($pdo)) { // Vérification de la connexion PDO
        $messageNoSpaces = str_replace(' ', '', strtolower($message));

        // Décomposer la question en mots
        $words = explode(' ', $message);
        $whereClause = '';
        $params = [];

        // Construire la clause WHERE dynamique
        foreach ($words as $index => $word) {
            if (!empty($word)) {
                $whereClause .= "REPLACE(question, ' ', '') LIKE :word$index OR ";
                $params[":word$index"] = '%' . $word . '%';
            }
        }

        $whereClause = rtrim($whereClause, ' OR ');

        // Préparer et exécuter la requête SQL
        if (!empty($whereClause)) {
            $sql = "SELECT reponse FROM chatbot WHERE " . $whereClause;
            $stmt = $pdo->prepare($sql);

            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            $stmt->execute();
            $response = $stmt->fetchColumn();

            if (!$response) {
                $response = "Désolé, je n'ai pas trouvé de réponse à votre question.";
            }
        } else {
            $response = "Désolé, votre question est vide.";
        }
    } else {
        $response = "Erreur de connexion à la base de données.";
    }

    // Retour de la réponse
    echo $response;
    exit;
} else {
    echo "Requête invalide.";
    exit;
}
?>
