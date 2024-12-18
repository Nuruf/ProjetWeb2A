<?php
require_once '../../config/DbConfig.php';

class LikeDislike {
    private $id;
    private $user_id;
    private $post_id;
    private $comment_id;
    private $is_like;
    private $created_at;
    private $pdo;

    // Constructor initializes the PDO connection
    public function __construct() {
        $dbConfig = new DbConfig();
        $this->pdo = $dbConfig->getConnection();
    }

    // Getter for ID
    public function getId() {
        return $this->id;
    }

    // Getter for ID
    public function getIsLike() {
        return $this->is_like;
    }
    // Getter for ID
    public function getPostId() {
        return $this->post_id;
    }

    public function getCommentId(){
        return $this->comment_id;
    }
    public function setId($id){
        $this->id=$id;
    }
    // Setters for properties
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setPostId($post_id) {
        $this->post_id = $post_id;
    }

    public function setCommentId($comment_id) {
        $this->comment_id = $comment_id;
    }

    public function setIsLike($is_like) {
        $this->is_like = $is_like;
    }

    // Method to create a new like or dislike
    public function create() {
        $query = "INSERT INTO like_dislike (user_id, post_id, comment_id, is_like) 
                  VALUES (:user_id, :post_id, :comment_id, :is_like)";
        
        $stmt = $this->pdo->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':post_id', $this->post_id, PDO::PARAM_INT);
        $stmt->bindParam(':comment_id', $this->comment_id, PDO::PARAM_INT);
        $stmt->bindParam(':is_like', $this->is_like, PDO::PARAM_BOOL);

        $stmt->execute();
    }

    // Method to read likes or dislikes by post or comment
    public function readByPostOrComment($post_id = null, $comment_id = null) {
        $query = "SELECT * FROM like_dislike WHERE ";
        $params = [];

        if ($post_id !== null) {
            $query .= "post_id = :post_id";
            $params[':post_id'] = $post_id;
        } elseif ($comment_id !== null) {
            $query .= "comment_id = :comment_id";
            $params[':comment_id'] = $comment_id;
        } else {
            return []; // No post_id or comment_id provided
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to delete a like or dislike by ID
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM like_dislike WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

 // Check if a user has already voted on a post or comment
 public function hasVoted($user_id, $post_id = null, $comment_id = null) {
    $query = "SELECT id, user_id, post_id, comment_id, is_like FROM like_dislike WHERE user_id = :user_id";
    
    if ($post_id !== null) {
        $query .= " AND post_id = :post_id";
    } elseif ($comment_id !== null) {
        $query .= " AND comment_id = :comment_id";
    }
    
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
    if ($post_id !== null) {
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    } elseif ($comment_id !== null) {
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}


public function update() {
    $query = "UPDATE like_dislike SET is_like = :is_like WHERE id = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':is_like', $this->is_like, PDO::PARAM_INT);
    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
    return $stmt->execute();
}

public function isPostLikedByUser($userId, $postId) {
    $query = "SELECT 1 FROM like_dislike WHERE user_id = :user_id AND post_id = :post_id AND is_like = 1";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_COLUMN) !== false; // True if a row is found
}

public function isPostDislikedByUser($userId, $postId) {
    $query = "SELECT 1 FROM like_dislike WHERE user_id = :user_id AND post_id = :post_id AND is_like = 0";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_COLUMN) !== false; 
}

public function isCommentLikedByUser($userId, $commentId) {
    $query = "SELECT 1 FROM like_dislike WHERE user_id = :user_id AND comment_id = :comment_id AND is_like = 1";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_COLUMN) !== false; 
}

public function isCommentDislikedByUser($userId, $commentId) {
    $query = "SELECT 1 FROM like_dislike WHERE user_id = :user_id AND comment_id = :comment_id AND is_like = 0";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_COLUMN) !== false; 
}

}
