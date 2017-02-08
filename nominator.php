<!DOCTYPE html>
<html>

<head>
    <title>GTAMS | Nomination Submission</title>
    <link href="css\style.css" rel="stylesheet">
    <script>
        function validateForm() {

            var forms = document.forms["nominatorForm"];
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
    </script>
</head>

<?php include("./php/Dispatch.php"); ?>
<?php use App\Dispatch as Dispatch; ?>

<?php

$dispatch = new Dispatch();

// Create the nominator
if (isset($_POST['nominatorFirstName']) && $_POST['nominatorFirstName'] !== "" &&
    isset($_POST['nominatorLastName']) && $_POST['nominatorFirstName'] !== "" &&
    isset($_POST['nominatorEmail'])  && $_POST['nominatorFirstName'] !== "") {
        $dispatch->createNominator(
            $_POST['nominatorFirstName'],
            $_POST['nominatorLastName'],
            $_POST['nominatorEmail']
        );
    }

// Create the nominee
if (isset($_POST['nomineeFirstName']) && $_POST['nomineeFirstName'] !== "" &&
    isset($_POST['nomineeLastName']) && $_POST['nomineeLastName'] !== "" &&
    isset($_POST['nomineeEmail']) && $_POST['nomineeEmail'] !== "" &&
    isset($_POST['ranking']) && $_POST['ranking'] !== "" &&
    isset($_POST['pid']) && $_POST['pid'] !== "" &&
    isset($_POST['newPHD']) && $_POST['newPHD'] !== "" &&
    isset($_POST['currentPHD']) && $_POST['currentPHD'] !== "" &&
    isset($_POST['nominatorEmail']) && $_POST['nominatorEmail'] !== "") {
        $dispatch->createNominee(
            $_POST['nomineeFirstName'],
            $_POST['nomineeLastName'],
            $_POST['ranking'],
            $_POST['pid'],
            $_POST['nomineeEmail'],
            $_POST['currentPHD'],
            $_POST['newPHD'],
            $_POST['nominatorEmail']
        );
    }

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
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
                <h4>Nomination Submission Form</h4>
            </div>
        </div>
    </div>
    <br>
    <!-- Input form begins here.  -->

    <div class="container">

        <!-- Nominator information could be filled by default since user must login. -->
        <h5>Nominator Information</h5>

        <div class="row">
            <div class="column column-25">
                <label>Full Name</label>
            </div>
            <div class="column column-25">
                <input type="text" placeholder="First Name" id="nominatorFirstName"
                       name="nominatorFirstName">
            </div>
            <div class="column column-25">
                <input type="text" placeholder="Last Name" id="nominatorLastName"
                        name="nominatorLastName">
            </div>
        </div>

        <div class="row">
            <div class="column column-25">
                <label>E-mail Address</label>
            </div>
            <div class="column column-50">
                <input type="text" id="nominatorEmail"
                       name="nominatorEmail">
            </div>
        </div>

        <h5>Nominee Information</h5>

        <div class="row">
            <div class="column column-25">
                <label>First and Last Name</label>
            </div>
            <div class="column column-25">
                <input type="text" placeholder="First Name" id="nomineeFirstName"
                       name="nomineeFirstName">
            </div>
            <div class="column column-25">
                <input type="text" placeholder="Last Name" id="nomineeLastName"
                       name="nomineeLastName">
            </div>
        </div>

        <!-- Not sure how we want to allow selection of ranking.
      This will require us to pull from database all the other
        submissions made by this nominator. Some kind of "drag and drop"? -->
        <div class="row">
            <div class="column column-25">
                <label>Ranking</label>
            </div>
            <div class="column column-50">
                <input type="text" id="ranking"
                        name="ranking">
            </div>
        </div>

        <div class="row">
            <div class="column column-25">
                <label>PID</label>
            </div>
            <div class="column column-50">
                <input type="text" id="pid"
                        name="pid">
            </div>
        </div>

        <div class="row">
            <div class="column column-25">
                <label>E-mail Address</label>
            </div>
            <div class="column column-50">
                <input type="text" id="nomineeEmail"
                        name="nomineeEmail">
            </div>
        </div>

        <div class="row">
            <div class="column column-50">
                <label>Currently a Ph.D. student in the Department of Computer Science?</label>
            </div>
            <div class="column column-25">
                <select id="currentPHD" name="currentPHD">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    <option value="default" selected>-</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="column column-50">
                <label>Newly admitted Ph.D. student?</label>
            </div>
            <div class="column column-25">
                <select id="newPHD" name="newPHD">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    <option value="default" selected>-</option>
                </select>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="column column-75">
                <blockquote>
                    <p>
                        Once the nominee has successfully provides the requested information, you will recieve an email with a link to the nominee's information page. You must verify the information to complete the nomination process.
                    </p>
                    <p id="userMessage"></p>
                </blockquote>
            </div>
        </div>
        <div class="row">
            <div class="column column-offset-25">
                <input type="submit" value="Submit Nomination" onclick="return validateForm()" method="post" action="nominator.php">
            </div>
        </div>
    </div>
</form>

</div>

<br>

</body>

</html>