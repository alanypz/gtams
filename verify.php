<!DOCTYPE html>
<!-- Fields must be populated using database. -->
<!-- Fields have all been set to readonly. -->

<html>

<head>
    <title>GTAMS | Nominee Form Verification</title>
    <link href="css\style.css" rel="stylesheet">
</head>

<?php
//define variables and set to empty values
$checkedVerifyBox = "";
?>

<body>
<div class="container">
    <div class="row">
        <div class="column column-75">
            <h1>GTA Management System</h1>
        </div>
    </div>
    <div class="row">
        <div class="column column-75">
            <h4>Nominee Form Verification</h4>
        </div>
    </div>
</div>
<br>

<!-- Input form begins here.  -->

<div class="container">

    <h5>Nominator and Advisor Information</h5>

    <div class="row">
        <div class="column column-25">
            <label>Nominator Name</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="First Name" id="nominatorFirstName" readonly>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Last Name" id="nominatorLastName" readonly>
        </div>
    </div>

    <div class="row">
        <div class="column column-25">
            <label>Current Ph.D. Advisor</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="First Name" id="advisorFirstName" readonly>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Last Name" id="advisorLastName" readonly>
        </div>
    </div>

    <!-- Need to handle logic for adding "Previous Advisors". -->
    <div class="row">
        <div class="column column-25">
            <label>Previous Ph.D. Advisors</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="First Name" id="prevAdvisorFirstName" readonly>
            <input type="text" placeholder="Start Date" id="prevAdvisorDate" readonly>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Last Name" id="prevAdvisorLastName" readonly>
            <input type="text" placeholder="End Date" id="prevAdvisorDate" readonly>
        </div>
    </div>

    <!-- Can be used to create new rows for "Previous Advisors". -->
    <div class="row">
        <div class="column column-25 column-offset-25">
            <input type="text" placeholder="First Name" id="prevAdvisorFirstName" readonly>
            <input type="text" placeholder="Start Date" id="prevAdvisorDate" readonly>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Last Name" id="prevAdvisorLastName" readonly>
            <input type="text" placeholder="End Date" id="prevAdvisorDate" readonly>
        </div>
    </div>

    <h5>Nominee Information</h5>

    <div class="row">
        <div class="column column-25">
            <label>Full Name</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="First Name" id="nomineeFirstName" readonly>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Last Name" id="nomineeLastName" readonly>
        </div>
    </div>

    <div class="row">
        <div class="column column-25">
            <label>PID</label>
        </div>
        <div class="column column-50">
            <input type="text" id="pid" readonly>
        </div>
    </div>

    <div class="row">
        <div class="column column-25">
            <label>E-mail Address</label>
        </div>
        <div class="column column-50">
            <input type="text" id="nomineeEmail" readonly>
        </div>
    </div>

    <div class="row">
        <div class="column column-25">
            <label>Phone Number</label>
        </div>
        <div class="column column-50">
            <input type="text" id="nomineePhoneNumber" readonly>
        </div>
    </div>

    <div class="row">
        <div class="column column-50">
            <label>Currently a Ph.D. student in the Department of Computer Science?</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="-" id="currentPHD" readonly>
        </div>
    </div>

    <div class="row">
        <div class="column column-50">
            <label>Number of Semesters as Graduate Student</label>
        </div>
        <div class="column column-25">
            <input type="text" id="semestersAsGradStudent" readonly>
        </div>
    </div>

    <div class="row">
        <div class="column column-50">
            <label>Passed the SPEAK Test?</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="-" id="speakTest" readonly>
        </div>
    </div>

    <div class="row">
        <div class="column column-50">
            <label>Number of Semesters (Summers Included) as GTA</label>
        </div>
        <div class="column column-25">
            <input type="text" id="semestersAsGTA" readonly>
        </div>
    </div>

    <!-- Need to handle logic for adding "Graduate-Level Courses". -->
    <div class="row">
        <div class="column column-25">
            <label>Graduate-Level Courses Completed</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Course ID" id="courseID" readonly>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Course Grade" id="courseGrade" readonly>
        </div>
    </div>

    <!-- Can be used to create new rows for "Graduate-Level Courses". -->
    <div class="row">
        <div class="column column-25 column-offset-25">
            <input type="text" placeholder="Course ID" id="courseID" readonly>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Course Grade" id="courseGrade" readonly>
        </div>
    </div>

    <div class="row">
        <div class="column column-50">
            <label>GPA for Graduate-Level Courses</label>
        </div>
        <div class="column column-25">
            <input type="text" id="GPA" readonly>
        </div>
    </div>

    <!-- Need to handle logic for adding "Publications". -->
    <div class="row">
        <div class="column column-25">
            <label>Publications</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Publication Name" id="publicationName" readonly>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Citation" id="citation" readonly>
        </div>
    </div>

    <!-- Can be used to create new rows for "Graduate-Level Courses". -->
    <div class="row">
        <div class="column column-25 column-offset-25">
            <input type="text" placeholder="Publication Name" id="publicationName" readonly>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Citation" id="citation" readonly>
        </div>
    </div>

</div>

<div class="container">

    <!-- Demo of "Missed Deadline" message. (Needs to be at end of session?)  -->
    <div class="row">
        <div class="column column-75">
            <blockquote>
                Warning: You have missed the deadline!
            </blockquote>
        </div>
    </div>

    <!-- The radio button only needs to be present during the nominator's review. -->
    <div class="row">
        <div class="column column-75">
            <blockquote>
                Nominators: Check the box below to indicate that you have verified the contents of the form.
            </blockquote>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <input type="checkbox" id="verifyForm" checked="checked">
            <label class="label-inline" for="rememberFields">Form Verified</label>

        </div>
    </div>

    <div class="row">
        <div class="column column-offset-25">
            <button class="button-outline"><a href="index.html">Verify</a>
            </button>
        </div>
    </div>

</div>

<br>

</body>

</html>