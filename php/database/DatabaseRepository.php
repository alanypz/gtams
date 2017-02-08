<?php

namespace App\Database\DatabaseRepository;

use App\Utility as Utility;

use \mysqli as mysqli;

/**
 * This class acts as the DatabaseRepositiory where all database logic is contained and maintained. This layer has a
 * constructor by which a connection to the database is automatically created on instantiation of the class.
 */
class DatabaseRepository
{

    private $serverName = "127.0.0.1";
    private $userName = "root";
    private $password = "password";
    private $conn = null;

    /**
     * Instantiates with a MySQL instance object
     * DatabaseRepository constructor.
     */
    function __construct()
    {
        // Create connection
        $this->conn = new mysqli($this->serverName, $this->userName, $this->password);

        // Check connection
        if ($this->conn->connect_error) {
            throw new \Exception("Caught exception:" . $this->conn->connect_error);
        }
    }

    /**
     * Simple compare function for ranking average score in score table
     * Used by: $this->getScores
     * @param $a
     * @param $b
     * @return int
     */
    function compare($a, $b)
    {
        return strcmp($b->averageScore->avg, $a->averageScore->avg);
    }

    /**
     * Run all migrations on the database
     */
    public function migrate()
    {
        $this->conn->exec("CREATE DATABASE gtass");
    }

    /* User Functionality */

    /**
     * Checks login creds for a given user
     * @param $username
     * @param $password
     * @return bool returns true if creds are correct, otherwise false
     */
    public function loginUser($username, $password)
    {
        if ($username && $password) {
            $query = "SELECT * FROM project.users WHERE project.users.username = '" . $username . "'";
            $result = $this->conn->query($query);

            $user = $result->fetch_object();

            if ($user->password == $password) {
                return true;
            }
            else {
                return false;
            }
        }
    }

    /**
     * Get user by username
     * @param $username
     * @return object|\stdClass
     */
    public function getUserByUsername($username)
    {
        Utility::consoleLog("Getting a User by username: " . $username);
        $query = "SELECT * FROM project.users WHERE project.users.username = '" . $username . "'";
        $result = $this->conn->query($query);
        return $result->fetch_object();
    }

    /**
     * Create a GC User
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $username
     * @param $password
     */
    public function createGCUser($firstName, $lastName, $email, $username, $password)
    {
        Utility::consoleLog("Creating a GC User with paramaters: " . $firstName . ", " . $lastName . ", " . $email . ", " . $username . ", " . $password);
        $query = "INSERT INTO project.users (fname, lname, email, password, username, role) VALUES ( '$firstName', '$lastName', '$email', '$password', '$username', 'gc_member')";
        $result = $this->conn->query($query);
        Utility::consoleLog($result);
    }

    /**
     * Update a username
     * @param $newUsername
     * @param $oldUsername
     */
    public function updateUsername($newUsername, $oldUsername)
    {
        Utility::consoleLog("Updating a username. Old username: " . $oldUsername . " with New username: " . $newUsername);
        $queryUpdate = "UPDATE project.users SET project.users.username = '" . $newUsername . "' WHERE project.users.username = '" . $oldUsername . "'";
        $this->conn->query($queryUpdate);
    }

    /**
     * Update a password
     * @param $oldUsername
     * @param $newPassword
     * @param $oldPassword
     */
    public function updatePassword($oldUsername, $newPassword, $oldPassword)
    {
        Utility::consoleLog("Updating a password for user" . $oldUsername);
        $queryUpdate = "UPDATE project.users SET project.users.password = '" . $newPassword . "' WHERE project.users.username = '" . $oldUsername . "' AND project.users.password = '" . $oldPassword . "'";
        $this->conn->query($queryUpdate);
    }

    /**
     * Creates a nominator in the DB
     * @param $firstName
     * @param $lastName
     * @param $email
     */
    public function createNominator($firstName, $lastName, $email) {
        $query = "INSERT INTO project.nominators (email, fname, lname) VALUES ( '$email', '$firstName', '$lastName')";
        $this->conn->query($query);
    }

    /**
     * Creates a nominee in the DB
     * @param $firstName
     * @param $lastName
     * @param $ranking
     * @param $pid
     * @param $emailAddress
     * @param $currentPhd
     * @param $newPhd
     */
    public function createNominee($firstName, $lastName, $ranking, $pid, $emailAddress, $currentPhd, $newPhd, $nominatorEmail) {
        Utility::consoleLog($firstName);
        Utility::consoleLog($lastName);
        Utility::consoleLog($ranking);
        Utility::consoleLog($pid);
        Utility::consoleLog($emailAddress);
        Utility::consoleLog($currentPhd);
        Utility::consoleLog($newPhd);
        $query = "INSERT INTO project.nominees (pid, email, fname, lname, rank, current_phd, new_phd, nominated_by) VALUES ('$pid', '$emailAddress', '$firstName', '$lastName', '$ranking', '$currentPhd', '$newPhd', '$nominatorEmail')";
        $result = $this->conn->query($query);
    }

