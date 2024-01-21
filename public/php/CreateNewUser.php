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
        $getID = mysqli_query($con, "SELECT ID FROM users ORDER BY ID DESC LIMIT 1;");
        $row = mysqli_fetch_assoc($getID);
        $thisUserID = $row['ID'];

        $requestInsertQ = mysqli_query($con, "INSERT INTO requests (userID) values ('$thisUserID');");
        if ($requestInsertQ) {
            $response = array(
                "success" => true
            );
        }
    } else {
        $response = array(
            "success" => false,
            "message" => "mobile num already exists!"
        );
        die('Error: ' . mysqli_error($con));
    }
} elseif (isset($_POST['admin_mob_number']) && isset($_POST['admin_pass_text'])) {
    $uname = $_POST['admin_mob_number'];
    $pas = $_POST['admin_pass_text'];
    $pass = md5($pas);

    $result = mysqli_query($con, "INSERT INTO `users` (`Mobile_No`,`Password`,`isAdmin`)
    VALUES ('$uname','$pass',1)");

    if ($result) {
        $response = array(
            "success" => true
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "mobile num already exists!"
        );
        die('Error: ' . mysqli_error($con));
    }
}
mysqli_close($con);

header('Content-Type: application/json');
echo json_encode($response);
