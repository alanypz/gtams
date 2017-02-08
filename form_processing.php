/**
 * Created by PhpStorm.
 * Date: 4/6/2016
 * Time: 1:26 AM
 */
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
    <head>
        <title>Form1</title>
    </head>
    <body>
        <pre>
            <?php
            print_r($_POST);
            ?>
        </pre>
        <br />
        <?php
            $username = $_POST["username"];
            $password = $_POST["password"];

            echo "{$username}: {$password}";
        ?>



    </body>
</html>