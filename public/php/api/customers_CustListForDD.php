<?php
include '../connection.php';

$roomNo = $_POST['roomno'];
$floorNo = $_POST['floorno'];
$query = mysqli_query($con, "SELECT u.ID, u.Name, u.Account_No, u.Room_No,
(SELECT rt.ongoing_meter_reading FROM transactions AS rt
WHERE u.ID = rt.cust_id AND rt.ongoing_meter_reading IS NOT NULL ORDER BY rt.ID DESC LIMIT 1) AS prevMeterReading
FROM users AS u
WHERE u.isAdmin <> 1 AND isAuthorized = 1
AND u.Room_No = $roomNo AND u.Floor_No = $floorNo
ORDER BY u.ID DESC");
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
$optionString = '<option value="" selected>Select</option>';
$result[] = $optionString;
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $optionString = '<option value="' . $row['ID'] . '">' . $row['Name'] . ' (' . $row['Account_No'] . ')</option>';
        $result[] = $optionString;
        $allData[] = $row;
    }
    // $allData[] = $normal;
} else {
    $result[] = array();
    $allData[] = array();
}
$responce['options_data'] = $result;
$responce['non_option_data'] = $allData;
header('Content-Type:application/json');
echo json_encode($responce);
