<?php

class quiz{
    private $idquiz;
    private $nomQuiz;
    private $description;
 
    
     
public function __construct($nomQuiz,$description)
{
    
    $this->nomQuiz=$nomQuiz;
    $this->description=$description;

}
public function setIdquiz($idquiz){
     $this->idquiz=$idquiz;
}

public function getIdquiz(){
     return $this->idquiz;
}
public function setnomQ($nomQuiz){
    $this->nomQuiz=$nomQuiz;
}

public function getnomQ(){
    return $this->nomQuiz;
}
public function setDescription($description){
    $this->description=$description;
}

public function getDescription(){
    return $this->description;
}

}


?>