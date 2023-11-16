<?php
include '../connection.php';

if (isset($_POST['userID'])) {
    $id = $_POST['userID'];
    $queryString = "SELECT rt.*
    FROM `transactions` AS rt
    INNER JOIN users AS u
    ON u.Room_No = rt.txn_of_room_no
    WHERE u.ID = $id
    ORDER BY rt.datetime;";
} else {
    $RoomNo = $_POST['roomNo'];
    $floorNo = $_POST['floorNo'];
    $queryString = "SELECT rt.*
    FROM `transactions` AS rt
    WHERE rt.txn_of_room_no = $RoomNo
    AND rt.floor_no = $floorNo
    ORDER BY rt.datetime;";
}

$query = mysqli_query($con, $queryString);
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $result[] = $row;
    }
} else {
    $result = array();
}
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
header('Content-Type:application/json');
echo json_encode($result);
