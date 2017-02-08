<!DOCTYPE html>

<?php include("./php/Dispatch.php"); ?>
<?php use App\Dispatch as Dispatch; ?>

<?php

$dispatch = new Dispatch();

if (isset($_GET['sortByNominator']) && $_GET['sortByNominator'] === "true") $sortByNominator = true;
else $sortByNominator = false;

if (isset($_GET['sortByAverageScore']) && $_GET['sortByAverageScore'] === "true") $sortByAverageScore = true;
else $sortByAverageScore = false;

$scores = $dispatch->getScores($sortByNominator, $sortByAverageScore);

?>

<html>

<head>
	<title>GTAMS | Nominee Score Table</title>
	<link href="css\style.css" rel="stylesheet">
</head>

<body>
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
				<h4>Nominee Score Table</h4>
			</div>
		</div>
	</div>

	<br>

	<!-- I'm assuming that by hitting a Sort button, we will reload the page and
	 		display the table sorted by the desired option. I can rewrite this to
		  suite another method though.-->
	<div class="container">
		<div class="row">
			<div class="column column-offset">
				<button class="button-outline"><a href="score.php?sortByNominator=true">Sort by Nominator</a></button>
				<button class="button-outline"><a href="score.php?sortByAverageScore=true">Sort by Average Score</a></button>
			</div>
		</div>
	</div>

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

		<div class="row">
			<div class="column">
				<button class="button-outline"><a href="score.php">Save</a></button>
			</div>
		</div>

	</div>

	<br>

</body>
</html>
