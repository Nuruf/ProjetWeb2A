<?php
class Reclamation {
    private $id;
    private $userId;
    private $description;
    private $status;
    private $date;

    public function __construct($id, $userId, $description, $status = "open", $date = null) {
        $this->id = $id;
        $this->userId = $userId;
        $this->description = $description;
        $this->status = $status ?: "open"; // Default to "open" if null
        $this->date = $date ?: date("Y-m-d"); // Default to current date if null
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getDate() {
        return $this->date;
    }
}


?>
