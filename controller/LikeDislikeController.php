<?php
require_once __DIR__ . '/../model/like_dislike.php';
require_once 'C:\xampp\htdocs\projet web\conf.php';

class LikeDislikeController {
    private $likeDislikeModel;
    private $pdo;
    

    public function __construct() {
        $this->likeDislikeModel = new LikeDislike();
        $DatabaseConfig = new DatabaseConfig();
        $this->pdo = $DatabaseConfig->getConnexion();
    }

    public function vote($user_id, $post_id = null, $comment_id = null, $is_like) {
        $query = "INSERT INTO like_dislike (user_id, post_id, comment_id, is_like) VALUES (:user_id, :post_id, :comment_id, :is_like)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        $stmt->bindParam(':is_like', $is_like, PDO::PARAM_BOOL);
    
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Failed to insert vote");
        }
    }
    

    public function cancelVote($user_id, $post_id = null, $comment_id = null) {
        echo "Cancel vote called with user_id=$user_id, post_id=$post_id, comment_id=$comment_id";
        $existingVote = $this->likeDislikeModel->hasVoted($user_id, $post_id, $comment_id);
        if ($existingVote) {
            $query = "DELETE FROM like_dislike WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $existingVote['id'], PDO::PARAM_INT); // Use array key instead of method
            $stmt->execute();
            echo "Vote deleted";
        } else {
            echo "Vote not found";
        }
    }

    // Get votes by post or comment
    public function getVote($post_id = null, $comment_id = null) {
        $votes = $this->likeDislikeModel->readByPostOrComment($post_id, $comment_id);

        if (empty($votes)) {
            echo json_encode(["message" => "No votes found."]);
            return;
        }

        echo json_encode(["votes" => $votes]);
    }


    // update vote 
    public function updateVote($user_id, $post_id = null, $comment_id = null, $is_like) {
        $query = "UPDATE like_dislike SET is_like = :is_like WHERE user_id = :user_id";
        
        if ($post_id !== null) {
            $query .= " AND post_id = :post_id";
        } elseif ($comment_id !== null) {
            $query .= " AND comment_id = :comment_id";
        }
    
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':is_like', $is_like, PDO::PARAM_BOOL);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
        if ($post_id !== null) {
            $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        } elseif ($comment_id !== null) {
            $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        }
    
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Failed to update vote");
        }
    }

    public function getVoteStatistics() {
        try {
            // SQL query to fetch the statistics of likes and dislikes per day
            $sql = "
                SELECT 
                    DATE(created_at) AS date,
                    SUM(is_like = 1) AS likes,
                    SUM(is_like = 0) AS dislikes
                FROM like_dislike
                GROUP BY DATE(created_at)
                ORDER BY DATE(created_at) DESC
            ";
    
            // Create an instance of DatabaseConfig
            $DatabaseConfig = new DatabaseConfig();
            $pdo = $DatabaseConfig->getConnexion(); // Get the PDO connection
    
            // Prepare and execute the statement
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        
            // Fetch the results
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            // Check if data is empty
            if (empty($data)) {
                return json_encode([]); // Return an empty array if no data
            }
    
            // Convert the result to JSON format
            return json_encode($data);
        
        } catch (PDOException $e) {
            // Return an error message in JSON format
            return json_encode(['error' => "Error fetching vote statistics: " . $e->getMessage()]);
        }
    }
    

    

}


?>
