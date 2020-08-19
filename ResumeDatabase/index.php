<?php
session_start();

$logged_in = false;
$profiles = [];
require_once "pdo.php";

if (isset($_SESSION['name']) ) 
{

	$logged_in = true;
}

$all_profiles = $pdo->query("SELECT * FROM profile");

while ( $row = $all_profiles->fetch(PDO::FETCH_OBJ) ) 
{
    $profiles[] = $row;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sahil Mishra's Resume Registry</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<h1>Sahil Mishra's Resume Registry</h1>

			<?php if (!$logged_in) : ?>
				<p>
					<a href="login.php">Please log in</a>
				</p>
				<div class="row">
						<div class="col-md-8">
							<table class="table">
								<thead>
									<tr>
										<th>Name</th>
										<th>Headline</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($profiles as $profile) : ?>
				                        <tr>
				                        	<td>
				                        		<a href="view.php?profile_id=<?php echo $profile->profile_id; ?>">
				                        			<?php echo $profile->first_name . ' ' . $profile->last_name; ?>
				                        		</a>
				                        	</td>
											<td><?php echo $profile->headline ?></td>
				                        </tr>
				                    <?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
			<?php else : ?>
			<?php
				if( isset($_SESSION["status"]) )
				{
					echo ('<p style="color:green;">'.$_SESSION["status"]."</P>\n");
					unset($_SESSION["status"]);
				}
			?>
				<?php if (empty($profiles)) : ?>
					<p>No rows found</p>
				<?php else : ?>
					<div class="row">
						<div class="col-md-8">
							<table class="table">
								<thead>
									<tr>
										<th>Name</th>
										<th>Headline</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($profiles as $profile) : ?>
				                        <tr>
				                        	<td>
				                        		<a href="view.php?profile_id=<?php echo $profile->profile_id; ?>">
				                        			<?php echo $profile->first_name . ' ' . $profile->last_name; ?>
				                        		</a>
				                        	</td>
											<td><?php echo $profile->headline ?></td>
											<td>
												<a href="edit.php?profile_id=<?php echo $profile->profile_id; ?>">
													Edit
												</a> / 
												<a href="delete.php?profile_id=<?php echo $profile->profile_id; ?>">
													Delete
												</a>
											</td>
				                        </tr>
				                    <?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				<?php endif; ?>
				<p>
					<a href="add.php">Add New Entry</a>
				</p>
				<p>
					<a href="logout.php">Logout</a>
				</p>
			<?php endif; ?>	
		</div>
	</body>
</html>