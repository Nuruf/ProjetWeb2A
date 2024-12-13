<?php
include 'C:\xampp\htdocs\project\config.php';
include 'C:\xampp\htdocs\project\model\post.php';

class PostController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new post
    public function createPost($title, $content) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO posts (title, content, likes, dislikes) VALUES (:title, :content, 0, 0)");
            $stmt->execute(['title' => $title, 'content' => $content]);
            return new Post($this->pdo->lastInsertId(), $title, $content, 0, 0);
        } catch (PDOException $e) {
            echo "Error creating post: " . $e->getMessage();
            return null;
        }
    }

    // Get a specific post by ID
    public function getPost($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the post was found
        if ($data) {
            return new Post($data['id'], $data['title'], $data['content'], $data['likes'], $data['dislikes']);
        } else {
            return null;  
        }
    }

    // Get all posts
    public function getAllPosts() {
        $stmt = $this->pdo->query("SELECT * FROM posts");
        $posts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = new Post($row['id'], $row['title'], $row['content'], $row['likes'], $row['dislikes']);
        }
        return $posts;
    }

    // Update a post
    public function updatePost($id, $title, $content) {
        try {
            $stmt = $this->pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
            $stmt->execute(['title' => $title, 'content' => $content, 'id' => $id]);
            return true;  // Post updated successfully
        } catch (PDOException $e) {
            echo "Error updating post: " . $e->getMessage();
            return false;  
        }
    }

    // Delete a post
    public function deletePost($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return true;  
        } catch (PDOException $e) {
            echo "Error deleting post: " . $e->getMessage();
            return false; 
        }
    }

    // Increment likes for a post
    public function likePost($id) {
        try {
            $stmt = $this->pdo->prepare("UPDATE posts SET likes = likes + 1 WHERE id = :id");
            $stmt->execute(['id' => $id]);
<<<<<<< HEAD
            return $this->getPost($id); 
=======
            return $this->getPost($id); // Return the updated post
>>>>>>> 7959260c851ae3824dd25997cd02132e94a62191
        } catch (PDOException $e) {
            echo "Error liking post: " . $e->getMessage();
            return null;
        }
    }

    // Increment dislikes for a post
    public function dislikePost($id) {
        try {
            $stmt = $this->pdo->prepare("UPDATE posts SET dislikes = dislikes + 1 WHERE id = :id");
            $stmt->execute(['id' => $id]);
<<<<<<< HEAD
            return $this->getPost($id); 
=======
            return $this->getPost($id); // Return the updated post
>>>>>>> 7959260c851ae3824dd25997cd02132e94a62191
        } catch (PDOException $e) {
            echo "Error disliking post: " . $e->getMessage();
            return null;
        }
    }

    // Get posts sorted by most likes
    public function getPostsByMostLikes() {
        $stmt = $this->pdo->query("SELECT * FROM posts ORDER BY likes DESC");
        $posts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = new Post($row['id'], $row['title'], $row['content'], $row['likes'], $row['dislikes']);
        }
        return $posts;
    }

    // Get recent posts with comment count
    public function getRecentPosts() {
        $stmt = $this->pdo->prepare("
            SELECT p.*, COUNT(c.id) AS comment_count
            FROM posts p
            LEFT JOIN comments c ON p.id = c.post_id
            GROUP BY p.id
            ORDER BY p.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get posts by most comments
    public function getPostsByMostComments() {
        $stmt = $this->pdo->prepare("
            SELECT p.*, COUNT(c.id) AS comment_count
            FROM posts p
            LEFT JOIN comments c ON p.id = c.post_id
            GROUP BY p.id
            ORDER BY comment_count DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
