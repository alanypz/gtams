<<<<<<< Updated upstream:index.html
<!DOCTYPE html>

<!--
	I noticed that formatting the linked buttons as

		<button class="button-outline"><a href="portal.html">Submit Nomination</a></button>

	requires you to actually select the text within the button to link. When
	formatted as

		<form action="index.html">
			<button class="button button-outline">Logout</button>
		</form>

	the entire button functions as a link. -->
<html>

<head>
	<title>GTAMS | Homepage</title>
	<link href="css\style.css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="column column-75">
				<h1>GTA Management System</h1>
			</div>
		</div>
		<div class="row">
			<div class="column column-75">
				<h4>User Login</h2>
		</div>
	</div>
</div>

<br>

<div class="container">
	<div class="row">
		<div class="column">
		  <fieldset>

				<div class="row">
					<div class="column column-50">
						<label for="usernameField">Username</label>
					</div>
				</div>
				<div class="row">
					<div class="column column-50">
						<input type="text" id="usernameField">
					</div>
				</div>

				<div class="row">
					<div class="column column-50">
						<label for="passwordField">Password</label>
					</div>
				</div>
				<div class="row">
					<div class="column column-50">
						<input type="password" id="passwordField">
					</div>
				</div>

				<div class="row">
					<div class="column column-20">
						<button class="button-outline"><a href="portal.html">Login</a></button>
					</div>
					<div class="column column-15 column-offset-10">
		      	<input type="checkbox" id="rememberFields">
						<label class="label-inline" for="rememberFields">Remember User</label>
					</div>
				</div>

		  </fieldset>
		</div>
	</div>
</div>

<br>

</body>
</html>
=======
<!DOCTYPE html>

<?php include("./php/Dispatch.php"); ?>
<?php use App\Dispatch as Dispatch; ?>

<?php

$dispatch = new Dispatch();

if (isset($_POST["password"]) && isset($_POST["username"]) && $dispatch->loginUser($_POST["username"], $_POST["password"])) {
    // Time to generate a seesion
    session_start();

    $user = $dispatch->getUserByUsername($_POST["username"]);

    // Set the username in the session
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["role"] = $user->role;

    // Redirect to the Portal
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/portal.php");
    exit();
}

if (isset($_POST["password"]) && isset($_POST["username"]) && !$dispatch->loginUser($_POST["username"], $_POST["password"])) echo("<div style='background-color:#eeeeee; width:100%; text-align:center;'>Incorrect login!</div>");

?>

<!--
	I noticed that formatting the linked buttons as

		<button class="button-outline"><a href="portal.php">Submit Nomination</a></button>

	requires you to actually select the text within the button to link. When
	formatted as

		<form action="index.html">
			<button class="button button-outline">Logout</button>
		</form>

	the entire button functions as a link. -->
<html>

<head>
	<title>GTAMS | Homepage</title>
	<link href="css\style.css" rel="stylesheet">
</head>

<body>

<?php
//define variables and set to empty values
$usernameErr = $passwordErr = "";
$username = $password = "";
$didCheckRemember = "";
/*
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["username"])){
        $usernameErr = "Whoa, no username? Please figure this out!";
    }
    else {
        $username = test_input($_POST["username"]);
        //check to see if username contains letters, numbers, no whitespace
        if (!preg_match("/^[a-zA-Z0-9]*$/",$username)){
            $userNameErr = "Letters, Numbers, and no spaces in username, por favor!";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["password"])){
        $passwordErr = "Whoa, no password? Really?";
    }
    else {
        $password = test_input($_POST["password"]);
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

*/
?>

	<div class="container">
		<div class="row">
			<div class="column column-75">
				<h1>GTA Management System</h1>
			</div>
		</div>
		<div class="row">
			<div class="column column-75">
				<h4>User Login</h4>
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
                            <label for="usernameField">Username</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column column-50">
                            <input type="text" name="username" id="usernameField" value="<?php echo $username;?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="column column-50">
                            <label for="passwordField">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column column-50">
                            <input type="password" name="password" id="passwordField" value="<?php echo $password;?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="column column-20">
                            <input type="submit" value="Login">
                        </div>
                        <div class="column column-15 column-offset-10">
                    <input type="checkbox" id="rememberFields" value="<?php if (isset($didCheckRemember)) echo "checked";?>">
                            <!//not sure on the functionality of the remember me checkbox...uses cookies?>
                            <label class="label-inline" for="rememberFields">Remember User</label>

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
>>>>>>> Stashed changes:index.php
