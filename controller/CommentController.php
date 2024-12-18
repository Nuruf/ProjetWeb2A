<?php
require_once '../../config/DbConfig.php';
require_once '../../Model/Comment.php';

class CommentController {
    private $commentModel;

    public function __construct() {
        $dbConfig = new DbConfig();
        $this->commentModel = new Comment($dbConfig->getConnection());
    }

    public function create($post_id, $user_id, $comment) {
        $this->commentModel->setPostId($post_id);
        $this->commentModel->setUserId($user_id);
        $this->commentModel->setComment($comment);
        $this->commentModel->create();
    }

    public function read($id) {
        return $this->commentModel->read($id);
    }

    public function update($id, $comment) {
        $this->commentModel->setId($id);
        $this->commentModel->setComment($comment);
        return $this->commentModel->update();
    }

    public function delete($id) {
        return $this->commentModel->delete($id);
    }

    public function getByPostId($post_id) {
        return $this->commentModel->getByPostId($post_id);
    }
}
?>