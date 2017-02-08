<?php

/**
 * class Dispatch
 * This file routes/dispatches calls to the appropriate resource providers. This file also is the central location
 * for object management.
 */

namespace App;

include(__DIR__.'/database/DatabaseRepository.php');
use App\Database\DatabaseRepository\DatabaseRepository as DatabaseRepository;

include(__DIR__.'/services/EmailService.php');
use App\Services\EmailService\EmailService as EmailService;

include(__DIR__.'/Utility.php');
use App\Utility as Utility;

class Dispatch
{

    private $repository = null;
    private $emailService = null;

    public function __construct()
    {
        $this->repository = new DatabaseRepository();
        $this->emailService = new EmailService();
    }

    public function createGCUser($firstName, $lastName, $email, $username, $password) {
        $this->repository->createGCUser($firstName, $lastName, $email, $username, $password);
        $this->emailService->createGCUserEmail($email, $username, $password);
    }

    public function loginUser($username, $password)
    {
        return $this->repository->loginUser($username, $password);
    }

    public function getUserByUsername($username)
    {
        return $this->repository->getUserByUsername($username);
    }

    public function createNominee($firstName, $lastName, $ranking, $pid, $emailAddress, $currentPhd, $newPhd, $nominatorEmail)
    {
        $this->repository->createNominee($firstName, $lastName, $ranking, $pid, $emailAddress, $currentPhd, $newPhd, $nominatorEmail);
        $this->emailService->createNomineeEmail($emailAddress, $pid);
    }

    public function updateNominee($firstName, $lastName, $emailAddress, $phoneNumber, $currentPhd, $semestersAsGradStudent, $speakTest, $semestersAsGta, $gpa, $currentPhdLname, $currentPhdFname)
    {
        $this->repository->updateNominee($firstName, $lastName, $emailAddress, $phoneNumber, $currentPhd, $semestersAsGradStudent, $speakTest, $semestersAsGta, $gpa, $currentPhdLname, $currentPhdFname);
    }

    public function createNominator($firstName, $lastName, $email)
    {
        $this->repository->createNominator($firstName, $lastName, $email);
    }

    public function updateUsername($newUsername, $oldUsername)
    {
        $this->repository->updateUsername($newUsername, $oldUsername);
    }

    public function updatePassword($oldUsername, $newPassword, $oldPassword)
    {
        $this->repository->updatePassword($oldUsername, $newPassword, $oldPassword);
    }

    public function getSessions()
    {
        return $this->repository->getSessions();
    }

    public function createSession($sessionPeriod, $sessionYear, $chairFirstName, $chairLastName, $initiationDeadline, $responseDeadline, $verificationDeadline)
    {
        $this->repository->createSession($sessionPeriod, $sessionYear, $chairFirstName, $chairLastName, $initiationDeadline, $responseDeadline, $verificationDeadline);
    }

    public function getScores($sortByNominator, $sortByAverageScore)
    {
        return $this->repository->getScores($sortByNominator, $sortByAverageScore);
    }

    public function getPreviousScores($sessionId = null)
    {
        return $this->repository->getPreviousScores($sessionId);
    }

    public function getIncompleteForms()
    {
        return $this->repository->getIncompleteForms();
    }

    public function getNomineeByPid($pid)
    {
        return $this->repository->getNomineeByPid($pid);
    }

    public function getNominatorByEmail($email)
    {
        return $this->repository->getNominatorByEmail($email);
    }

    public function getPreviousAdvisors($pid)
    {
        return $this->repository->getPreviousAdvisors($pid);
    }

}