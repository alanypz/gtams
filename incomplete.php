<!DOCTYPE html>

<?php include("./php/Dispatch.php"); ?>
<?php use App\Dispatch as Dispatch; ?>

<?php

$dispatch = new Dispatch();

$incompleteForms = $dispatch->getIncompleteForms();

?>

<html>

<head>
	<title>GTAMS | Incomplete Nominations</title>
	<link href="css\style.css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="column column-75">
				<h1>GTA Management System</h1>
			</div>
			<div class="column">
<<<<<<< Updated upstream:incomplete.html
				<form action="portal.html">
=======
				<form action="portal.php">
>>>>>>> Stashed changes:incomplete.php
					<button class="button button-outline" class="button">Portal</button>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="column column-75">
<<<<<<< Updated upstream:incomplete.html
				<h4>Incomplete Nominations</h2>
=======
				<h4>Incomplete Nominations</h4>
>>>>>>> Stashed changes:incomplete.php
			</div>
		</div>
	</div>

	<br>

	<div class="container">

	<!-- Need to dynamically add columns to the table for each GC Member. Also
	 		 need to consider adding a horizontal scroll bar if page gets too long?-->
	<!-- Currently filled with mock data. -->
	<!-- Will have to launch pop-up windows when clicking Nominee names. -->
	<!-- Also need to figure out how to visually include a section for GC comments. -->
		<table>
		  <thead>
		    <tr>
		      <th>Nominator</th>
		      <th>Nominee</th>
		      <th>Reason</th>
		    </tr>
		  </thead>
		  <tbody>
<<<<<<< Updated upstream:incomplete.html
		    <tr>
		      <td>Nominator 1</td>
		      <td><a href="popup.html">Nominee 5</a></td>
		      <td><input type="text" placeholder="Did Not Respond" id="comment" readonly></td>
		    </tr>
				<tr>
		      <td>Nominator 2</td>
		      <td><a href="popup.html">Nominee 6</a></td>
		      <td><input type="text" placeholder="Did Not Respond" id="comment" readonly></td>
		    </tr>
				<tr>
		      <td>Nominator 2</td>
		      <td><a href="popup.html">Nominee 7</a></td>
		      <td><input type="text" placeholder="Not Verified by Nominator" id="comment" readonly></td>
		    </tr>
				<tr>
		      <td>Nominator 3</td>
		      <td><a href="popup.html">Nominee 8</a></td>
		      <td><input type="text" placeholder="Did Not Respond" id="comment" readonly></td>
		    </tr>
=======
		  <?php foreach ($incompleteForms as $key => $incompleteForm) { ?>
		    <tr>
		      <td><strong>Nominator:</strong> <?php echo $incompleteForm->nominated_by; ?></td>
		      <td><a href="/popup.php?pid=<?php echo $incompleteForm->pid; ?>"><strong>Nominee:</strong> <?php echo $incompleteForm->pid; ?></a></td>
		      <td><p>Did Not Complete</p></td>
		    </tr>
		  <?php } ?>
>>>>>>> Stashed changes:incomplete.php
		  </tbody>
		</table>

	</div>

	<br>

</body>
</html>
