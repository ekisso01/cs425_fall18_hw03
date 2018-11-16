<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">

	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Kissopoda Elena">
	<meta name="description" content="In Home page the user can play the quiz game, and choose if he wants to save his score or not and return to the start">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="keywords" content="CS425, HTML, Quiz game, question game">
		
	<!-- Add icon library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Content' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="css/header_footer.css">
    <link rel="stylesheet" type="text/css" href="css/homePage.css">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="icon" href="images/game_icon.png" type="image/png">
	</head>


	<body>
	
	<a name="top"></a>
	
	<div class="navigationbar sticky">
  		<a class="active" href="index.php">Home</a>
  		<a href="help.php">Help</a>
  		<a href="scores.php">High Scores</a>
	</div>


	
	
	<?php
	if(isset($_POST["nextButton"])){
		$_SESSION["questioncount"]=$_SESSION["questioncount"]+1;
	 }
	 else if(isset($_POST["startButton"]) or isset($_POST["returnButton"]) ) {
		$_SESSION["questioncount"]=1;
		$_SESSION["score"]=0;
		$_SESSION["fanswers"]=array();
		$_SESSION["fquestions"]=array();
		$_SESSION["flevels"]=array();
	 }
	
	if((isset($_POST["startButton"]) or isset($_POST["nextButton"])) and $_SESSION["questioncount"]<6){
	 
	 
	?>
	<!-- to be tranfered to the page of the actual game -->
	<form method="post" class="QuestionForm">
	   <div>
           <label name="numQuestions" id="numQuestions"><?= $_SESSION["questioncount"]."/5" ?> </label>
	   
	   <button type="submit" class="close" aria-label="Close" name="closeButton">
  		<span aria-hidden="true">&times;</span>
	   </button><br><br><br>
	   </div>
	   <?php
			
			if (file_exists('xml/questionsXML.xml')) {
			$xml = simplexml_load_file('xml/questionsXML.xml');
			if ($_SESSION["questioncount"] == 1){
				$level=" M ";
			}
			else if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) == 0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level, " E ")==0){
				
				$level=" M ";
				$_SESSION["score"]=$_SESSION["score"]+5;
				array_push($_SESSION["fanswers"],"Correct");
							
			}
			else if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) != 0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level, " E ")==0){
				
				$level=" E ";
				$_SESSION["score"]=$_SESSION["score"]+0;
				array_push($_SESSION["fanswers"],"Incorrect");
			}
			else if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) == 0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level, " M ")==0){
				
				$level=" D ";
				$_SESSION["score"]=$_SESSION["score"]+10;
				array_push($_SESSION["fanswers"],"Correct");
			}
			else if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) != 0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level, " M ")==0){
				
				$level=" E ";
				$_SESSION["score"]=$_SESSION["score"]+0;
				array_push($_SESSION["fanswers"],"Incorrect");
			}
			else if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) == 0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level, " D ")==0){
				
				$level=" D ";
				$_SESSION["score"]=$_SESSION["score"]+20;
				array_push($_SESSION["fanswers"],"Correct");
			}
			else if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) !=0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level , " D ")==0){	
				
				$level=" M ";
				$_SESSION["score"]=$_SESSION["score"]+0;
				array_push($_SESSION["fanswers"],"Incorrect");
			}
				
			$i=rand(0,80);
			while ($xml->item[$i]->level != $level or in_array($xml->item[$i]->question, $_SESSION["fquestions"])){
				$i=rand(0,80);
				
			}
			$_SESSION["prevQuestion"]=$i;
			array_push($_SESSION["fquestions"],(string) $xml->item[$i]->question);
			array_push($_SESSION["flevels"],(string) $xml->item[$i]->level);
		?>
	   <label for="question" id="questionlbl">
	   <?php 
	   echo $xml->item[$i]->question. "<br>";
	   ?> </label><br>
	   <table class="answersTable">
		<tr><td>
		<input type="radio" name="answers" id="ansA" value="<?php echo $xml->item[$i]->answer[0]; ?>" checked="checked">
		<label for="ansA">
		<?php 
		echo $xml->item[$i]->answer[0];
		?></label>
		</td>
		<td>
		<input type="radio" name="answers" id="ansB" value="<?php echo $xml->item[$i]->answer[1]; ?>">
		<label for="ansB">
		<?php 
		echo $xml->item[$i]->answer[1]; 
		?> </label>
		</td>
		</tr>
		<tr><td>
		<input type="radio" name="answers" id="ansC" value="<?php echo $xml->item[$i]->answer[2]; ?>">
		<label for="ansC"> 
		<?php 
		echo $xml->item[$i]->answer[2]; 
		?></label>
		</td>
		<td>
		<input type="radio" name="answers" id="ansD" value="<?php echo $xml->item[$i]->answer[3]; ?>">
		<label for="ansD">
		<?php 
		echo $xml->item[$i]->answer[3]; 
		?></label>
		</td>
		</tr>
	   </table>
	   
		<div id="nextBtn">
		
		<button type="submit" class="btn btn-info" name="nextButton">
		<!-- To check if the button should say next or finish -->
		<?php
			if($_SESSION["questioncount"]==5){
		?>
		Finish
		<?php
			}else{
		?>
		Next
		<?php
			}
		?>
		</button>
		<?php
			
			
			}else {
				exit('Failed to open test.xml.');
			}
		
	
		?>
		</div>
	</form>
	


	<!--to be tranfered to the start page -->
	<?php 
		
	}else if (isset($_POST["returnButton"]) or isset($_POST["closeButton"]) or !isset($_SESSION["questioncount"]) or $_SERVER['REQUEST_METHOD'] === 'GET'){
		session_unset();
	?>
	<div class="mainContent">
	<div class="mainHeader">
		<h1>Welcome, are you ready to play? </h1>
	</div>
	
	<form  method="post" class="mainPageForm">
		<button type="submit" class="btn btn-success" name="startButton">Start</button>
	</form>
	</div>
	

	
	<?php 
		
	

	}else if($_SESSION["questioncount"]>5){

			$xml = simplexml_load_file('xml/questionsXML.xml');

			if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) == 0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level, " E ")==0){
				
				$_SESSION["score"]=$_SESSION["score"]+5;
				array_push($_SESSION["fanswers"],"Correct");
				
			}
			else if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) != 0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level, " E ")==0){
				
				$_SESSION["score"]=$_SESSION["score"]+0;
				array_push($_SESSION["fanswers"],"Incorrect");
			}
			else if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) == 0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level, " M ")==0){
				
				$_SESSION["score"]=$_SESSION["score"]+10;
				array_push($_SESSION["fanswers"],"Correct");
			}
			else if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) != 0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level, " M ")==0){
				
				$_SESSION["score"]=$_SESSION["score"]+0;
				array_push($_SESSION["fanswers"],"Incorrect");
			}
			else if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) == 0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level, " D ")==0){
				
				$_SESSION["score"]=$_SESSION["score"]+20;
				array_push($_SESSION["fanswers"],"Correct");
			}
			else if (strcmp($_POST["answers"],$xml->item[$_SESSION["prevQuestion"]]->correct) !=0 and strcmp($xml->item[$_SESSION["prevQuestion"]]->level , " D ")==0){	
				
				$_SESSION["score"]=$_SESSION["score"]+0;
				array_push($_SESSION["fanswers"],"Incorrect");
			}

			


	?>
	<form class="quizScoreForm" method="post">
	  
	  <div class="row">
			<div class="col-25">
				<label>Your score :</label>
			</div>
		<div class="col-75">
			<label id="generallbl"><?php echo $_SESSION["score"] ?></label>
		</div>
		</div>
		<br>
	  <div class="row">
			<div class="col-25">
				<label>Nickname :</label>
			</div>
	  	<div class="col-75">
			<input type="text" name="nickname" id="generaltxt" placeholder=" Your nickname.." maxlength="15" autofocus>
		</div>
		</div>
		<br>
	<div class="row">
		<?php 	
			for($j=0; $j<sizeof($_SESSION["fquestions"]); $j++ ){ 
		echo "<div class=\"{$_SESSION["fanswers"][$j]}\">";
		?>
		<div class="col-25">
				<?php 
					if (strcmp($_SESSION["fanswers"][$j],"Incorrect")==0){
						$x=" (+0)";

					}else if(strcmp($_SESSION["flevels"][$j]," E ")==0){
						$x=" (+5)";
					}else if(strcmp($_SESSION["flevels"][$j]," M ")==0){
						$x=" (+10)";
					}else if(strcmp($_SESSION["flevels"][$j]," D ")==0){
						$x=" (+20)";
					}
				?>
				<label class="finals"><?php echo $_SESSION["flevels"][$j] . $x; ?></label>
		</div>
		<div class="col-75">
				<label class="finalQuestions"><?php echo $_SESSION["fquestions"][$j]; ?></label>
		</div>
		</div>
		<br>
		<?php
		    
		      }
			
		?>

		
	</div>
	<div class="row">
			<div class="col-75">
				<button type="submit" class="btn btn-info" name="SaveButton" id="savebtn">Save your score</button>
			</div>
		</div>
		
	<div class="row">
			
		<div class="col-75">
			<button type="submit" class="btn btn-info" name="returnButton" id="returnbtn">Return</button>
		</div>
		</div>
	
	<!-- to be transfer to the page of the current score --> 
	<?php
		

	if (isset($_POST["SaveButton"])){
		$nickname=$_REQUEST["nickname"];
		$score=$_SESSION["score"];
		$stringData=$nickname ." ". $score ."\r\n";

		if (strcmp($nickname,"") !=0){
		 $myFile = "scoresFile.txt";
		 $temp = fopen($myFile, 'a') or die("Can't open file") ;

		 if (fwrite($temp,$stringData)){
		 	fclose($temp);
			?>
			<div class="alert alert-success" role="alert">
  			Succesfully saved your score!
			</div>
			<meta http-equiv="refresh" content="2;url=https://www.cs.ucy.ac.cy/~ekisso01/cs425_fall18_hw03/index.php" />
		<?php
		 }
		 else{ 
		  ?>
			<div class="alert alert-danger" role="alert">
  			Error while saving your score!
			</div>
		<?php
		 }
		}else{
			?>
			<div class="alert alert-danger" role="alert">
  			You must write a nickname!
			</div>
		<?php
		}    
	}
	}
		
			
	?>

	</form>

	<div class="backToTop stickyDown">
		<a href="#top">Top</a>
	</div>

	<footer>

	<div class="mediaIcons">
	<!-- Add font awesome icons -->
		<p>Follow us: </p>
		<a href="#" class="fa fa-facebook"></a>
		<a href="#" class="fa fa-twitter"></a>
		<a href="#" class="fa fa-instagram"></a>
		
	</div>
	
	
	</footer>

</body>
</html>