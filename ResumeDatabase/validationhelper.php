<?php

function validationhelper(){
	if ( strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1)
    {
        $_SESSION['status'] = "All fields are required";
        header("Location: add.php");
        return;
    }

    for ($i=1; $i<=9; $i++) 
    {
    	if ( ! isset($_POST['year'.$i]) ) continue;
		if ( ! isset($_POST['desc'.$i]) ) continue;

		$year = htmlentities($_POST['year'.$i]);
		$desc = htmlentities($_POST['desc'.$i]);

    	if (strlen($year) < 1)
    	{
    		$_SESSION['status'] = "All fields are required";
    		header("Location: add.php");
    		return;
    	}

	    if (strlen($desc) < 1)
	    {
			$_SESSION['status'] = "All fields are required";
        	header("Location: add.php");
        	return;
	    }

	    if(!is_numeric($year))
    	{
    		$_SESSION['status'] = "Position year must be numeric";
    		header("Location: add.php");
    		return;    	}
    }

    if (strpos($_POST['email'], '@') === false) 
    {
        $_SESSION['status'] = "Email address must contain @";
        header("Location: add.php");
		return;
    }
}

?>