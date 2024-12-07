
<?php
include_once __DIR__ . '/../config/config.php'; 
class metierController {
    
    public function searchUsers($searchTerm = '') {
        $db = config::getConnexion();
    
        // Si un terme est saisi, on filtre uniquement par le champ Utilisateur.
        if (!empty($searchTerm)) {
            $sql = "SELECT Id, Email,MotDePasse, Telephone, Utilisateur, Role 
                    FROM utilisateur 
                    WHERE Utilisateur LIKE :searchTerm";
        } else {
            $sql = "SELECT Id, Email, Telephone, Utilisateur, Role 
                    FROM utilisateur";
        }
    
        try {
            $query = $db->prepare($sql);
    
            // Ajoute le paramètre de recherche seulement si un terme est saisi.
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
        $db = config::getConnexion();
    
        try {
            // Récupérer tous les utilisateurs
            $sql = "SELECT Role FROM utilisateur";
            $query = $db->prepare($sql);
            $query->execute();
    
            // Compter le nombre total d'utilisateurs
            $totalUsers = $query->rowCount();
            
            if ($totalUsers == 0) {
                return "Aucun utilisateur trouvé.";
            }
    
            // Récupérer le nombre de clients (role = 1)
            $sqlClients = "SELECT COUNT(*) FROM utilisateur WHERE Role = 1";
            $queryClients = $db->prepare($sqlClients);
            $queryClients->execute();
            $clientCount = $queryClients->fetchColumn();
    
            // Récupérer le nombre d'administrateurs (role = 0)
            $sqlAdmins = "SELECT COUNT(*) FROM utilisateur WHERE Role = 0";
            $queryAdmins = $db->prepare($sqlAdmins);
            $queryAdmins->execute();
            $adminCount = $queryAdmins->fetchColumn();
    
            // Calculer les pourcentages
            $clientPercentage = ($clientCount / $totalUsers) * 100;
            $adminPercentage = ($adminCount / $totalUsers) * 100;
    
            // Afficher les résultats
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
    
    

}
?>


