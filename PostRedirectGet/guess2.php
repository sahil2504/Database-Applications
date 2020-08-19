<?php
    session_start();
    if(isset($_POST["guess"]))
    {
    	$guess = $_POST["guess"] + 0;
    	$_SESSION["guess"] = $guess;
    	if($guess<42)
    	{
    		$_SESSION["$message"] = "too low";
    	}
    	else if($guess>42)
    	{
    		$_SESSION["$message"] = "too high";
    	}
    	else
    		$_SESSION["$message"] = "Great Job";
    	header("Location: guess2.php");
    	return;
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>POST REDIRECT GET</title>
</head>
<body>
	<h2>Welcome to the guessing game</h2>
	<p>Correct way to implement POST method</p>
	<?php
	    $guess = isset($_SESSION["guess"]) ? $_SESSION["guess"] : "";
	    $message = isset($_SESSION["mesaage"]) ? $_SESSION["message"] : false;
	?>
	<?php
	    if($message !== false)
	    {
	    	echo("<p>$message</p>\n");
	    }
	?>
	<form method="POST">
		<label for="guess">Enter Guess:<input type="text" name="guess" id="guess"
			<?php
			    echo 'value= "' .htmlentities($guess). '"';
			?>></label>
			<input type="submit" name="SUBMIT">
	</form>
</body>
</html>