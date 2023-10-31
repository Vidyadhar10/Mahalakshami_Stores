<?php
include '../connection.php';

$response = array();

$query = mysqli_query($con, "SELECT
    (SELECT COUNT(*) FROM recent_transactions WHERE DATE(`datetime`) = CURDATE()) AS TodaysTxnCount,
    (SELECT SUM(pendingAmt) FROM users) AS totalPendAmt,
    (SELECT COUNT(*) FROM users WHERE isAdmin <> 1 AND isAuthorized = 1) AS TotCustCount,
    (SELECT COUNT(*) FROM rooms) AS TotRoomsCount;");

if ($query) {
    $row = mysqli_fetch_assoc($query);

    $response['TodaysTxnCount'] = $row['TodaysTxnCount'];
    $response['totalPendAmt'] = $row['totalPendAmt'];
    $response['TotCustCount'] = $row['TotCustCount'];
    $response['TotRoomsCount'] = $row['TotRoomsCount'];
} else {
    die('Error: ' . mysqli_error($con));
}

header('Content-Type:application/json');
echo json_encode($response);
