<?php
session_start();
$userID = $_SESSION['UserID'];

include '../connection.php';

$response = array();

//if meter module included
$query = mysqli_query($con, "SELECT
                                (SELECT COUNT(t.TXN_USER_ID)
                                    FROM transactions t
                                    JOIN users_new u ON t.TXN_USER_ID = u.ID
                                    JOIN rooms r ON u.ROOM_ID = r.ID
                                    JOIN locations l ON r.RES_DETAILS_ID = l.ID
                                    WHERE u.ID = $userID OR l.admin_id = $userID
                                    AS TodaysTxnCount,
                                (SELECT COUNT(DISTINCT t.TXN_USER_ID)
                                    FROM transactions t
                                    JOIN users_new u ON t.TXN_USER_ID = u.ID
                                    JOIN rooms r ON u.ROOM_ID = r.ID
                                    JOIN locations l ON r.RES_DETAILS_ID = l.ID
                                    WHERE l.admin_id = $userID AND u.ISADMIN <> 1 AND u.ISAUTHORIZED = 1
                                    AS TotCustCount,
                                (SELECT COUNT(DISTINCT r.ID)
                                    FROM rooms r
                                    JOIN users_new u ON r.ROOM_ID = u.ID
                                    JOIN transactions t ON u.ID = t.TXN_USER_ID
                                    JOIN locations l ON r.RES_DETAILS_ID = l.ID
                                    WHERE l.admin_id = $userID AND u.ISADMIN <> 1 AND u.ISAUTHORIZED = 1
                                    AS TotRoomsCount,
                                (SELECT COALESCE(
                                    SUM((`ongoing_meter_reading` - `previous_meter_reading`) * `meter_rate` + `rent` - `amt_paid`),
                                    0)
                                    - COALESCE((SELECT SUM(`amt_paid`) FROM transactions WHERE `ongoing_meter_reading` IS NULL AND location_id = (SELECT `RES_DETAILS_ID` FROM rooms WHERE `ID` = (SELECT `ROOM_ID` FROM users_new WHERE `ID` = $userID)) AND txn_by_or_under_admin = $userID),0)
                                    )
                                AS totalPendAmt FROM transactions
                                WHERE txn_by_or_under_admin = $userID;");



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
