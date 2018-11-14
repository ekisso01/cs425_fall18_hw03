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
 <link rel="stylesheet" type="text/css" href="css/scorePage.css">
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>


<body>
 <a name="top"></a>
	
 <div class="navigationbar sticky">
  <a class="active" href="index.php">Home</a>
  <a href="help.php">Help</a>
  <a href="scores.php">High Scores</a>
 </div>


<form class="scoresForm">

<?php
 $fileInput=array();
 $temp=array();

 $temp=file("scoresFile.txt",FILE_IGNORE_NEW_LINES);
 
 
 
 for($i=0; $i<sizeof($temp); $i++){

  array_push($fileInput,explode(" ",$temp[$i]));
 }


 function cmp($a, $b) {
    if ($a[1] == $b[1]) {
        return 0;
    }
    if ($a[1] > $b[1]){
	return -1;
    }else{
	return 1;
    }
 }


 usort($fileInput,"cmp");

 
 
 $rows=10;
?>
 <h1 class="scoreHeader">Top 10</h1>
<?php 
 for($i=0;$i<$rows; $i++){
  $cols=count($fileInput[$i]);
 ?>
  <div class="row">
  <label class="res"><?php echo $i+1; ?></label>
<?php
  
  for($j=0;$j<$cols; $j++){
?>

 	<label class="res"><?php echo $fileInput[$i][$j]; ?></label>
 
<?php
 }
?>
</div>
<?php
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