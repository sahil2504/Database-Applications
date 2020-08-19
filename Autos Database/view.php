<?php

session_start();
if ( !isset($_SESSION['name']) || strlen($_SESSION['name']) < 1 ) {
    die('Not logged in');
}

if ( strpos($_SESSION['name'], '@') === false ) {
    die('Name parameter is wrong');
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

$status = false;  // If we have no POST data
$status_color = 'red';



$autos = [];
$all_autos = $pdo->query("SELECT * FROM autos");

while ( $row = $all_autos->fetch(PDO::FETCH_OBJ) ) 
{
    $autos[] = $row;
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
            if ( isset($_SESSION['success']) )
            {
                echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
                unset($_SESSION['success']);
            }
            if(!empty($autos)) : ?>
                <h2>Automobiles</h2>
                <ul>
                    <?php foreach($autos as $auto) : ?>
                        <li>
                            <?php echo $auto->year; ?> <?php echo $auto->make; ?> <?php echo $auto->mileage; ?> 
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <p><a href="add.php">Add New</a> | <a href="logout.php">Logout</a></p>
        </div>
    </body>
</html>