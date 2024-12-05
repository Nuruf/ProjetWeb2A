<?php

class historique{
    private $idhistorique;
    private $idquiz;
    private $titre;
    private $description;
    private $note;
    private $date_validation;
 
    
     
public function __construct($idquiz,$titre,$description,$note,$date_validation)
{
    
    $this->idquiz=$idquiz;
    $this->titre=$titre;
    $this->description=$description;
    $this->note=$note;
    $this->date_validation=$date_validation;

}
public function setIdquiz($idquiz){
     $this->idquiz=$idquiz;
}

public function getIdquiz(){
     return $this->idquiz;
}
public function setTitre($titre){
    $this->titre=$titre;
}

public function getTitre(){
    return $this->titre;
}
public function setDescription($description){
    $this->description=$description;
}

public function getDescription(){
    return $this->description;
}


public function setnote($note){
    $this->note=$note;
}

public function getnote(){
    return $this->note;
}


public function setDValidation($date_validation){
    $this->date_validation=$date_validation;
}

public function getDValidation(){
    return $this->date_validation;
}


}


?>