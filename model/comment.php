<?php 
class Comment {
    private $id;
    private $postId;
    private $comment;

    private static $badWords = [
        'badword1',
        'badword2'
        
    ];

    public function __construct($id, $postId, $comment) {
        $this->id = $id;
        $this->postId = $postId;
        $this->setComment($comment); // Validate and set comment
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
        if ($this->containsBadWords($comment)) {
            throw new Exception("Comment contains inappropriate language");
        }
        $this->comment = $comment;
    }

    private function containsBadWords($text) {
        $text = strtolower($text);
        foreach (self::$badWords as $badWord) {
            if (strpos($text, strtolower($badWord)) !== false) {
                return true;
            }
        }
        return false;
    }
}
?>