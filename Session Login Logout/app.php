<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>App</title>
</head>
<body>
	<h2>A Cool Application</h2>
    <?php
	    if( isset($_SESSION["success"]) )
	    {
	    	echo ('<p style="color:green">'.$_SESSION["success"]."</P>\n");
	    	unset($_SESSION["success"]);
	    }
	    if(! isset($_SESSION["account"]) )
	    	{ ?>
	    		<p>PLease <a href="login.php">Login</a> to start.</p>
	    <?php
	        }
	    else
	    { ?>
	        <p>This is where a cool application would be.</p>
            <p>Please <a href="logout.php">Log Out</a> when you are done.</p>
	    <?php } ?>	
</body>
</html>