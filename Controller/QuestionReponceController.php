<?php

include_once '../../config.php';


function getChatbotResponse($message) {
   
    $messageNoSpaces = str_replace(' ', '', strtolower($message));

    $bd = config::getConnexion();

   
    $words = explode(' ', $message);
    $whereClause = '';
    $params = [];

    
    foreach ($words as $index => $word) {
        if (!empty($word)) {
            $whereClause .= "REPLACE(question, ' ', '') LIKE :word$index OR ";
            $params[":word$index"] = '%' . $word . '%';
        }
    }

    // Retirer le dernier 'OR'
    $whereClause = rtrim($whereClause, ' OR ');


    if (!empty($whereClause)) {
        $sql = "SELECT reponse FROM chatbot WHERE " . $whereClause;
        $stmt = $bd->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

  
        $stmt->execute();
        
        
        $response = $stmt->fetchColumn();

        if (!$response) {
            $response = "Désolé, je n'ai pas trouvé de réponse à votre question.";
        }

        return $response;
    }

    return "Désolé, votre question est vide.";
}
?>
