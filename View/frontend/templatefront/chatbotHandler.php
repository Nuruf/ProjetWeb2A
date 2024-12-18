<?php
include '../../../Controller/metierController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification de la présence du message
    $message = $_POST['message'] ?? '';
    if (empty($message)) {
        echo json_encode(['response' => 'Aucun message reçu.']);
        exit;
    }

    // Initialiser le contrôleur
    $controller = new metierController();

    // Traiter la réponse du chatbot
    try {
        $response = $controller->chatbot($message);

        // Vérifier si la réponse est valide
        if (empty($response)) {
            echo json_encode(['response' => 'Aucune réponse trouvée.']);
        } else {
            echo json_encode(['response' => $response]);
        }
    } catch (Exception $e) {
        // Gérer les erreurs
        echo json_encode(['response' => 'Erreur dans la communication avec le chatbot. Veuillez réessayer plus tard.']);
    }
}
?>
