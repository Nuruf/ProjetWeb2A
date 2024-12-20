<?php
require_once __DIR__ . '/../conf.php';
require_once __DIR__ . '/../model/Commentss.php';

class CommenttController {
    private $commentModel;

    public function __construct() {
        $DatabaseConfig = new DatabaseConfig();
        $this->commentModel = new Commentt($DatabaseConfig->getConnexion());
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