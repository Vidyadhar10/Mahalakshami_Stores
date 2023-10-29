<?php
$server = "localhost";
$name = "root";
$pass = "";
$db = "db_mahalakshami_stores";
$con = new mysqli($server, $name, $pass, $db);
if (!$con) {
    die("Error" . mysqli_error($con));
}
