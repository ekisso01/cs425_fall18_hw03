<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">

	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Kissopoda Elena">
	<meta name="description" content="Home Page">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="keywords" content="CS425, HTML, Quiz game, question game">
		
	<!-- Add icon library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Content' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="css/header_footer.css">
    <link rel="stylesheet" type="text/css" href="css/homePage.css">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
	 }
	
	if((isset($_POST["startButton"]) or isset($_POST["nextButton"])) and $_SESSION["questioncount"]<11){
	 
	 
	?>
	<!-- to be tranfered to the page of the actual game -->
	<form method="post" class="QuestionForm">
	   <div>
           <label name="numQuestions" id="numQuestions"><?= $_SESSION["questioncount"]."/10" ?> </label>
	   
	   <button type="submit" class="close" aria-label="Close" name="closeButton">
  		<span aria-hidden="true">&times;</span>
	   </button><br><br><br>
	   </div>
	   <?php
			if (file_exists('xml/questionsXML.xml')) {
			$xml = simplexml_load_file('xml/questionsXML.xml');
			
		?>
	   <label for="question" id="questionlbl">
	   <?php 
	   echo $xml->item[0]->question. "<br>";
	   ?> </label><br>
	   <table class="answersTable">
		<tr><td>
		<input type="radio" name="answers" id="ansA" value="A">
		<label for="ansA">
		<?php 
		echo $xml->item[0]->answer[0]; 
		?> </label>
		</td>
		<td>
		<input type="radio" name="answers" id="ansB" value="B">
		<label for="ansB">
		<?php 
		echo $xml->item[0]->answer[1]; 
		?> </label>
		</td>
		</tr>
		<tr><td>
		<input type="radio" name="answers" id="ansC" value="C">
		<label for="ansC"> 
		<?php 
		echo $xml->item[0]->answer[2]; 
		?></label>
		</td>
		<td>
		<input type="radio" name="answers" id="ansD" value="D">
		<label for="ansD">
		<?php 
		echo $xml->item[0]->answer[3]; 
			
			?></label>
		</td>
		</tr>
	   </table>
	   
		<div id="nextBtn">
		
		<button type="submit" class="btn btn-info" name="nextButton">
		<!-- To check if the button should say next or finish -->
		<?php
			if($_SESSION["questioncount"]==10){
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
	
	<!-- to be transfer to the page of the current score --> 
	<?php 
		}else if($_SESSION["questioncount"]>10){

	?>
	<form class="quizScoreForm" method="post">
	  
	  

	  <table class="buttons">
		<tr><td>
		<label id="generallbl">Your score :</label>
		</td>
		<td>
		<input type="text" name="score" id="generaltxt">
		</td>
		<tr><td>
		<label id="generallbl">Nickname :</label>
		</td>
		<td>
		<input type="text" name="nickname" id="generaltxt" placeholder=" Your nickname..">
		</td>
		</tr>
		<tr><td>
		<button type="submit" class="btn btn-info" name="SaveButton" id="savebtn">Save your score</button>
		</td>
		<td>
		<button type="submit" class="btn btn-info" name="returnButton" id="returnbtn">Return</button>
		</td>
		</tr>
	  </table>
	</form>
	<!--to be tranfered to the start page -->
	<?php 
		
	}else if (isset($_POST["returnButton"]) or isset($_POST["closeButton"]) or !isset($_SESSION["questioncount"])){
	
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
		}
	?>

	
	


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