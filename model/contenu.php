<?php
class contenu{
 private ?int $idContenu;
 private ?string $descriptionContenu;
 private ?string $nomContenu;
 //private string $idCat;

 public function __construct($idContenu,$nomContenu,$descriptionContenu){
    $this->idContenu=$idContenu;
    $this->nomContenu=$nomContenu;
    $this->descriptionContenu=$descriptionContenu;
    //$this->idCat=$idCat;
 }


 public function getIdContenu(){
  return $this->idContenu;
 }

 public function setIdContenu($idContenu){
  $this->idContenu = $idContenu;
 }

 public function getNomContenu(){
    return $this->nomContenu;
   }
  
 public function setNomContenu($nomContenu){
    $this->nomContenu = $nomContenu;
 }

 public function getDescriptionContenu(){
  return $this->descriptionContenu;
 }

 public function setDescriptionContenu($descriptionContenu){
  $this->descriptionContenu = $descriptionContenu;
 }

/* public function getIdCat(){
    return $this->idCat;
   }
  
 public function setIdCat($idCat){
    $this->idCat = $idCat;
 }*/
}
?>