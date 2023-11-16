<?php
include '../connection.php';

$query = mysqli_query($con, "SELECT u.ID, u.Name, u.Account_No, u.Room_No,
(SELECT rt.ongoing_meter_reading FROM transactions AS rt WHERE u.ID = rt.cust_id ORDER BY rt.ID DESC LIMIT 1) AS prevMeterReading
FROM users AS u
WHERE u.isAdmin <> 1 and isAuthorized = 1
ORDER BY u.ID DESC");
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
$optionString = '<option value="" selected>Select</option>';
$result[] = $optionString;
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $optionString = '<option value="' . $row['Room_No'] . '">' . $row['Name'] . ' (' . $row['Account_No'] . ')</option>';
        $result[] = $optionString;
    }
} else {
    $result = array();
}
header('Content-Type:application/json');
echo json_encode($result);
