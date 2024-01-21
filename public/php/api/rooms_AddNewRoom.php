<?php
include '../connection.php';

session_start();
$userID = $_SESSION['UserID'];

$RoomAddType = $_POST['RoomAddType'];
$RoomsCount = $_POST['RoomsCount'];

$floorValue = $_POST['floorValue'];
$roomTypeVal = $_POST['roomTypeVal'];
$tenantCapacityVal = $_POST['tenantCapacityVal'];
$DepositAmtVal = $_POST['DepositAmtVal'];
$rentVal = $_POST['rentVal'];
$noteVal = $_POST['noteVal'];
$UID = $_POST['userID'];

$range = explode('-', $RoomsCount);

if (count($range) == 2) {
    $start = intval($range[0]);
    $end = intval($range[1]);

    // Loop through the range
    for ($i = $start; $i <= $end; $i++) {
        $query = mysqli_query($con, "INSERT INTO rooms
            (`floor`, `room_no`, `room_type`, `room_capacity`, `deposit_amt`, `room_rent`, `note`, `created_by`)
            VALUES ('$floorValue','$i','$roomTypeVal','$tenantCapacityVal','$DepositAmtVal','$rentVal', '$noteVal','$UID')");
    }
} else {
    // get the room number using floors and create appropriate
    $queryToGetLastRoomNum = mysqli_query($con, "SELECT room_no
    FROM rooms AS lstRoom
    WHERE floor = '$floorValue'
    and created_by= $userID
    ORDER BY ID DESC LIMIT 1");
    if ($queryToGetLastRoomNum->num_rows > 0) {
        $row = $queryToGetLastRoomNum->fetch_assoc();
        $LastRoomNo = $row['room_no'] + 1;
    } else {
        $LastRoomNo =  1;
    }
    $query = mysqli_query($con, "INSERT INTO rooms
    (`floor`, `room_no`, `room_type`, `room_capacity`, `deposit_amt`, `room_rent`, `note`, `created_by`)
    VALUES ('$floorValue','$LastRoomNo','$roomTypeVal','$tenantCapacityVal','$DepositAmtVal','$rentVal', '$noteVal','$UID')");
}

if ($query) {
    $response = array(
        "success" => true
    );
} else {
    $response = array(
        "success" => false
    );
    die('Error: ' . mysqli_error($con));
}
mysqli_close($con);

header('Content-Type: application/json');
echo json_encode($response);
