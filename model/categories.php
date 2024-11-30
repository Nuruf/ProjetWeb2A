<?php
class category{
 private ?int $idCat;
 private ?string $nomCat;
 private ?string $descriptionCat;

 public function __construct($idCat=null, $nomCat=null,$descriptionCat=null){
    $this->idCat=$idCat;
    $this->nomCat=$nomCat;
    $this->descriptionCat=$descriptionCat;
 }

 //getters
 public function getIdCat(){
    return $this->idCat;
 }
 public function getNomCat(){
    return $this->nomCat;
 }
 public function getDescriptioncat(){
    return $this->descriptionCat;
 }


 //setters
 public function setIdCat($idCat){
    $this->idCat=$idCat;
 }
 public function setNomCat($nomCat){
    $this->nomCat=$nomCat;
 }
 public function setDescriptioncat($descriptionCat){
    $this->descriptionCat=$descriptionCat;
 }

}
?>