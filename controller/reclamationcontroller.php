<?php
require_once 'C:\xampp\htdocs\projet web\conf.php';
require_once 'C:\xampp\htdocs\projet web\model\reclamation.php';

class ReclamationController {
    function addReclamation($reclamation) {
        $sql = "INSERT INTO reclamation (id, id_user, description, status, date)
                VALUES (NULL, :user_id, :description, :status, :date)";
        $db = DatabaseConfig::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $reclamation->getUserId(),
                'description' => $reclamation->getDescription(),
                'status' => $reclamation->getStatus(),
                'date' => $reclamation->getDate(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getAllReclamations() {
        $db = DatabaseConfig::getConnexion();
        try {
            $query = "SELECT * FROM reclamation";
            $stmt = $db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            die("Error retrieving reclamations: " . $e->getMessage());
        }
    }
    public function deleteReclamation($id) {
        $db = DatabaseConfig::getConnexion();
        try {
            $query = $db->prepare("DELETE FROM reclamation WHERE id = :id");
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception('Error deleting reclamation: ' . $e->getMessage());
        }
    }
    public function getReclamationById($id) {
        $db = DatabaseConfig::getConnexion();
        try {
            $query = $db->prepare("SELECT * FROM reclamation WHERE id = :id");
            $query->execute(['id' => $id]);
            return $query->fetch();
        } catch (Exception $e) {
            throw new Exception('Error retrieving reclamation: ' . $e->getMessage());
        }
    }
    public function updateReclamation($id, $description, $status)
{
    // Establish a connection to the database
    $db = DatabaseConfig::getConnexion();

    // Prepare an SQL query for updating the record
    $query = "UPDATE reclamation SET description = :description, status = :status WHERE id = :id";

    $statement = $db->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':status', $status, PDO::PARAM_STR);

    // Execute the query and return the result
    return $statement->execute();
}
public function addAnswer($id_reclamation, $answer) {
    $db = DatabaseConfig::getConnexion();

    $query = "INSERT INTO réponse (id_reponse, contenu, date_reponse, id_reclamation) VALUES (NULL, :contenu, NOW(), :id_reclamation )";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_reclamation', $id_reclamation, PDO::PARAM_INT);
    $stmt->bindParam(':contenu', $answer, PDO::PARAM_STR);

    return $stmt->execute();
}
public function getReclamationsByUserId($userId){
    $db = DatabaseConfig::getConnexion();
    $stmt = $db->prepare("SELECT * FROM reclamation WHERE id_user = :id_user");
    $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
        

}
public function getUserIdByReclamationId($id)
{
    $db = DatabaseConfig::getConnexion();
    $query = "SELECT id_user FROM reclamation WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
    return $result['id_user'];
}
public function getReclamationsByStatus($status) {
    $db = DatabaseConfig::getConnexion();
    $stmt = $db->prepare("SELECT * FROM reclamation WHERE status = ?");
    $stmt->execute([$status]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getReclamationCountsByStatus()
{
    try {
        $db = DatabaseConfig::getConnexion(); // Assurez-vous que cette méthode retourne une connexion PDO.
        $query = "
            SELECT 
                SUM(CASE WHEN status = 'Open' THEN 1 ELSE 0 END) AS open,
                SUM(CASE WHEN status = 'Closed' THEN 1 ELSE 0 END) AS closed
            FROM reclamation";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'open' => intval($result['open']),
            'closed' => intval($result['closed'])
        ];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [
            'open' => 0,
            'closed' => 0
        ];
    }
}


}
?>
