<?php

session_start();
if ( !isset($_SESSION['name']) || strlen($_SESSION['name']) < 1 ) {
    die('Not logged in');
}

if ( strpos($_SESSION['name'], '@') === false ) {
    die('Name parameter is wrong');
}

if ( isset($_POST['leave']) ) {
    header('Location: view.php');
    return;
}


try 
{
    $pdo = new PDO("mysql:host=localhost;dbname=coursera", "sahil", "martius");
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
    die();
}

$name = htmlentities($_SESSION['name']);

// Check to see if we have some POST data, if we do process it
if (isset($_POST['mileage']) && isset($_POST['year']) && isset($_POST['make'])) 
{
    if ( !is_numeric($_POST['mileage']) || !is_numeric($_POST['year']) ) 
    {
        $_SESSION["error"] = "Mileage and year must be numeric";
        header("Location: add.php");
        return;
    } 
    else if (strlen($_POST['make']) < 1)
    {
        $_SESSION["error"] = "Make is required";
        header("Location: add.php");
        return;
    }
    else 
    {
        $make = htmlentities($_POST['make']);
        $year = htmlentities($_POST['year']);
        $mileage = htmlentities($_POST['mileage']);

        $stmt = $pdo->prepare("
            INSERT INTO autos (make, year, mileage) 
            VALUES (:make, :year, :mileage)
        ");

        $stmt->execute([
            ':make' => $make, 
            ':year' => $year,
            ':mileage' => $mileage,
        ]);

        $_SESSION['success'] = "Record inserted";
        header("Location: view.php");
        return;
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sahil Mishra Autos</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Tracking Autos for <?php echo $name; ?></h1>
            <?php
                if ( isset($_SESSION["error"]) ) 
                {
                    // Look closely at the use of single and double quotes
                    echo ('<p style="color:red;">'.htmlentities($_SESSION["error"])."</P>\n");
                    unset($_SESSION["error"]);
                }
            ?>
            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="make">Make:</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" name="make" id="make">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="year">Year:</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" name="year" id="year">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="mileage">Mileage:</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" name="mileage" id="mileage">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-2">
                        <input class="btn btn-primary" type="submit" value="Add">
                        <input class="btn" type="submit" name="leave" value="Cancel">
                    </div>
                </div>
            </form>

        </div>
    </body>
</html>