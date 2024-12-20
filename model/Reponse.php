<?php
class Reponse {
    private $id_reponse;
    private $contenu;
    private $date_reponse;
    private $id_reclamation; // Foreign key

    // Constructor
    public function __construct($contenu, $date_reponse, $id_reclamation, $id_reponse = null) {
        $this->id_reponse = $id_reponse;
        $this->contenu = $contenu;
        $this->date_reponse = $date_reponse;
        $this->id_reclamation = $id_reclamation;
    }

    // Getters
    public function getIdReponse() {
        return $this->id_reponse;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function getDateReponse() {
        return $this->date_reponse;
    }

    public function getIdReclamation() {
        return $this->id_reclamation;
    }

    // Setters
    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function setDateReponse($date_reponse) {
        $this->date_reponse = $date_reponse;
    }

    public function setIdReclamation($id_reclamation) {
        $this->id_reclamation = $id_reclamation;
    }
}
?>
