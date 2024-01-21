<?php
include '../connection.php';
session_start();
$userID = $_SESSION['UserID'];

$txntype = $_POST['txntype'];

$custid = $_POST['custid'];
$amtpaid = $_POST['amtpaid'];
$noteVal = $_POST['noteVal'];
$UID = $_POST['uid'];


$roomid = $_POST['roomid'];
$queryToGetRoomNoAndFloorNum = mysqli_query($con, "SELECT room_no, floor, mtr.meter_rate
                                        FROM rooms AS rm
                                        JOIN m_default_settings AS mtr
                                        WHERE rm.ID = '$roomid' 
                                        AND mtr.userID = '$userID'");
if (!$queryToGetRoomNoAndFloorNum) {
    die('Error: ' . mysqli_error($con));
}
$row = $queryToGetRoomNoAndFloorNum->fetch_assoc();
$RoomNo = $row['room_no'];
$FloorNo = $row['floor'];
$meterRate = $row['meter_rate'];

if ($txntype != 'monthly') {

    $query = mysqli_query($con, "INSERT INTO transactions
    (`cust_id`, `floor_no`, `txn_of_room_no`, `meter_rate`, `amt_paid`, `txn_by_or_under_admin`)
    VALUES ('$custid','$FloorNo','$RoomNo','$meterRate','$amtpaid','$UID')");
} else {
    $prevReading = $_POST['prevReading'];
    $ongoingReading = $_POST['ongoingReading'];
    $rentValue = $_POST['rentValue'];
    $query = mysqli_query($con, "INSERT INTO transactions
    (`cust_id`, `floor_no`, `txn_of_room_no`, `meter_rate`, `previous_meter_reading`,
    `ongoing_meter_reading`,`rent`, `amt_paid`, `txn_by_or_under_admin`)
    VALUES ('$custid','$FloorNo','$RoomNo','$meterRate','$prevReading',
    '$ongoingReading','$rentValue','$amtpaid','$UID')");
}

if ($query) {
    $response = array(
        "success" => true,
        "roomNo" => $RoomNo,
        "floorNo" => $FloorNo
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
