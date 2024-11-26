<?php

require_once __DIR__ . '/../models/Database.php';

class PostController {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getPosts() {
        $sql = "SELECT * FROM posts ORDER BY id DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPost($title, $content) {
        $sql = "INSERT INTO posts (title, content) VALUES (:title, :content)";
        $this->db->query($sql, ['title' => $title, 'content' => $content]);
    }

    public function deletePost($id) {
        $sql = "DELETE FROM posts WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    public function getPost($id) {
        $sql = "SELECT * FROM posts WHERE id = :id";
        return $this->db->query($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    }

    public function editPost($id, $title, $content) {
        $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
        $this->db->query($sql, ['id' => $id, 'title' => $title, 'content' => $content]);
    }

    public function getComments($postId) {
        $sql = "SELECT * FROM comments WHERE post_id = :post_id ORDER BY id DESC";
        return $this->db->query($sql, ['post_id' => $postId])->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($postId, $comment) {
        $sql = "INSERT INTO comments (post_id, comment) VALUES (:post_id, :comment)";
        $this->db->query($sql, ['post_id' => $postId, 'comment' => $comment]);
    }

    public function deleteComment($id) {
        $sql = "DELETE FROM comments WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    public function getComment($id) {
        $sql = "SELECT * FROM comments WHERE id = :id";
        return $this->db->query($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    }

    public function editComment($id, $comment) {
        $sql = "UPDATE comments SET comment = :comment WHERE id = :id";
        $this->db->query($sql, ['id' => $id, 'comment' => $comment]);
    }
}
?>
