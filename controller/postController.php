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
            $stmt = $this->pdo->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
            $stmt->execute(['title' => $title, 'content' => $content]);
            return new Post($this->pdo->lastInsertId(), $title, $content);
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
            return new Post($data['id'], $data['title'], $data['content']);
        } else {
            return null;  // Return null if the post is not found
        }
    }

    // Get all posts
    public function getAllPosts() {
        $stmt = $this->pdo->query("SELECT * FROM posts");
        $posts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = new Post($row['id'], $row['title'], $row['content']);
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
            return false;  // Return false if an error occurred
        }
    }

    // Delete a post
    public function deletePost($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return true;  // Post deleted successfully
        } catch (PDOException $e) {
            echo "Error deleting post: " . $e->getMessage();
            return false;  // Return false in case of an error
        }
    }
    public function getRecentPosts() {
        // Fetch posts including the created_at field and the comment count
        $stmt = $this->pdo->prepare("
            SELECT p.*, COUNT(c.id) AS comment_count
            FROM posts p
            LEFT JOIN comments c ON p.id = c.post_id
            GROUP BY p.id
            ORDER BY p.created_at DESC  -- Sort by created_at to get recent posts first
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public function getPostsByMostComments() {
    // SQL query to fetch posts ordered by the number of comments
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

