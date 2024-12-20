<?php

class historique {
    private $idhistorique;
    private $idquiz;
    private $titre;
    private $description;
    private $note;
    private $date_validation;
    private $id_user;  // Ajout de l'attribut id_user
    
    // Mise à jour du constructeur pour inclure id_user
    public function __construct($idquiz, $titre, $description, $note, $date_validation, $id_user) {
        $this->idquiz = $idquiz;
        $this->titre = $titre;
        $this->description = $description;
        $this->note = $note;
        $this->date_validation = $date_validation;
        $this->id_user = $id_user;  // Initialisation de id_user
    }
    
   

    public function setIdquiz($idquiz) {
        $this->idquiz = $idquiz;
    }

    public function getIdquiz() {
        return $this->idquiz;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function getNote() {
        return $this->note;
    }

    public function setDValidation($date_validation) {
        $this->date_validation = $date_validation;
    }

    public function getDValidation() {
        return $this->date_validation;
    }

   

    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    public function getIdUser() {
        return $this->id_user;
    }
}

?>
