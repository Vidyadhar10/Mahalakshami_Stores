<?php
session_start();
$userID = $_SESSION['UserID'];

include '../connection.php';

$query = mysqli_query($con, "SELECT * FROM locations WHERE admin_id = $userID");
if (mysqli_num_rows($query) > 0) {
    $response = array(
        "success" => true,
        "message" => "admin added location already"
    );
} else {
    $response = array(
        "success" => false,
        "message" => "admin has not added location yet."
        // "show_driver"=> 
    );
}
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
header('Content-Type:application/json');
echo json_encode($response);
