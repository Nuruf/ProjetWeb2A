<?php
class category{
 private ?int $idCat;
 private ?string $nomCat;
 private ?string $descriptionCat;
 private ?string $imageCat;

 public function __construct($idCat, $nomCat,$descriptionCat, $imageCat){
    $this->idCat=$idCat;
    $this->nomCat=$nomCat;
    $this->descriptionCat=$descriptionCat;
    $this->imageCat=$imageCat;
 }

 //getters
 public function getIdCat(){
    return $this->idCat=$idCat;
 }
 public function getNomCat(){
    return $this->nomCat=$nomCat;
 }
 public function getDescriptioncat(){
    return $this->descriptionCat=$descriptionCat;
 }
 public function getImageCat(){
    return $this->imageCat=$imageCat;
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
 public function setImageCat($imageCat){
    $this->imageCat=$imageCat;
 }
}
?>