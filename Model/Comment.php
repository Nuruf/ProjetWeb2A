<?php
require_once '../../config/DbConfig.php';

class Comment {
    private $id;
    private $post_id;
    private $user_id;
    private $comment;
    private $created_at;
    private $pdo;

    public function __construct() {
        $dbConfig = new DbConfig();
        $this->pdo = $dbConfig->getConnection();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPostId() {
        return $this->post_id;
    }

    public function setPostId($post_id) {
        $this->post_id = $post_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function create() {
        $stmt = $this->pdo->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
        $stmt->execute([$this->post_id, $this->user_id, $this->comment]);
        $this->id = $this->pdo->lastInsertId();
    }

    public function read($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE id = ?");
        $stmt->execute([$id]);
        $comment = $stmt->fetch();
        if ($comment) {
            $this->id = $comment['id'];
            $this->post_id = $comment['post_id'];
            $this->user_id = $comment['user_id'];
            $this->comment = $comment['comment'];
            $this->created_at = $comment['created_at'];
            return $this;
        }
        return null;
    }

    public function update() {
        $stmt = $this->pdo->prepare("UPDATE comments SET comment = ? WHERE id = ?");
        return $stmt->execute([$this->comment, $this->id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM comments WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getByPostId($post_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE post_id = ?");
        $stmt->execute([$post_id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Comment');
    }
}
?>