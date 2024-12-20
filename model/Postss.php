<?php

require_once __DIR__ . '/../conf.php';

class Postt {
    private $pdo;
    private $id;
    private $title;
    private $content;
    private $video_name;
    private $created_at;
    private $user_id;

    public function __construct($title = null, $content = null, $video_name = null, $created_at = null, $id = null, $user_id = null) {
        $DatabaseConfig = new DatabaseConfig();
        $this->pdo = $DatabaseConfig->getConnexion();
        $this->title = $title;
        $this->content = $content;
        $this->video_name = $video_name;
        $this->created_at = $created_at;
        $this->id = $id;
        $this->user_id = $user_id;
    }
    
    public function create() {
        $stmt = $this->pdo->prepare("INSERT INTO postt (title, content, video_name, created_at, user_id) VALUES (:title, :content, :video_name, :created_at, :user_id)");
        return $stmt->execute([
            'title' => $this->title,
            'content' => $this->content,
            'video_name' => $this->video_name,
            'created_at' => $this->created_at ?: date('Y-m-d H:i:s'),
            'user_id' => $this->user_id
        ]);
    }
    
    public function getById($id, $user_id = null) {
        $stmt = $this->pdo->prepare("SELECT * FROM postt WHERE id = :id AND (user_id = :user_id OR :user_id IS NULL)");
        $stmt->execute(['id' => $id, 'user_id' => $user_id]);
        $postData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($postData) {
            $this->id = $postData['id'];
            $this->title = $postData['title'];
            $this->content = $postData['content'];
            $this->video_name = $postData['video_name'];
            $this->created_at = $postData['created_at'];
            return $this;
        }
        return null;
    }
    
    public function update() {
        $stmt = $this->pdo->prepare("UPDATE postt SET title = :title, content = :content, video_name = :video_name WHERE id = :id AND user_id = :user_id");
        return $stmt->execute([
            'title' => $this->title,
            'content' => $this->content,
            'video_name' => $this->video_name,
            'id' => $this->id,
            'user_id' => $this->user_id
        ]);
    }
    
    public function delete($id, $user_id) {
        $stmt = $this->pdo->prepare("DELETE FROM postt WHERE id = :id AND user_id = :user_id");
        return $stmt->execute(['id' => $id, 'user_id' => $user_id]);
    }
    public function deleteA($id) {
        $stmt = $this->pdo->prepare("DELETE FROM postt WHERE id = :id ");
        return $stmt->execute(['id' => $id]);
    }
    
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM postt");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getVideoName() {
        return $this->video_name;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setVideoName($video_name) {
        $this->video_name = $video_name;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
}
?>