<?php
require_once 'C:\xampp\htdocs\projet web\conf.php';
require_once 'C:\xampp\htdocs\projet web\model\Reponse.php';

class ReponseController {
    public function getResponsesByReclamationId($id_reclamation) {
        $query = "SELECT id_reponse, contenu, date_reponse
        FROM réponse
        WHERE id_reclamation = :id_reclamation";
        $db = DatabaseConfig::getConnexion();
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_reclamation', $id_reclamation, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateReponse($id, $contenu)
{
    $sql = "UPDATE réponse SET contenu = :contenu, date_reponse = NOW() WHERE id_reponse = :id";
    $db = DatabaseConfig::getConnexion();
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
    return $stmt->execute();
}
public function getAllReponses()
{
    $sql = "SELECT * FROM réponse";
    $db = DatabaseConfig::getConnexion();
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getReponseById($id_reponse) {
    $db = DatabaseConfig::getConnexion();
    try {
        $query = $db->prepare("SELECT * FROM réponse WHERE id_reponse = :id_reponse");
        $query->execute(['id_reponse' => $id_reponse]);
        return $query->fetch();
    } catch (Exception $e) {
        throw new Exception('Error retrieving reponse: ' . $e->getMessage());
    }
}
public function deleteReponse($id)
{
    
    $db = DatabaseConfig::getConnexion();
    $sql = "DELETE FROM réponse WHERE id_reponse = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
    

}
public function getReponsesWithReclamation()
{
    try {
        $db = DatabaseConfig::getConnexion();
        $sql = "
            SELECT r.id_reponse, r.contenu, r.date_reponse, r.id_reclamation, rec.description as reclamation_content
            FROM réponse r
            INNER JOIN reclamation rec ON r.id_reclamation = rec.id
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching responses with reclamation content: " . $e->getMessage());
        return [];
    }
}

}