<?php
require_once 'C:\xampp\htdocs\projet web\conf.php';


class metierController {
    
  
    public function searchUsers($searchTerm = '') {
        $db = DatabaseConfig::getConnexion();
    
        if (!empty($searchTerm)) {
            $sql = "SELECT Id, Email, MotDePasse, Telephone, Utilisateur, Role 
                    FROM utilisateur 
                    WHERE Utilisateur LIKE :searchTerm";
        } else {
            $sql = "SELECT Id, Email, Telephone, Utilisateur, Role 
                    FROM utilisateur";
        }
    
        try {
            $query = $db->prepare($sql);
    
            if (!empty($searchTerm)) {
                $query->execute([
                    'searchTerm' => '%' . $searchTerm . '%'
                ]);
            } else {
                $query->execute();
            }
    
            $users = $query->fetchAll(PDO::FETCH_ASSOC);
            return $users;
    
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
            return [];
        }
    }

    public function getUsersPercentage() {
        $db = DatabaseConfig::getConnexion();
    
        try {
            $sql = "SELECT Role FROM utilisateur";
            $query = $db->prepare($sql);
            $query->execute();
    
            $totalUsers = $query->rowCount();
            
            if ($totalUsers == 0) {
                return "Aucun utilisateur trouvé.";
            }
    
            $sqlClients = "SELECT COUNT(*) FROM utilisateur WHERE Role = 1";
            $queryClients = $db->prepare($sqlClients);
            $queryClients->execute();
            $clientCount = $queryClients->fetchColumn();
    
            $sqlAdmins = "SELECT COUNT(*) FROM utilisateur WHERE Role = 0";
            $queryAdmins = $db->prepare($sqlAdmins);
            $queryAdmins->execute();
            $adminCount = $queryAdmins->fetchColumn();
    
            $clientPercentage = ($clientCount / $totalUsers) * 100;
            $adminPercentage = ($adminCount / $totalUsers) * 100;
    
            return [
                'clientCount' => $clientCount,
                'adminCount' => $adminCount,
                'clientPercentage' => round($clientPercentage, 2),
                'adminPercentage' => round($adminPercentage, 2)
            ];
    
        } catch (Exception $e) {
            return 'Erreur : ' . $e->getMessage();
        }
    }

    public function chatbot($message) {
        $db = DatabaseConfig::getConnexion(); 
    
        try {
            $normalizedMessage = $this->normalizeMessage($message);
    

            $sql = "SELECT question, reponse FROM questions_reponses";
            $query = $db->prepare($sql);
            $query->execute();
            $questions = $query->fetchAll(PDO::FETCH_ASSOC);
    
 
            $keywords = ['gratuit', 'inscrire', 'comment', 'salu', 'quoi'];
    
            foreach ($keywords as $keyword) {
                if (strpos($normalizedMessage, $keyword) !== false) {
                    // Retourner la réponse en fonction du mot-clé trouvé
                    foreach ($questions as $q) {
                        if (strpos(strtolower($q['question']), $keyword) !== false) {
                            return $q['reponse'];
                        }
                    }
                }
            }
    
            // Si aucune correspondance n'est trouvée, message générique
            return "Désolé, je ne comprends pas bien. Peut-être reformulez-vous votre question ?";
        } catch (Exception $e) {
            // Gestion des erreurs
            return "Erreur dans la base de données : " . $e->getMessage();
        }
    }
    
    
   
    private function normalizeMessage($message) {
        // Retirer les caractères inutiles et convertir en minuscule
        $message = trim($message);
        $message = preg_replace('/[^a-zA-Z0-9\s]/', '', $message); // Retirer les caractères non-alphanumériques
        $message = strtolower($message); 
        return $message;
    }

    
}
?>
