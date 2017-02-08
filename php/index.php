<?php
/**
 * Created by PhpStorm.
 * User: dougwoodrow
 * Date: 4/10/16
 * Time: 20:13
 */

include('./database/DatabaseRepository.php');

$database = new DatabaseRepository();

echo($database->returnString());