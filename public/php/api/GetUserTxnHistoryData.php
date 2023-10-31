<?php
include '../connection.php';

$uid = $_POST['userID'];

$query = mysqli_query($con, "SELECT rt.*
    FROM `recent_transactions` AS rt
    INNER JOIN users AS u
    ON u.ID = rt.cust_id
    WHERE u.ID = $uid
    ORDER BY rt.datetime DESC;");
if (mysqli_num_rows($query) > 0) {

    while ($row = $query->fetch_assoc()) {

        $result[] = $row;
    }
} else {
    $result = array();
}
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
header('Content-Type:application/json');
echo json_encode($result);
