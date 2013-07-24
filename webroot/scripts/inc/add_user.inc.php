<?php
include_once 'conexion.inc.php';

$firstname    = pg_escape_string($_POST['firstname']);
$surname      = pg_escape_string($_POST['surname']);
$emailaddress = pg_escape_string($_POST['emailaddress']);

$query = "INSERT INTO friends (firstname, surname, emailaddress) VALUES('" . $firstname . "', '" . $surname . "', '" . $emailaddress . "')";
        $result = pg_query($query);
        if (!$result) {
            $errormessage = pg_last_error();
            echo "Error with query: " . $errormessage;
            exit();
        }
        printf ("These values were inserted into the database - %s %s %s", $firstname, $surname, $emailaddress);
        pg_close();
        ?>
