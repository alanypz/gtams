<!DOCTYPE html>

<?php include("./php/Dispatch.php"); ?>
<?php use App\Dispatch as Dispatch; ?>

<?php

$dispatch = new Dispatch();

$sessions = $dispatch->getSessions();

if (isset($_GET['sessionId']) && $_GET['sessionId'] !== "") {
	$scores = $dispatch->getPreviousScores($_GET['sessionId']);
}
else {
	$scores = $dispatch->getPreviousScores();
}

?>

<html>
<!-- All fields in the tables are set to readonly. -->

<head>
	<title>GTAMS | Historical Records</title>
	<link href="css\style.css" rel="stylesheet">
</head>

<body>
<div class="container">
	<div class="row">
		<div class="column column-75">
			<h1>GTA Management System</h1>
		</div>
		<div class="column">
			<form action="portal.php">
				<button class="button button-outline" class="button">Portal</button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="column column-75">
			<h4>Session Historical Records</h4>
		</div>
	</div>
</div>

<br>

<!-- Will require all previous session "identifiers" to populate a dropdown selection. -->
<div class="container">
	<div class="row">
		<div class="column column-25">
			<label> Previous Session</label>
		</div>
		<div class="column column-25">
			<?php if (is_array($sessions)) { ?>
				<form>
					<select id="sessionID" onChange="window.location.href=this.value">
						<option value="">-</option>
						<option value="/records.php">All</option>
						<?php foreach($sessions as $sessionPrev) { ?>
							<option value="/records.php?sessionId=<?php echo $sessionPrev->id; ?>"><?php echo $sessionPrev->semester_period . " " . $sessionPrev->semester_year; ?></option>
						<?php } ?>
					</select>
				</form>
			<?php } ?>

		</div>
	</div>
</div>

<!-- Table needs to be loaded depending on user selection. -->
<div class="container">
	<table>
		<thead>
		<tr>
			<th>Nominator</th>
			<th>Nominee</th>
			<th>Rank</th>
			<th>Status</th>
			<th>Average Score</th>
			<th>GC Member 1</th>
			<th>GC Member 2</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($scores as $key => $score) { ?>
			<tr>
				<td>Nominator <?php echo $score->data->nominated_by;  ?></td>
				<td><a href="popup.php?nominatedBy=<?php echo $score->data->nominated_by; ?>&pid=<?php echo $score->data->pid; ?>">Nominee <?php echo $score->data->pid; ?></a></td>
				<td><?php echo $score->data->rank; ?></td>
				<td>New</td>
				<td><?php echo $score->averageScore->avg; ?></td>
				<td>
					<div class="row">
						<div class="column">
							<input type="text" placeholder="Score" id="comment">
							<input type="text" placeholder="Comment..." id="comment">
						</div>
					</div>
				</td>
				<td>
					<div class="row">
						<div class="column">
							<input type="text" placeholder="Score" id="comment">
							<input type="text" placeholder="Comment..." id="comment">
						</div>
					</div>
				</td>
			</tr>

		<?php } ?>
		</tbody>
	</table>
</div>

<br>

</body>
</html>
