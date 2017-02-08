<?php

namespace App\Services\EmailService;

class EmailService
{

    public function createNomineeEmail($emailAddress, $pid)
    {
        mail($emailAddress, "New Nomination for You!", "You have a new nomination for you! Access it at http://localhost:3000/nominee.php?pid=" . $pid);
    }

    public function createGCUserEmail($emailAddress, $username, $password)
    {
        mail($emailAddress, "New User Account for You!", "You have a new account! Access it at http://localhost:3000/index.php Username: " . $username . " Password: " . $password);
    }

}