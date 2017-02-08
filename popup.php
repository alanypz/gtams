<!DOCTYPE html>

<?php include("./php/Dispatch.php"); ?>
<?php use App\Dispatch as Dispatch; ?>

<?php $dispatch = new Dispatch(); ?>

<?php

// Sends the request to the server
if (isset($_GET['pid'])) {
	$pid = $_GET['pid'];
	if ($pid !== "") $nominee = $dispatch->getNomineeByPid($pid);
	if ($pid !== "") $previousAdvisors = $dispatch->getPreviousAdvisors($pid);
}
if (isset($_GET['nominatedBy'])) {
	$nominatorEmail = $_GET['nominatedBy'];
	$nominator = $dispatch->getNominatorByEmail($nominatorEmail);
}

?>

<!-- Need to include logic to launch this as a pop-up window. -->
<!-- This page should only be accessible through Nominee Names in the Score Table. -->
<!-- Fields have been set to readonly.  -->
<!-- Need to include logic to add several extra fields for
 		 "Previous Advisors", "Graduate-Level Courses Completed",
		 and "Publications".  -->
<html>

<head>
	<title>GTAMS | Nominee Submission Popup</title>
	<link href="css\style.css" rel="stylesheet">
</head>

<body>
<div class="container">
	<div class="row">
		<div class="column column-75">
			<h1>GTA Management System</h1>
		</div>
	</div>
</div>

<div class="container">
	<!-- Showing warning message(s) to GC Members. (May not be necessary.)  -->
	<div class="row">
		<div class="column column-75">
			<blockquote>
				Attention: This student missed the deadline/has an incomplete form!
			</blockquote>
		</div>
	</div>
</div>


<div class="container">

	<h5>Nominator and Advisor Information</h5>

	<div class="row">
		<div class="column column-25">
			<label>Nominator Name</label>
		</div>
		<div class="column column-25">
			<input type="text" id="nominatorFirstName" value="<?php echo $nominator->fname; ?>" readonly>
		</div>
		<div class="column column-25">
			<input type="text" id="nominatorLastName" value="<?php echo $nominator->lname; ?>" readonly>
		</div>
	</div>

	<div class="row">
		<div class="column column-25">
			<label>Current Ph.D. Advisor</label>
		</div>
		<div class="column column-25">
			<input type="text" id="advisorFirstName" value="<?php echo $nominee->nomineeInfo->current_phd_fname; ?>" readonly>
		</div>
		<div class="column column-25">
			<input type="text" id="advisorLastName" value="<?php echo $nominee->nomineeInfo->current_phd_lname; ?>" readonly>
		</div>
	</div>

	<?php if (count($previousAdvisors) > 0) { ?>

		<!-- Need to handle logic for adding "Previous Advisors". -->
		<div class="row">
			<div class="column column-25">
				<label>Previous Ph.D. Advisors</label>
			</div>
		</div>

		<?php foreach($previousAdvisors as $key => $previousAdvisor) { ?>
		<div class="row">
			<div class="column column-25 column-offset-25">
				<input type="text" id="prevAdvisorFirstName" value="<?php echo $previousAdvisor->fname; ?>" readonly>
				<input type="text" id="prevAdvisorLastName" value="<?php echo $previousAdvisor->lname; ?>" readonly>
				<input type="text" id="prevAdvisorDate" value="<?php echo $previousAdvisor->time_period; ?>" readonly>
			</div>
		</div>
		<?php } ?>
	<?php } ?>

	<h5>Nominee Information</h5>

	<div class="row">
		<div class="column column-25">
			<label>Full Name</label>
		</div>
		<div class="column column-25">
			<input type="text" id="nomineeFirstName" value="<?php echo $nominee->nomineeInfo->fname; ?>" readonly>
		</div>
		<div class="column column-25">
			<input type="text"id="nomineeLastName" value="<?php echo $nominee->nomineeInfo->lname; ?>" readonly>
		</div>
	</div>

	<div class="row">
		<div class="column column-25">
			<label>PID</label>
		</div>
		<div class="column column-50">
			<input type="text" id="pid" value="<?php echo $nominee->nomineeInfo->pid; ?>" readonly>
		</div>
	</div>

	<div class="row">
		<div class="column column-25">
			<label>E-mail Address</label>
		</div>
		<div class="column column-50">
			<input type="text" id="nomineeEmail" value="<?php echo $nominee->nomineeInfo->email; ?>"  readonly>
		</div>
	</div>

	<div class="row">
		<div class="column column-25">
			<label>Phone Number</label>
		</div>
		<div class="column column-50">
			<input type="text" id="nomineePhoneNumber" value="<?php echo $nominee->nomineeInfo->phone_number; ?>" readonly>
		</div>
	</div>

	<div class="row">
		<div class="column column-50">
			<label>Currently a Ph.D. student in the Department of Computer Science?</label>
		</div>
		<div class="column column-25">
			<input type="text" id="currentPHD" value="<?php echo $nominee->nomineeInfo->current_phd; ?>" readonly>
		</div>
	</div>

	<div class="row">
		<div class="column column-50">
			<label>Number of Semesters as Graduate Student</label>
		</div>
		<div class="column column-25">
			<input type="text" id="semestersAsGradStudent" value="<?php echo $nominee->nomineeInfo->number_of_graduate_semesters; ?>" readonly>
		</div>
	</div>

	<div class="row">
		<div class="column column-50">
			<label>Passed the SPEAK Test?</label>
		</div>
		<div class="column column-25">
			<input type="text" id="speakTest" value="<?php echo $nominee->nomineeInfo->passed_speak_test; ?>" readonly>
		</div>
	</div>

	<div class="row">
		<div class="column column-50">
			<label>Number of Semesters (Summers Included) as GTA</label>
		</div>
		<div class="column column-25">
			<input type="text" id="semestersAsGTA" value="<?php echo $nominee->nomineeInfo->number_of_semesters_as_gta; ?>"  readonly>
		</div>
	</div>

	<!-- Need to handle logic for adding "Graduate-Level Courses". -->

	<div class="row">
		<div class="column column-25">
			<label>Graduate-Level Courses Completed</label>
		</div>
	</div>

	<?php foreach($nominee->courses as $key => $course) { ?>
		<div class="row">
			<div class="column column-25 column-offset-25">
				<input type="text" id="courseID" value="<?php echo $course->course_id; ?>" readonly>
			</div>
			<div class="column column-25">
				<input type="text"id="courseGrade" value="<?php echo $course->course_grade; ?>" readonly>
			</div>
		</div>
	<?php } ?>

	<div class="row">
		<div class="column column-50">
			<label>GPA for Graduate-Level Courses</label>
		</div>
		<div class="column column-25">
			<input type="text" id="GPA" value="<?php echo $nominee->nomineeInfo->gpa_for_graduate_courses; ?>" readonly>
		</div>
	</div>

	<!-- Need to handle logic for adding "Publications". -->
	<div class="row">
		<div class="column column-25">
			<label>Publications</label>
		</div>
	</div>

	<?php foreach($nominee->publications as $key => $publication) { ?>
		<div class="row">
			<div class="column column-25 column-offset-25">
				<input type="text" id="publicationName" value="<?php echo $publication->name; ?>" readonly>
			</div>
			<div class="column column-25">
				<input type="text" id="citation" value="<?php echo $publication->citation; ?>" readonly>
			</div>
		</div>
	<?php } ?>

</div>

<br>

</body>

</html>
