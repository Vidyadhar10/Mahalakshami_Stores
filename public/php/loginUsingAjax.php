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


    $result = mysqli_query($con, "SELECT * FROM `users`
    WHERE `Mobile_No` = '$uname'
    AND `Password` = '$pass'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if ($row['Mobile_No'] === $uname && $row['Password'] === $pass) {
            $_SESSION['AdminStatus'] = $row['isAdmin'];
            $_SESSION['UserID'] = $row['ID'];
            $_SESSION['isAuthorized'] = $row['isAuthorized'];

            $response = array(
                "success" => true
            );
        } else {
            $response = array(
                "success" => false
            );
        }
    } else {
        $response = array(
            "success" => false,
        );
    }
}
mysqli_close($con);

header('Content-Type: application/json');
echo json_encode($response);
