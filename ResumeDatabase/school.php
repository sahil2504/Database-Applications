<?php

session_start();
header('Content-Type: application/json; charset=utf-8');
if ( ! isset($_SESSION['name']) ) {
	die("ACCESS DENIED");
}

require_once 'pdo.php';

if (isset($_REQUEST['term']))
{

	$stmt = $pdo->prepare('
		SELECT name FROM Institution
		WHERE name LIKE :prefix'
	);

	$stmt->execute(array( ':prefix' => $_REQUEST['term']."%"));

	$retval = [];

	while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) 
	{
		$retval[] = $row['name'];
	}

	echo(json_encode($retval, JSON_PRETTY_PRINT));

}

?>