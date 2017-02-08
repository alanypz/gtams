<<<<<<< Updated upstream:portal.html
<!DOCTYPE html>
<html>

<head>
	<title>GTAMS | User Portal</title>
	<link href="css\style.css" rel="stylesheet">
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="column column-75">
				<h1>GTA Management System</h1>
			</div>
			<div class="column">
				<form action="index.html">
					<button class="button button-outline">Logout</button>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="column column-75">
				<h4>User Access Portal</h2>
			</div>
		</div>
	</div>

	<br>
<!-- Pages credentials.html and popup.html should not be accessible from portal.html.
 		 I included them here for quick viewing. -->
	<div class="container">
		<div class="row">
			<div class="column column-25 column-offset-25">
				<button class="button-outline"><a href="nominator.html">Nominator Form</a></button>
				<button class="button-outline"><a href="nominee.html">Nominee Form</a></button>
				<button class="button-outline"><a href="score.html">Score Table</a></button>
				<button class="button-outline"><a href="incomplete.html">Incomplete Forms</a></button>
				<button class="button-outline"><a href="records.html">Historical Records</a></button>
				<button class="button-outline"><a href="session.html">Create Session</a></button>
				<button class="button-outline"><a href="credentials.html">Change Login</a></button>
				<button class="button-outline"><a href="popup.html">Nominee Popup</a></button>
			</div>
		</div>
	</div>

</body>
</html>
=======
<!DOCTYPE html>

<?php include("./php/Dispatch.php"); ?>
<?php use App\Dispatch as Dispatch; ?>

<?php

$dispatch = new Dispatch();

session_start();
$username = $_SESSION["username"];
$role = $_SESSION["role"];

?>

<html>

<head>
	<title>GTAMS | User Portal</title>
	<link href="css\style.css" rel="stylesheet">
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="column column-75">
				<h1>GTA Management System</h1>
			</div>
			<div class="column">
				<form action="index.php">
					<button class="button button-outline">Logout</button>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="column column-75">
				<h4>User Access Portal</h2>
			</div>
		</div>
	</div>

	<br>
<!-- Pages credentials.html and popup.php should not be accessible from portal.html.
 		 I included them here for quick viewing. -->
	<div class="container">
		<div class="row">
			<div class="column column-25 column-offset-25">
				<?php if ($role === "admin" || $role === "nominator") {  ?>
				<button class="button-outline"><a href="nominator.php">Nominator Form</a></button>
				<?php } ?>

				<?php if ($role === "admin" || $role === "nominee") {  ?>
				<button class="button-outline"><a href="nominee.php">Nominee Form</a></button>
				<?php } ?>

				<?php if ($role === "admin" || $role === "gc_member") {  ?>
				<button class="button-outline"><a href="score.php">Score Table</a></button>
				<?php } ?>

				<?php if ($role === "admin" || $role === "gc_member") {  ?>
				<button class="button-outline"><a href="incomplete.php">Incomplete Forms</a></button>
				<?php } ?>

				<?php if ($role === "admin" || $role === "gc_member") {  ?>
				<button class="button-outline"><a href="records.php">Historical Records</a></button>
				<?php } ?>

				<?php if ($role === "admin") {  ?>
				<button class="button-outline"><a href="session.php">Create Session</a></button>
				<?php } ?>

				<button class="button-outline"><a href="credentials.php">Change Login</a></button>
			</div>
		</div>
	</div>

</body>
</html>
>>>>>>> Stashed changes:portal.php
