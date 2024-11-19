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

}
?>
