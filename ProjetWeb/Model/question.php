<?php

class Questions{
    private $id_question;
    private$idquiz;
    private $question_text;
    private $points;

 
    
     
public function __construct($idquiz,$question_text,$points)
{
    
    $this->idquiz=$idquiz;
    $this->question_text=$question_text;
    $this->points=$points;


}
public function setIdquestion($id_question){
     $this->id_question=$id_question;
}

public function getIdquestion(){
     return $this->id_question;
}

public function setIdquiz1($idquiz){
    $this->idquiz=$idquiz;
}

public function getIdquiz1(){
    return $this->idquiz;
}

public function setquestion($question_text){
    $this->question_text=$question_text;
}

public function getquestion(){
    return $this->question_text;
}
public function setPoints($points){
    $this->points=$points;
}

public function getPoints(){
    return $this->points;
}

}


?>