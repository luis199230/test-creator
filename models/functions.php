<?php 
	include("database.php");
	
	Class Examen{
		private $conex;
		public $preguntas;

		public function __construct(){
			$this->conex = Database::get_instance()->conectar();
			$this->preguntas = array();
		}

		function createQuiz($nexamen,$npreguntasc,$npreguntass,$optpreg,$roptpreg,$pregs,$answers){
			$query = "INSERT INTO exam (name,showpreg) VALUES ('".$nexamen."','".$npreguntass."')";
			$result = mysql_query($query);
			$query5 = "SELECT idexam FROM exam WHERE name='".$nexamen."' AND showpreg='".$npreguntass."'";
			$result5 = mysql_fetch_array(mysql_query($query5));			
				
			$cad = "Se guardo correctamente...";
			foreach($pregs as $key=>$preg){
				$query2 = "INSERT INTO question (description,typequestion) VALUES ('".$preg."','".$optpreg[$key]."')";
				$result2 = mysql_query($query2);
				$query3 = "SELECT idquestion FROM question WHERE description='".$preg."' AND typequestion='".$optpreg[$key]."'";
				$result3 = mysql_fetch_array(mysql_query($query3));			
				for($i=0;$i<$optpreg[$key]*2;$i++){
					$query4 = "INSERT INTO answer (description, correct,question_idquestion) VALUES ('".$answers[$key][$i]."','".$roptpreg[$key][$i]."','".$result3[0]."')";
					$result4 = mysql_query($query4);
					$query6 = "INSERT INTO exam_has_question (exam_idexam, question_idquestion) VALUES ('".$result5[0]."','".$result3[0]."')";
					$result6 = mysql_query($query6);
				}
			}
			return $cad;
		}

		function loginUser($user,$pass){
			$query = "SELECT count(*) FROM user WHERE username='".$user."' AND password='".$pass."'";
			$result = mysql_query($query);			
			return $result;
		}

		function clean($string){
			$string = str_replace('á', 'a', $string); // Replaces all spaces with hyphens.
			$string = str_replace('é', 'e', $string); // Replaces all spaces with hyphens.
			$string = str_replace('í', 'i', $string); // Replaces all spaces with hyphens.			
			$string = str_replace('ó', 'o', $string); // Replaces all spaces with hyphens.
			$string = str_replace('ú', 'u', $string); // Replaces all spaces with hyphens.
			return preg_replace('/[^A-Za-z0-9 Ññ\-]/', '', $string); // Removes special chars.
		}


		function getQuestions($examid){
			$query = "SELECT * FROM exam WHERE idexam='".$examid."'";
			$result = mysql_fetch_row(mysql_query($query));
			
			$where = " WHERE e.exam_idexam='".$examid."' ORDER BY RAND() LIMIT 0,".$result[2];
			$query2 = "SELECT * FROM question q INNER JOIN exam_has_question e ON q.idquestion=e.question_idquestion".$where;
			$result2 = mysql_query($query2);
			
			$rows=array();
			$answers=array();
			while($fila = mysql_fetch_array($result2)){
			    $rows[]= $fila;
			    $query3 = "SELECT * FROM answer WHERE question_idquestion=".$fila['idquestion'];
				$result3 = mysql_query($query3);
				$answer=array();
				while($fila2 = mysql_fetch_array($result3)){
					$answer[]=$fila2;
				}
				$answers[]=$answer;
			}
			$resultf=array('exam'=>$result,'questions'=>$rows,'answers'=>$answers);
			return $resultf;
		}

	}
 ?>