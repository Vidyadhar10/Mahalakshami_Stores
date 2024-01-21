<?php
session_start();
$userID = $_SESSION['UserID'];

include '../connection.php';

$res_name = $_POST['res_name'];
$res_add = $_POST['res_add'];
$res_district = $_POST['res_district'];
$res_state = $_POST['res_state'];

$query = mysqli_query($con, "INSERT INTO locations (residency_name, address, district, state, admin_id)
                             VALUES ('$res_name', '$res_add', '$res_district', '$res_state', '$userID');");

if (!$query) {
    $response = array(
        "success" => false,
        "message" => "Error while inserting",
        "error" => mysqli_error($con)
    );
} else {
    $response = array(
        "success" => true,
        "message" => "location added successfully"
    );
}
header('Content-Type:application/json');
echo json_encode($result);
