<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include "connection.php";

if (isset($_POST['mobnumber']) && isset($_POST['PasswordText'])) {
    $uname = $_POST['mobnumber'];
    $pas = $_POST['PasswordText'];
    $pass = md5($pas);

    $result = mysqli_query($con, "INSERT INTO `users` (`Mobile_No`,`Password`)
    VALUES ('$uname','$pass')");

    if ($result) {
        $response = array(
            "success" => true
        );
    } else {
        $response = array(
            "success" => false
        );
        die('Error: ' . mysqli_error($con));
    }
}
mysqli_close($con);

header('Content-Type: application/json');
echo json_encode($response);
