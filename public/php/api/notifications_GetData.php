<?php
include '../connection.php';

$usrid = $_POST['usrID'];
$queryToGetUnread = mysqli_query($con, "SELECT COUNT(*) AS TotalUnreadCount FROM notifications
                                        WHERE notification_for = $usrid AND readStatus = 0;");
if (mysqli_num_rows($queryToGetUnread) > 0) {
    while ($row = $queryToGetUnread->fetch_assoc()) {
        $result['TotalArray'] = $row;
    }
} else {
    $result['TotalArray'] = array();
}

$query = mysqli_query($con, "SELECT * FROM notifications
                                WHERE notification_for = $usrid
                                ORDER BY ID DESC;");
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $other[] = $row;
    }
    $result['notiDataArray'] = $other;
} else {
    $result['notiDataArray'] = array();
}
$responce = $result;
header('Content-Type:application/json');
echo json_encode($responce);
