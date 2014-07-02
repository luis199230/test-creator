<?php 	
	if(isset($_POST['npreguntasc']) && isset($_POST['npreguntass']) && isset($_POST['opt-preg'])){
		include("models/functions.php");
		
		$nexamen=($_POST['nexamen']!='')?$_POST['nexamen']:'EXAMEN FINAL DEL CURSO DE MATEMATICA DISCRETA';
		$npreguntass=$_POST['npreguntass'];
		$npreguntasc=$_POST['npreguntasc'];
		$optpreg=$_POST['opt-preg'];
		$pregs=$_POST['preg'];
		$answers=array();
		$roptpreg=array();
		for($i=0;$i<$npreguntasc;$i++){ 
			$answers[$i]=array();
			$answers[$i]=array_merge($answers[$i],$_POST['answer'.($i+1)]);
			$roptpreg[$i]=array();
			for($j=0; $j<$optpreg[$i]*2; $j++){
				$roptpreg[$i][$j]=0;
			}
			foreach($_POST['ropt'.($i+1)] as $rpta){				
				for($k=0; $k<$optpreg[$i]*2; $k++){
					if($rpta==($k+1)){
						$roptpreg[$i][$k]=1;
					}
				}
			}
		}
		
		$test = new Examen();
		$result=$test->createQuiz($nexamen,$npreguntasc,$npreguntass,$optpreg,$roptpreg,$pregs,$answers);
		echo "<div id='exito'>".$result."</div>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Generador de Exámenes</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
 	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body id="teacher">
	<div id="header">
		<h1>Generador de Preguntas para Exámenes</h1>
	</div>
	<div id="content">
		<form action="index.php" method="POST" id="questions-answers">
			<div class="exam">
				<p>Elija el nombre del exámen
				<input type="text" name="nexamen" size="60" id="nexamen" placeholder="EXAMEN FINAL DEL CURSO DE MATEMATICA DISCRETA"></p>
				<p>Ingrese el número de preguntas a ingresar<input type="number" name="npreguntasc" id="npreguntasc"></p>
				<p>Ingrese el número de preguntas a mostrar en el examen<input type="number" name="npreguntass" id="npreguntass"></p>
				
				<button type="button" id="showpreguntas">Crear examen</button>
			</div>
			<div class="preguntas">
			</div>
			<div class="save"><input type="submit" id="save" value="Guardar preguntas y examen" disabled="disabled"></div>
		</form>
	</div>
	<div id="footer"></div>
</body>
</html>