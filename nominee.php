<!DOCTYPE html>

<?php include("./php/Dispatch.php"); ?>
<?php use App\Dispatch as Dispatch; ?>

<html>

<head>
    <title>GTAMS | Nominee Submission Form</title>
    <link href="css\style.css" rel="stylesheet">
    <script>
        function validateForm() {

            var forms = document.forms["nomineeForm"];
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

        function addPrevAdvisor() {
            var original = document.getElementById("templatePreviousAdvisor");
            var cloneGC = original.cloneNode(true);
            var inputFields = cloneGC.getElementsByTagName("*");
            var i;
            for (i = 0; i < inputFields.length; i++) {
                inputFields[i].value = "";
            }
            document.getElementById("prevAdvisorContainer").appendChild(cloneGC);
        }

        function addNewGradCourse() {
            var original = document.getElementById("templateGradCourse");
            var cloneGC = original.cloneNode(true);
            var inputFields = cloneGC.getElementsByTagName("*");
            var i;
            for (i = 0; i < inputFields.length; i++) {
                inputFields[i].value = "";
            }
            document.getElementById("gradCourseContainer").appendChild(cloneGC);
        }

        function addNewPublication() {
            var original = document.getElementById("templatePublication");
            var cloneGC = original.cloneNode(true);
            var inputFields = cloneGC.getElementsByTagName("*");
            var i;
            for (i = 0; i < inputFields.length; i++) {
                inputFields[i].value = "";
            }
            document.getElementById("publicationContainer").appendChild(cloneGC);
        }
    </script>
</head>

<?php

$dispatch = new Dispatch();

$nominee = $dispatch->getNomineeByPid($_GET['pid']);

if (isset($_POST['nominatorFirstName']) && $_POST['nominatorFirstName'] !== "" &&
    isset($_POST['nominatorLastName']) && $_POST['nominatorLastName'] !== "" &&
    isset($_POST['currentPhdFname']) && $_POST['currentPhdFname'] !== "" &&
    isset($_POST['currentPhdLname']) && $_POST['currentPhdLname'] !== "" &&
    isset($_POST['nomineeFirstName']) && $_POST['nomineeFirstName'] !== "" &&
    isset($_POST['nomineeLastName']) && $_POST['nomineeLastName'] !== "" &&
    isset($_POST['pid']) && $_POST['pid'] !== "" &&
    isset($_POST['nomineeEmail']) && $_POST['nomineeEmail'] !== "" &&
    isset($_POST['nomineePhoneNumber']) && $_POST['nomineePhoneNumber'] !== "" &&
    isset($_POST['currentPhd']) && $_POST['currentPhd'] !== "" &&
    isset($_POST['semestersAsGradStudent']) && $_POST['semestersAsGradStudent'] !== "" &&
    isset($_POST['speakTest']) && $_POST['speakTest'] !== "" &&
    isset($_POST['semestersAsGta']) && $_POST['semestersAsGta'] !== "" &&
    isset($_POST['gpa'])  && $_POST['gpa'] !== "") {

    $dispatch->updateNominee($_POST['nomineeFirstName'],
                             $_POST['nomineeLastName'],
                             $_POST['nomineeEmail'],
                             $_POST['nomineePhoneNumber'],
                             $_POST['currentPhd'],
                             $_POST['semestersAsGradStudent'],
                             $_POST['speakTest'],
                             $_POST['semestersAsGta'],
                             $_POST['gpa'],
                             $_POST['currentPhdLname'],
                             $_POST['currentPhdFname']);

}

?>


<body>
<form method="post" action="">
<div class="container">
    <div class="row">
        <div class="column column-75">
            <h1>GTA Management System</h1>
        </div>
    </div>
    <div class="row">
        <div class="column column-75">
            <h4>Nominee Submission Form</h4>
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
            <input type="text" placeholder="First Name" id="nominatorFirstName"
                    name="nominatorFirstName"
                    value="<?php echo $nominee->nomineeInfo->fname; ?>">
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Last Name" id="nominatorLastName"
                    name="nominatorLastName"
                    value="<?php echo $nominee->nomineeInfo->lname; ?>">
        </div>
    </div>

    <div class="row">
        <div class="column column-25">
            <label>Current Ph.D. Advisor</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="First Name" id="advisorFirstName"
                    name="currentPhdFname"
                    value="<?php echo $nominee->nomineeInfo->current_phd_fname; ?>">
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Last Name" id="advisorLastName"
                    name="currentPhdLname"
                    value="<?php echo $nominee->nomineeInfo->current_phd_lname; ?>">
        </div>
    </div>
    <?php /*
    <!-- Need to handle logic for adding "Previous Advisors". -->
    <div class="row">
        <div class="column column-25">
            <label>Previous Ph.D. Advisors</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="First Name" id="prevAdvisorFirstName">
            <input type="text" placeholder="Start Date" id="prevAdvisorDate">
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Last Name" id="prevAdvisorLastName">
            <input type="text" placeholder="End Date" id="prevAdvisorDate">
        </div>
    </div>

    <!-- Can be used to create new rows for "Previous Advisors". -->
    <div class="row">
        <div class="column column-25 column-offset-25">
            <input type="text" placeholder="First Name" id="prevAdvisorFirstName"
                   value="<?php echo $prevAdvisorFirstName;?>">
            <input type="text" placeholder="Start Date" id="prevAdvisorDate"
                   value="<?php echo $prevAdvisorStartDate;?>">
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Last Name" id="prevAdvisorLastName"
                   value="<?php echo $prevAdvisorLastName;?>">
            <input type="text" placeholder="End Date" id="prevAdvisorDate"
                   value="<?php echo $prevAdvisorEndDate;?>">
        </div>
    </div>

    <div class="row">
        <div class="column column-25 column-offset-25">
            <button class="button button-outline" class="button">New Advisor</button>
        </div>
    </div>
 */ ?>

    <h5>Your Information</h5>

    <div class="row">
        <div class="column column-25">
            <label>Full Name</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="First Name" id="nomineeFirstName"
                    name="nomineeFirstName"
                    value="<?php echo $nominee->nomineeInfo->fname; ?>">
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Last Name" id="nomineeLastName"
                    name="nomineeLastName"
                    value="<?php echo $nominee->nomineeInfo->lname; ?>">
        </div>
    </div>

    <div class="row">
        <div class="column column-25">
            <label>PID</label>
        </div>
        <div class="column column-50">
            <input type="text" id="pid"
                name="pid"
                value="<?php echo $nominee->nomineeInfo->pid; ?>">
        </div>
    </div>

    <div class="row">
        <div class="column column-25">
            <label>E-mail Address</label>
        </div>
        <div class="column column-50">
            <input type="text" id="nomineeEmail"
                name="nomineeEmail"
                   value="<?php echo $nominee->nomineeInfo->email; ?>">
        </div>
    </div>

    <div class="row">
        <div class="column column-25">
            <label>Phone Number</label>
        </div>
        <div class="column column-50">
            <input type="text" id="nomineePhoneNumber"
                name="nomineePhoneNumber"
                value="<?php echo $nominee->nomineeInfo->phone_number; ?>">
        </div>
    </div>

    <div class="row">
        <div class="column column-50">
            <label>Currently a Ph.D. student in the Department of Computer Science?</label>
        </div>
        <div class="column column-25">
            <form>
                <select id="currentPhd" value="<?php echo $nominee->nomineeInfo->current_phd; ?>" name="currentPhd">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    <option value="default" selected>-</option>
                </select>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="column column-50">
            <label>Number of Semesters as Graduate Student</label>
        </div>
        <div class="column column-25">
            <input type="text" id="semestersAsGradStudent"
                   name="semestersAsGradStudent"
                    value="<?php echo $nominee->nomineeInfo->number_of_graduate_semesters; ?>">
        </div>
    </div>

    <div class="row">
        <div class="column column-50">
            <label>Passed the SPEAK Test?</label>
        </div>
        <div class="column column-25">
            <form>
                <select id="speakTest" name="speakTest" value="<?php echo $nominee->nomineeInfo->passed_speak_test; ?>">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    <option value="institution">Graduated from a U.S. Institution</option>
                    <option value="default" selected>-</option>
                </select>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="column column-50">
            <label>Number of Semesters (Summers Included) as GTA</label>
        </div>
        <div class="column column-25">
            <input type="text" id="semestersAsGta" name="semestersAsGta" value="<?php echo $nominee->nomineeInfo->number_of_graduate_semesters; ?>">
        </div>
    </div>

    <?php /*
    <!-- Need to handle logic for adding "Graduate-Level Courses". -->
    <div class="row">
        <div class="column column-25">
            <label>Graduate-Level Courses Completed</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Course ID" id="courseID" value="<?php echo $courseID;?>">
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Course Grade" id="courseGrade" value="<?php echo $courseGrade;?>">
        </div>
    </div>

    <!-- Can be used to create new rows for "Graduate-Level Courses". -->
    <div class="row">
        <div class="column column-25 column-offset-25">
            <input type="text" placeholder="Course ID" id="courseID" value="<?php echo $courseID;?>">
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Course Grade" id="courseGrade" value="<?php echo $courseGrade;?>">
        </div>
    </div>

    <div class="row">
        <div class="column column-25 column-offset-25">
            <button class="button button-outline" class="button">New Course</button>
        </div>
    </div>
 */ ?>

    <div class="row">
        <div class="column column-50">
            <label>GPA for Graduate-Level Courses</label>
        </div>
        <div class="column column-25">
            <input type="text" id="Gpa" name="gpa" value="<?php echo $nominee->nomineeInfo->gpa_for_graduate_courses; ?>">
        </div>
    </div>

    <?php /*
    <!-- Need to handle logic for adding "Publications". -->
    <div class="row">
        <div class="column column-25">
            <label>Publications</label>
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Publication Name" id="publicationName" value="<?php echo $publicationName;?>">
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Citation" id="citation" value="<?php echo $citation;?>">
        </div>
    </div>

    <!-- Can be used to create new rows for "Graduate-Level Courses". -->
    <div class="row">
        <div class="column column-25 column-offset-25">
            <input type="text" placeholder="Publication Name" id="publicationName" value="<?php echo $publicationName;?>">
        </div>
        <div class="column column-25">
            <input type="text" placeholder="Citation" id="citation" value="<?php echo $citation;?>">
        </div>
    </div>

    <div class="row">
        <div class="column column-25 column-offset-25">
            <button class="button button-outline" class="button">New Publication</button>
        </div>
    </div>

 */?>

</div>

    <div class="container">
        <div class="row">
            <div class="column column-75">
                <blockquote>
                    <p></p>
                    <p>
                        On session creation, each GC Members will receive an e-mail containing their username and password, including a link for changing their credentials, if desired.
                    </p>
                    <p id="userMessage"></p>
                </blockquote>
            </div>
        </div>
        <div class="row">
            <div class="column column-offset-25">
                <input type="submit" value="Create Session" onclick="return validateForm()" method="post" action="session.php">
            </div>
        </div>
    </div>

<br>
</form>
</body>

</html>