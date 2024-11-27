<?php
class User {
  
    private $Email;
    private $MotDePasse;
    private $Telephone;
    private $Utilisateur;
    private $Role;
    

/*
    public function __construct($name, $email, $phone, $role) {
        $this->Utilisateur = $name;
        $this->Email = $email;
        $this->Telephone= $phone;
        $this->Role = $role;
    }
    */
    public function __construct($name, $email,$password, $phone, $role) {
        $this->Utilisateur = $name;
        $this->Email = $email;
        $this->MotDePasse=$password ;

        $this->Telephone= $phone;
        $this->Role = $role;
    }
    public function getId() {
        return $this->Id;
    }
    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function getEmail() {
        return $this->Email;
    }

  
    public function setMotDePasse($MotDePasse) {
        $this->MotDePasse = $MotDePasse;
    }

    public function getMotDePasse() {
        return $this->MotDePasse;
    }


    public function setTelephone($Telephone) {
        $this->Telephone = $Telephone;
    }

    public function getTelephone() {
        return $this->Telephone;
    }

    public function setUtilisateur($Utilisateur) {
        $this->Utilisateur = $Utilisateur;
    }

    public function getUtilisateur() {
        return $this->Utilisateur;
    }


    public function setRole($Role) {
        $this->Role = $Role;
    }

    public function getRole() {
        return $this->Role;
    }
}
?>
