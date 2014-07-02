<?php
	include("models/functions.php");
	$test = new Examen();

	if(isset($_POST['username']) && isset($_POST['password'])){
		$result=$test->loginUser($test->clean($_POST['username']),$test->clean($_POST['password']));
		if($result==0){
			header("Location: exam.php");	
		}else{
			$data=$test->getQuestions(1);
			$content="exam.php";
		} 
	}else{ 
		$content="login.php";
	} 
	
	include("views/".$content);
?>