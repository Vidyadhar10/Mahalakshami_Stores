<?php
session_start();
$userID = $_SESSION['UserID'];

include '../connection.php';

$query = mysqli_query($con, "SELECT u.*, rt.cust_id, rt.datetime, rt.amt_paid, u.Floor_No
    FROM `transactions` AS rt
    INNER JOIN users AS u
    ON u.Room_No = rt.txn_of_room_no
    AND u.Floor_No = rt.floor_no
    AND rt.cust_id=u.ID
    WHERE u.isAdmin <> 1
    AND rt.txn_by_or_under_admin = $userID
    -- group by rt.cust_id
    ORDER BY rt.datetime DESC;");
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $response['AccNo'] = $row['Account_No'];
        $response['Room_No'] = $row['Room_No'];
        $response['Floor_No'] = generateFloorInWords($row['Floor_No']);
        $response['Name'] = $row['Name'];
        $response['Designation'] = $row['Designation'];
        $response['Profile_Photo'] = $row['Profile_Photo'];
        $response['amt_paid'] = $row['amt_paid'];
        $response['ID'] = $row['ID'];
        $response['datetime'] = $row['datetime'];
        $result[] = $response;
    }
} else {
    $result = array();
}
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
header('Content-Type:application/json');
echo json_encode($result);


function generateFloorInWords($floorNum)
{

    $floorText = '';

    if ($floorNum == 0) {
        $floorText = 'Ground Floor';
    } elseif ($floorNum === 1) {
        $floorText = '1st Floor';
    } elseif ($floorNum % 10 == 1 && $floorNum != 11) {
        $floorText = $floorNum . 'st Floor';
    } elseif ($floorNum % 10 == 2 && $floorNum != 12) {
        $floorText = $floorNum . 'nd Floor';
    } elseif ($floorNum % 10 == 3 && $floorNum != 13) {
        $floorText = $floorNum . 'rd Floor';
    } else {
        $floorText = $floorNum . 'th Floor';
    }

    return $floorText;
}
