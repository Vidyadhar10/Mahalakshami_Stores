<?php
include '../connection.php';

$response = array();
$uid = $_POST['userID'];
$roomno = $_POST['roomno'];

$query = mysqli_query($con, "SELECT
(SELECT Deposit_Paid FROM users WHERE ID='$uid') AS DepositAmt,
(SELECT Date_Time FROM users WHERE ID='$uid') AS AmtDepoDate,
(SELECT rate FROM m_meter_rate) AS MeterReadingRate,
(
    SELECT SUM((`ongoing_meter_reading` - `previous_meter_reading`) * `meter_rate` + `rent` - `amt_paid`)
    - (SELECT SUM(`amt_paid`) FROM transactions WHERE `ongoing_meter_reading` IS NULL)
) AS PendingAmt
FROM transactions
WHERE txn_of_room_no = $roomno;");

if ($query) {
    $row = mysqli_fetch_assoc($query);

    $response['DepositAmt'] = $row['DepositAmt'];
    $response['AmtDepoDate'] = $row['AmtDepoDate'];
    $response['PendingAmt'] = $row['PendingAmt'];
    $response['MeterReadingRate'] = $row['MeterReadingRate'];
} else {
    die('Error: ' . mysqli_error($con));
}

header('Content-Type:application/json');
echo json_encode($response);
