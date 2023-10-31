<?php
include '../connection.php';

$response = array();
$uid = $_POST['userID'];

$query = mysqli_query($con, "SELECT
    (SELECT Deposit_Paid FROM users WHERE ID='$uid') AS DepositAmt,
    (SELECT Date_Time FROM users  WHERE ID='$uid') AS AmtDepoDate,
    (SELECT sum(pendingAmt) FROM recent_transactions WHERE cust_id = '$uid') AS PendingAmt,
    (SELECT rate FROM m_meter_rate) AS MeterReadingRate;");

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
