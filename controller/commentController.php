<?php
require_once 'C:\xampp\htdocs\project\config.php';  // Use require_once to avoid multiple inclusions
require_once 'C:\xampp\htdocs\project\model\comment.php'; // Include the Comment class correctly

class CommentController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new comment
    public function createComment($postId, $commentText) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO comments (post_id, comment) VALUES (:postId, :comment)");
            $stmt->execute(['postId' => $postId, 'comment' => $commentText]);
            return new Comment($this->pdo->lastInsertId(), $postId, $commentText);  // Return a Comment object
        } catch (PDOException $e) {
            echo "Error creating comment: " . $e->getMessage();
            return null;  // Return null in case of error
        }
    }

    // Get a specific comment by ID
    public function getComment($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if the comment was found
            if ($data) {
                return new Comment($data['id'], $data['post_id'], $data['comment']);
            } else {
                return null;  // Return null if the comment is not found
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
            return [];  // Return an empty array in case of error
        }
    }

    // Update a comment
    public function updateComment($id, $commentText) {
        try {
            $stmt = $this->pdo->prepare("UPDATE comments SET comment = :comment WHERE id = :id");
            $stmt->execute(['comment' => $commentText, 'id' => $id]);
            return true;  // Comment updated successfully
        } catch (PDOException $e) {
            echo "Error updating comment: " . $e->getMessage();
            return false;  // Return false if an error occurred
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
            return false;  // Return false in case of an error
        }
    }
}
?>
