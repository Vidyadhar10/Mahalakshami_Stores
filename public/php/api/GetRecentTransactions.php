<?php
include '../connection.php';


$query = mysqli_query($con, "SELECT u.*, rt.cust_id, rt.datetime, rt.amt_paid
    FROM `recent_transactions` AS rt
    INNER JOIN users AS u
    ON u.ID = rt.cust_id
    WHERE u.isAdmin <> 1
    ORDER BY rt.datetime DESC;");
while ($row = $query->fetch_assoc()) {
    $response['AccNo'] = $row['Account_No'];
    $response['Room_No'] = $row['Room_No'];
    $response['Name'] = $row['Name'];
    $response['Designation'] = $row['Designation'];
    $response['Profile_Photo'] = $row['Profile_Photo'];
    $response['amt_paid'] = $row['amt_paid'];
    $response['ID'] = $row['ID'];
    $response['datetime'] = $row['datetime'];
    $result[] = $response;
}
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
header('Content-Type:application/json');
echo json_encode($result);
