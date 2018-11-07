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
	
	if(isset($_POST["startButton"])){
	
	?>
		<table class="questionTable">
			<tr><td><button type="button" class="btn btn-info" name="nextButton">Next</button></td></tr>
		</table>
	<?php 
		}else{
	
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