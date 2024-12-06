<?php
class Comment {
    private $id;
    private $postId;
    private $comment;

    public function __construct($id, $postId, $comment) {
        $this->id = $id;
        $this->postId = $postId;
        $this->comment = $comment;
    }

    // Getter for ID
    public function getId() {
        return $this->id;
    }

    // Getter and Setter for Post ID
    public function getPostId() {
        return $this->postId;
    }

    public function setPostId($postId) {
        $this->postId = $postId;
    }

    // Getter and Setter for Comment
    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }
}
?>