    /**
     * @param $firstName
     * @param $lastName
     * @param $pid
     * @param $emailAddress
     * @param $phoneNumber
     * @param $currentPhd
     * @param $semestersAsGradStudent
     * @param $speakTest
     * @param $semestersAsGta
     */
    public function updateNominee($firstName, $lastName, $emailAddress, $phoneNumber, $currentPhd, $semestersAsGradStudent, $speakTest, $semestersAsGta, $gpa, $currentPhdLname, $currentPhdFname) {
        $query = "UPDATE project.nominees SET (email, fname, lname, current_phd, current_phd_fname, current_phd_lname, phone_number, number_of_graduate_semesters, passed_speak_test, number_of_semesters_as_gta, gpa_for_graduate_courses) VALUES ('$emailAddress', '$firstName', '$lastName', '$currentPhd', '$currentPhdFname', '$currentPhdLname', '$phoneNumber', '$semestersAsGradStudent', '$speakTest', '$semestersAsGta', '$gpa')";
        $result = $this->conn->query($query);
    }

    /**
     * Gets the information needed for a score table and all associated information
     * @param bool $sortByNominator
     * @param bool $sortByAverageScore
     * @return array
     */
    public function getScores($sortByNominator = false, $sortByAverageScore = false)
    {

        // The final array to return with all of the scores
        $scores = [];

        // Query for nominees submitted by nominators
        if (!$sortByNominator && ! $sortByAverageScore)
        {
            $queryNominees = "SELECT * FROM project.nominations";
        }

        else if ($sortByNominator)
        {
            Utility::consoleLog("Sorting by Nominator");
            $queryNominees = "SELECT * FROM project.nominations ORDER BY project.nominations.nominated_by ASC";
        }

        else
        {
            $queryNominees = "SELECT * FROM project.nominations ORDER BY project.nominations.nominated_by ASC";
        }

        $resultNominees = $this->conn->query($queryNominees);

        // Push the nominees data to the scores array
        while ($data = $resultNominees->fetch_object()) {

            $objectToPush = new \stdClass();
            $objectToPush->data = $data;

            $queryForAverageScore = "SELECT pid, AVG(rank) avg FROM project.nominations WHERE project.nominations.pid = '" . $data->pid . "' GROUP BY pid;";
            $resultAverage = $this->conn->query($queryForAverageScore);
            $objectToPush->averageScore = $resultAverage->fetch_object();

            array_push($scores, $objectToPush);
        }

        if ($sortByAverageScore)
        {
            Utility::consoleLog("Sorting by average Score");
            usort($scores, array($this, "compare"));
        }

        return $scores;
    }

    /**
     * Gets the scores for a previous session
     * @param $sessionId
     * @return array
     */
    public function getPreviousScores($sessionId)
    {
        if ($sessionId !== null)
        {
            Utility::consoleLog("Getting all of the Previous Scores for Session ID: " . $sessionId);
            // The final array to return with all of the scores
            $scores = [];
            $queryNominees = "SELECT * FROM project.nominations n WHERE n.session_id = '" . $sessionId . "'";

            $resultNominees = $this->conn->query($queryNominees);

            // Push the nominees data to the scores array
            while ($data = $resultNominees->fetch_object()) {

                $objectToPush = new \stdClass();
                $objectToPush->data = $data;

                $queryForAverageScore = "SELECT pid, AVG(rank) avg FROM project.nominations WHERE project.nominations.pid = '" . $data->pid . "' GROUP BY pid;";
                $resultAverage = $this->conn->query($queryForAverageScore);
                $objectToPush->averageScore = $resultAverage->fetch_object();

                array_push($scores, $objectToPush);
            }

            Utility::consoleLog($scores);
            return $scores;
        }

        if ($sessionId === null)
        {
            Utility::consoleLog("Getting all of the Previous Scores");
            // The final array to return with all of the scores
            $scores = [];
            $queryNominees = "SELECT * FROM project.nominations";

            $resultNominees = $this->conn->query($queryNominees);

            // Push the nominees data to the scores array
            while ($data = $resultNominees->fetch_object()) {

                $objectToPush = new \stdClass();
                $objectToPush->data = $data;

                $queryForAverageScore = "SELECT pid, AVG(rank) avg FROM project.nominations WHERE project.nominations.pid = '" . $data->pid . "' GROUP BY pid;";
                $resultAverage = $this->conn->query($queryForAverageScore);
                $objectToPush->averageScore = $resultAverage->fetch_object();

                array_push($scores, $objectToPush);
            }

            return $scores;
        }
    }

