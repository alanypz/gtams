<!DOCTYPE html>
<!-- This page should only be accessible through a link sent to the GC Members. -->

<?php include("./php/Dispatch.php"); ?>
<?php use App\Dispatch as Dispatch; ?>

<html>

<head>
	<title>GTAMS | Update Login</title>
	<link href="css/style.css" rel="stylesheet">
</head>

<?php

$dispatch = new Dispatch();
session_start();

//define variables and set to empty values
$usernameErr = $passwordErr = "";
$oldUsername = $newUsername = $newPassword = $oldPassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if (empty($_POST["oldUsername, newUsername"])){
		$usernameErr = "Whoa, no username? Please figure this out!";
	}
	else {
		$username = test_input($_POST["oldUsername, newUsername"]);
		//check to see if username contains letters, numbers, no whitespace
		if (!preg_match("/^[a-zA-Z0-9]*$/",$username)){
			$userNameErr = "Letters, Numbers, and no spaces in username, por favor!";
		}
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if (empty($_POST["oldPassword, newPassword"])){
		$passwordErr = "Whoa, no password? Really?";
	}
	else {
		$password = test_input($_POST["newPassword, oldPassword"]);
		//check to see if password meets min requirements
		if (!preg_match("\"/^(?=.*\d)(?=.*[A-Za-z])([0-9A-Za-z!@#%&-=_]};:',<>\.\|\?\^\*\()\$\+\{\[{6-50}$/",$password)){
			$passwordErr ="Password requirements not met:/n
            Needs at least 1 number/n
            Needs at least 1 letter/n
            And there has to be at least a number, letter and special character in it/n
            Needs to be within 6 to 50 characters";
		}
	}
}

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}

// Change Password
if (isset($_POST['newPassword']) && isset($_POST['oldPassword'])) {
	$dispatch->updatePassword($_SESSION["username"], $_POST['newPassword'], $_POST['oldPassword']);
}

// Change Username
if (isset($_POST['newUsername']) && $_POST['newUsername'] !== "") {
	$dispatch->updateUsername($_POST['newUsername'], $_SESSION["username"]);
	$_SESSION["username"] = $_POST['newUsername'];
}

?>

<body>
	<div class="container">
		<div class="row">
			<div class="column column-75">
				<h1>GTA Management System</h1>
			</div>
			<div class="column">
				<button class="button button-outline"><a href="portal.php">Portal</a></button>
			</div>
		</div>
		<div class="row">
			<div class="column column-75">
				<h4>Update Login Information</h4>
		</div>
	</div>
</div>

<br>

<div class="container">
	<div class="row">
		<div class="column">
		  <fieldset>
			   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="row">
						<div class="column column-50">
							<label for="oldUsernameField">Old Username</label>
						</div>
					</div>
					<div class="row">
						<div class="column column-50">
							<input type="text" readonly id="oldUsernameField" value="<?php echo $_SESSION["username"]; ?>" name="oldUsername">
						</div>
					</div>

					<div class="row">
						<div class="column column-50">
							<label for="newUsernameField">New Username</label>
						</div>
					</div>
					<div class="row">
						<div class="column column-50">
							<input type="text" id="newUsernameField"
								name="newUsername">
						</div>
					</div>

				   <div class="row">
					   <div class="column column-50">
						   <label for="oldPasswordField">Old Password</label>
					   </div>
				   </div>
				   <div class="row">
					   <div class="column column-50">
						   <input type="password" id="oldPasswordField"
								name="oldPassword">
					   </div>
				   </div>

					<div class="row">
						<div class="column column-50">
							<label for="newPasswordField">New Password</label>
						</div>
					</div>
					<div class="row">
						<div class="column column-50">
							<input type="password" id="newPasswordField"
								name="newPassword">
						</div>
					</div>

					<div class="row">
						<div class="column column-20">
							<input type="submit" value="Update">
						</div>
					</div>
			   </form>
		  </fieldset>
		</div>
	</div>
</div>

<br>

</body>
</html>
