<?php
require_once "pdo.php";
session_start();

if ( ! isset($_SESSION['name']) ) {
	die("Not logged in");
}

if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    return;
}

if (isset($_REQUEST['profile_id']))
{
    $profile_id = htmlentities($_REQUEST['profile_id']);

    if (isset($_POST['delete'])) 
    {
        $stmt = $pdo->prepare("
            DELETE FROM profile
            WHERE profile_id = :profile_id
        ");

        $stmt->execute([
            ':profile_id' => $profile_id, 
        ]);

        $_SESSION['status'] = 'Record deleted';

        header('Location: index.php');
        return;
    }

    $stmt = $pdo->prepare("
        SELECT * FROM profile 
        WHERE profile_id = :profile_id
    ");

    $stmt->execute([
        ':profile_id' => $profile_id, 
    ]);

    $profile = $stmt->fetch(PDO::FETCH_OBJ);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sahil Mishra Profile Delete</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">

            <h1>Deleteing Profile</h1>

            <div class="row">
                <div class="col-sm-2">
                    First Name:
                </div>
                <div class="col-sm-3">
                    <?php echo $profile->first_name; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    Last Name:
                </div>
                <div class="col-sm-3">
                    <?php echo $profile->last_name; ?>
                </div>
            </div>

            <form method="POST" class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-4">
                        <input type="hidden" name="profile_id" value="<?php echo $profile->profile_id; ?>">
                        <input class="btn btn-primary" type="submit" name="delete" value="Delete">
                        <input class="btn btn-default" type="submit" name="cancel" value="Cancel">
                    </div>
                </div>
            </form>

        </div>
    </body>
</html>