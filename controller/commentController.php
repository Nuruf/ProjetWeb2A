<?php
require_once 'C:\xampp\htdocs\project\config.php'; 
require_once 'C:\xampp\htdocs\project\model\comment.php'; 

class CommentController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new comment
    public function createComment($postId, $commentText) {
        try {
            // Validate the comment text for bad words
            $comment = new Comment(null, $postId, $commentText); // This will throw exception if bad words found

            $stmt = $this->pdo->prepare("INSERT INTO comments (post_id, comment) VALUES (:postId, :comment)");
            $stmt->execute(['postId' => $postId, 'comment' => $commentText]);

            return new Comment($this->pdo->lastInsertId(), $postId, $commentText);  
        } catch (Exception $e) {
            // If the comment contains bad words, we handle the exception here
            echo "Error: " . $e->getMessage();
            return null;  
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error creating comment: " . $e->getMessage();
            return null;  
        }
    }

    public function getComment($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                return new Comment($data['id'], $data['post_id'], $data['comment']);
            } else {
                return null;  
            }
        } catch (PDOException $e) {
            echo "Error fetching comment: " . $e->getMessage();
            return null;
        }
    }

    // Get all comments for a specific post
    public function getCommentsByPostId($postId) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE post_id = :postId");
            $stmt->execute(['postId' => $postId]);
            $comments = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $comments[] = new Comment($row['id'], $row['post_id'], $row['comment']);
            }
            return $comments;
        } catch (PDOException $e) {
            echo "Error fetching comments: " . $e->getMessage();
            return []; 
        }
    }

    // Update a comment
    public function updateComment($id, $commentText) {
        try {
            // Validate the comment text for bad words
            $comment = new Comment($id, null, $commentText);

            $stmt = $this->pdo->prepare("UPDATE comments SET comment = :comment WHERE id = :id");
            $stmt->execute(['comment' => $commentText, 'id' => $id]);

            return true;  
        } catch (Exception $e) {
            // Handle bad word exception
            echo "Error: " . $e->getMessage();
            return false;  // Return false if bad words are found
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error updating comment: " . $e->getMessage();
            return false;  
        }
    }

    // Delete a comment
    public function deleteComment($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM comments WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return true;  // Comment deleted successfully
        } catch (PDOException $e) {
            echo "Error deleting comment: " . $e->getMessage();
            return false;  
        }
    }
}
?>