    /**
     * Gets any incomplete nominees from nominations made by nominators
     * @return array
     */
    public function getIncompleteForms()
    {
        $forms = [];

        $queryBlankNominationNominees = "SELECT * FROM project.nominations WHERE project.nominations.pid NOT IN (SELECT project.nominees.pid FROM project.nominees)";
        $result = $this->conn->query($queryBlankNominationNominees);

        $queryBlankNominationNominees = "SELECT * FROM project.nominations WHERE project.nominations.pid NOT IN (SELECT project.nominees.pid FROM project.nominees)";
        $result = $this->conn->query($queryBlankNominationNominees);

        while ($row = $result->fetch_object())
        {
            array_push($forms, $row);
        }

        Utility::consoleLog($forms);

        return $forms;
    }

    /**
     * Gets all of the sessions in the database
     * @return array
     */
    public function getSessions()
    {
        Utility::consoleLog("Getting all Sessions");
        $query = "SELECT * FROM project.session";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            $sessions = [];

            // Push the advisor data to the array
            while ($session = $result->fetch_object()) {
                array_push($sessions, $session);
            }

            return $sessions;
        }
    }

    /**
     * Creates a session for a given semester/year
     * @param $sessionPeriod
     * @param $sessionYear
     */
    public function createSession($sessionPeriod, $sessionYear, $chairFirstName, $chairLastName, $initiationDeadline, $responseDeadline, $verificationDeadline)
    {
        $query = "INSERT INTO project.session (semester_period, semester_year, gc_chair_member_fname, gc_chair_member_lname, nomination_initiation_deadline, nominator_verification_deadline, nominee_response_deadline) VALUES ('$sessionPeriod', '$sessionYear', '$chairFirstName', '$chairLastName', '$initiationDeadline', '$responseDeadline', '$verificationDeadline')";
        $this->conn->query($query);
    }

    /**
     * Get a nominees information and associated information for the Popup view
     * @param $pid
     * @return \stdClass
     */
    public function getNomineeByPid($pid)
    {
        Utility::consoleLog($pid);
        $query = "SELECT * FROM project.nominees p WHERE p.pid = '" . $pid . "'";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            // Push the nominees & associated data to the array
            while ($nomineeInfo = $result->fetch_object()) {

                $nomineeInfoObject = new \stdClass();
                $nomineeInfoObject->nomineeInfo = $nomineeInfo;

                $queryForCourses = "SELECT * FROM project.courses WHERE project.courses.nominee_pid = '" . $nomineeInfo->pid . "' GROUP BY nominee_pid;";
                $resultCourses = $this->conn->query($queryForCourses);

                $courses = [];
                while ($course = $resultCourses->fetch_object()) {
                    array_push($courses, $course);
                }
                $nomineeInfoObject->courses = $courses;

                $queryForPublication = "SELECT * FROM project.publications WHERE project.publications.nominee_pid = '" . $nomineeInfo->pid . "' GROUP BY nominee_pid;";
                $resultPublication = $this->conn->query($queryForPublication);

                $publications = [];
                while ($publication = $resultPublication->fetch_object()) {
                    array_push($publications, $publication);
                }
                $nomineeInfoObject->publications = $publications;

            }

            Utility::consoleLog($nomineeInfoObject);
            return $nomineeInfoObject;
        }

    }

    /**
     * Gets the Nominator for a given email address
     * @param $email
     * @return object|\stdClass
     */
    public function getNominatorByEmail($email)
    {
        $queryForCourses = "SELECT * FROM project.nominators WHERE project.nominators.email = '" . $email . "'";
        $resultCourses = $this->conn->query($queryForCourses);

        $data = $resultCourses->fetch_object();
        Utility::consoleLog($data);

        return $data;
    }

    /**
     * @param $pid
     * @return array
     */
    public function getPreviousAdvisors($pid)
    {
        Utility::consoleLog($pid);
        $query = "SELECT * FROM project.previous_advisors p WHERE p.nominee_pid = '" . $pid . "'";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            $advisors = [];

            // Push the advisor data to the array
            while ($advisor = $result->fetch_object()) {
                array_push($advisors, $advisor);
            }

            return $advisors;
        }
    }

}