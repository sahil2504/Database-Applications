<?php
    $guess = "";
    $message = false;
    if(isset($_POST["guess"]))
    {
    	$guess = $_POST["guess"] + 0;
    	if($guess<42)
    	{
    		$message = "too low";
    	}
    	else if($guess>42)
    	{
    		$message = "too high";
    	}
    	else
    		$message = "Great Job";
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
	<p>Wrong way to implement POST method</p>
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