<!DOCTYPE html>

<?php include("./php/Dispatch.php"); ?>
<?php use App\Dispatch as Dispatch; ?>

<html>
<head>
	<title>GTAMS | Session Creation</title>
	<link href="css\style.css" rel="stylesheet">
	<script>
		function validateForm() {

			var forms = document.forms["sessionForm"];
			var missing = [];
			var i;

			for (i = 0; i < forms.length; i++) {
				if (forms[i].value == null || forms[i].value == "" || forms[i].value == "default") {
					if (forms[i].getAttribute("type") != "button") {
						var idName = forms[i].getAttribute("id");
						missing.push(idName)
					}
				}
			}

			if (missing.length > 0) {
				var printMissing = "Missing the following field(s): " + missing[0];
				var i;
				for (i = 1; i < missing.length; i++) {
					printMissing = printMissing + ", " + missing[i]
				}

				document.getElementById("userMessage").innerHTML = printMissing;
				document.getElementById("userMessage").style.color = "red";
				return false;
			}

		}

		function addNewGC() {
			var original = document.getElementById("gcMember");
			var cloneGC = original.cloneNode(true);
			var inputFields = cloneGC.getElementsByTagName("*");
			var i;
			for (i = 0; i < inputFields.length; i++) {
				inputFields[i].value = "";
			}
			document.getElementById("gcMembers").appendChild(cloneGC);
		}
	</script>
</head>
<?php

$dispatch = new Dispatch();

if (isset($_POST["sessionSemester"]) && $_POST["sessionSemester"] !== "" &&
	isset($_POST["sessionYear"]) && $_POST["sessionYear"] !== "" &&
	isset($_POST["chairFirstName"]) && $_POST["chairFirstName"] !== "" &&
	isset($_POST["chairLastName"]) && $_POST["chairLastName"] !== "" &&
	isset($_POST["initiationDeadline"]) && $_POST["initiationDeadline"] !== "" &&
	isset($_POST["responseDeadline"]) && $_POST["responseDeadline"] !== "" &&
	isset($_POST["verificationDeadline"]) && $_POST["verificationDeadline"] !== "") {
	$dispatch->createSession($_POST["sessionSemester"],
		$_POST["sessionYear"],
		$_POST["chairFirstName"],
		$_POST["chairLastName"],
		$_POST["initiationDeadline"],
		$_POST["responseDeadline"],
		$_POST["verificationDeadline"]);
}

if (isset($_POST["gcFname"]) && $_POST["gcFname"] !== "" &&
	isset($_POST["gcLname"]) && $_POST["gcLname"] !== "" &&
	isset($_POST["gcEmail"]) && $_POST["gcEmail"] !== "" &&
	isset($_POST["gcUsername"]) && $_POST["gcUsername"] !== "" &&
	isset($_POST["gcPassword"]) && $_POST["gcPassword"] !== "") {
	$dispatch->createGCUser($_POST["gcFname"],
							$_POST["gcLname"],
							$_POST["gcEmail"],
							$_POST["gcUsername"],
							$_POST["gcPassword"]);
}

?>

<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="container">
		<div class="row">
			<div class="column column-75">
				<h1>GTA Management System</h1>
			</div>
			<div class="column">
				<button class="button button-outline" class="button"><a href="portal.php">Portal</a></button>
			</div>
		</div>
		<div class="row">
			<div class="column column-75">
				<h4>New Session Creation Form</h4>
			</div>
		</div>
	</div>

	<br>

	<div class="container">
		<h5>Session Identification</h5>

		<div class="row">
			<div class="column column-25">
				<label>Session Deadline</label>
			</div>
			<div class="column column-25">
				<select id="sessionSemester"
						name="sessionSemester">
					<option value="" selected>- Semester -</option>
					<option value="fall">Fall</option>
					<option value="spring">Spring</option>
					<option value="summer">Summer</option>
				</select>
			</div>
			<div class="column column-25">
				<select id="sessionYear"
						name="sessionYear">
					<option value="" selected>- Year -</option>
					<option value="2015">2016</option>
					<option value="2017">2017</option>
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
				</select>
			</div>
		</div>

		<h5>GC Member Information</h5>
		<!-- Need to support adding multiple GC Members -->
		<div id="gcMembers">
			<div id="gcMember">
				<div class="row">
					<div class="column column-25">
						<label>Full Name</label>
					</div>
					<div class="column column-25">
						<input type="text" placeholder="First Name" id="gcFirstName"
							   name="gcFname">
					</div>
					<div class="column column-25">
						<input type="text" placeholder="Last Name" id="gcLastName"
							   name="gcLname">
					</div>
				</div>
				<div class="row">
					<div class="column column-25">
						<label>E-mail Address</label>
					</div>
					<div class="column column-50">
						<input type="text" placeholder="E-mail Address" id="gcEmail"
							   name="gcEmail">
					</div>
				</div>
				<!-- We could force the username to be the GC Member's email address. -->
				<div class="row">
					<div class="column column-25">
						<label>Login Name</label>
					</div>
					<div class="column column-25">
						<input type="text" placeholder="Login Name" id="gcLogin"
							   name="gcUsername">
					</div>
					<div class="column column-25">
						<input type="text" placeholder="Password" id="gcPassword"
							   name="gcPassword">
					</div>
				</div>
				<br>
			</div>
		</div>

		<div class="row">
			<div class="column column-25 column-offset-25">
				<button class="button button-outline" class="button"  onclick="addNewGC()">New GC Member</button>
			</div>
		</div>

		<script>
			function addNewGC() {
				var original = document.getElementById("gcMember");
				var cloneGC = original.cloneNode(true);
				var inputFields = cloneGC.getElementsByTagName("*");
				var i;
				for (i = 0; i < inputFields.length; i++) {
					inputFields[i].value = "";
				}
				document.getElementById("gcMembers").appendChild(cloneGC);
			}
		</script>

		<h5>Session Specifications</h5>

		<div class="row">
			<div class="column column-25">
				<label>GC Chair Name</label>
			</div>
			<div class="column column-25">
				<input type="text" placeholder="First Name" id="chairFirstName"
					   name="chairFirstName">
			</div>
			<div class="column column-25">
				<input type="text" placeholder="Last Name" id="chairLastName"
					   name="chairLastName">
			</div>
		</div>

		<!-- Need to add logic to prevent impossible dates/orders. -->
		<div class="row">
			<div class="column column-25">
				<label>Nomination Initiation Deadline</label>
			</div>
			<div class="column column-50">
				<input type="date" id="initiationDeadline"
					   name="initiationDeadline">
			</div>
		</div>

		<div class="row">
			<div class="column column-25">
				<label>Nominee Response Deadline</label>
			</div>
			<div class="column column-50">
				<input type="date" id="responseDeadline"
					   name="responseDeadline">
			</div>
		</div>

		<div class="row">
			<div class="column column-25">
				<label>Nominator Verification Deadline</label>
			</div>
			<div class="column column-50">
				<input type="date" id="verificationDeadline"
					   name="verificationDeadline">
			</div>
		</div>

	</div>

	<div class="container">
		<div class="row">
			<div class="column column-75">
				<blockquote>
					On session creation, each GC Members will recieve an e-mail containing their username and password, including a link for changing their credentials, if desired.
				</blockquote>
			</div>
		</div>
		<div class="row">

			<div class="column column-offset-25">
				<input type="submit" value="Create the Session & Users" />
</form>
</div>
</div>
</div>
</body>
</html>
