<?php
    session_start();
    if(isset($_POST["account"]) && isset($_POST["pw"]))
    {
    	unset($_SESSION["account"]); //logout existing user
    	if($_POST["pw"] == "hello")
    	{
    		$_SESSION["account"] = $_POST["account"];
    		$_SESSION["success"] = "Logged in";
    		header( 'Location: app.php' ) ;
            return;
    	}
    	else
    	{
    		$_SESSION["error"] = "Incorrect Password";
    		header("Location: login.php");
    		return;
    	}
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
</head>
<body>
	<style type="text/css">
		#name,#pswd{
			margin: 5px;
			padding: 5px;
		}
	</style>
	<h2>Please Login</h2>
	<?php
	    if( isset($_SESSION["error"]) )
	    {
	    	echo ('<p style="color:red">'.$_SESSION["error"]."</P>\n");
	    	unset($_SESSION["error"]);
	    }
	?>
	<form method="POST">
		<label for="name">Account:<input type="text" name="account" id="name"></label>
		<br>
		<label for="pswd">Password:<input type="password" name="pw" id="pswd"></label>
		<br>
		<input type="submit" name="Log In">
		<a href="app.php"><button>Cancle</button></a>
	</form>
</body>
</html>