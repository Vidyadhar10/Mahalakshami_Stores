<?php
include '../connection.php';

$uid = $_POST['userID'];
$task = $_POST['task'];
if ($task == 'approve') {
    $query = mysqli_query($con, "UPDATE users
                                     INNER JOIN requests ON users.ID = requests.userID
                                     SET users.isAuthorized = 1,
                                         users.Room_No = requests.room_num,
                                         users.Floor_No = requests.floor_num,
                                         requests.isRequested = 0
                                     WHERE users.ID = requests.userID
                                     AND users.ID = $uid;");
} else {
    $query = mysqli_query($con, "UPDATE requests
                                SET isRequested = 2
                                WHERE  requests.userID = $uid;");
}
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
