<?php
include '../../model/quiz.php';
include '../../controller/QuizController.php';

if(!empty($_POST['test_name'])&&!empty($_POST['description'])){
$quiz1=new quiz($_POST['test_name'],$_POST['description']);
$num_questions=$_POST['num_questions'];
$quizC = new QuizController();

$quiz_id =$quizC->addquiz($quiz1);}

$current_question=0;
header('Location:FORMULAIRE3.php?quiz_id=' . $quiz_id . '&num_questions=' . $num_questions . '&i=' . $current_question . '#quiz');

?>                                                                                          