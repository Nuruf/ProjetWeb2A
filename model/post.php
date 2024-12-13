<?php
class Post {
    private $id;
    private $title;
    private $content;
    private $likes;     // New property for likes
    private $dislikes;  // New property for dislikes

    public function __construct($id, $title, $content, $likes = 0, $dislikes = 0) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
    }

    // Getter and Setter for ID
    public function getId() {
        return $this->id;
    }

    // Getter and Setter for Title
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    // Getter and Setter for Content
    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    // Getter and Setter for Likes
    public function getLikes() {
        return $this->likes;
    }

    public function setLikes($likes) {
        $this->likes = $likes;
    }

    public function incrementLikes() {
        $this->likes++;
    }

    // Getter and Setter for Dislikes
    public function getDislikes() {
        return $this->dislikes;
    }

    public function setDislikes($dislikes) {
        $this->dislikes = $dislikes;
    }

    public function incrementDislikes() {
        $this->dislikes++;
    }
}
?>
