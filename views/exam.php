<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Examen</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
 	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/timer.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<div class="wrapper">
	<div id="header">
		<h1>Examen</h1>
		<div id="timer"><h1><span id="num-min">20</span> min <span id="num-sec">0</span> seg</h1></div>
	</div>
	<div id="content">
		<form action="exam.php" method="POST" id="save-exam">
		<?php foreach ($data['questions'] as $i => $preg) { ?>
		<div class="preg">
			<p>Pregunta N° <?php echo ($i+1); ?></p>
			<p><?php echo $preg['description']; ?></p>
			<div class="answers">
		<?php	if($preg['typequestion']==1){ 
					$type="radio";
				}else{ 
					$type="checkbox";
				}
				foreach ($data['answers'][$i] as $k => $answer) { ?>
				<input type="<?php echo $type; ?>" class="preg-<?php echo ($i+1); ?>" name="preg-<?php echo ($i+1); ?>" value="<?php echo $answer['correct']; ?>"><?php echo $answer['description']; ?>
		<?php	} ?>
			</div>
		</div>
		<?php } ?>
		<div class="controls"><input type="submit" id="finish" value="Finalizar examen"></div>
		</form>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>