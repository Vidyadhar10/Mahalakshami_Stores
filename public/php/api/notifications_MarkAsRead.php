<?php
include '../connection.php';

$uid = $_POST['uid'];

$query = mysqli_query($con, "UPDATE notifications
                                SET readStatus = 1
                                WHERE notification_for = $uid;");
if (!$query) {
    die('Error: ' . mysqli_error($con));
    $responce = array(
        "success" => false
    );
} else {
    $responce = array(
        "success" => true
    );
}
header('Content-Type:application/json');
echo json_encode($responce);
