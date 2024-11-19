<?php

class Reponses{
    private $id_reponse;
    private $id_question;
    private $reponse_text;
    private $is_correct;
 
    
     
public function __construct($id_question,$reponse_text,$is_correct)
{
    
    $this->id_question=$id_question;
    $this->reponse_text=$reponse_text;
    $this->is_correct=$is_correct;

}
public function setIdreponse($id_reponse){
     $this->id_reponse=$id_reponse;
}

public function getIdreponse(){
     return $this->id_reponse;
}
public function setidquestion($id_question){
    $this->id_question=$id_question;
}

public function getidquestion(){
    return $this->id_question;
}
public function setreponse($reponse_text){
    $this->reponse_text=$reponse_text;
}

public function getreponse(){
    return $this->reponse_text;
}

public function setcorrect($is_correct){
    $this->is_correct=$is_correct;
}

public function getcorrect(){
    return $this->is_correct;
}

}


?>