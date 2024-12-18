<?php

require_once '../../config/DbConfig.php';

class Post {
    private $pdo;
    private $id;
    private $title;
    private $content;
    private $video_name;
    private $created_at;

    public function __construct($title = null, $content = null, $video_name = null, $created_at = null, $id = null) {
        $dbConfig = new DbConfig();
        $this->pdo = $dbConfig->getConnection();
        $this->title = $title;
        $this->content = $content;
        $this->video_name = $video_name;
        $this->created_at = $created_at;
        $this->id = $id;
    }

    public function create() {
        $stmt = $this->pdo->prepare("INSERT INTO posts (title, content, video_name, created_at) VALUES (:title, :content, :video_name, :created_at)");
        return $stmt->execute([
            'title' => $this->title,
            'content' => $this->content,
            'video_name' => $this->video_name,
            'created_at' => $this->created_at ?: date('Y-m-d H:i:s') 
        ]);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
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
    $stmt = $this->pdo->prepare("UPDATE posts SET title = :title, content = :content, video_name = :video_name WHERE id = :id");
    return $stmt->execute([
        'title' => $this->title,
        'content' => $this->content,
        'video_name' => $this->video_name,
        'id' => $this->id
    ]);
}
public function delete($id) {
    $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM posts");
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