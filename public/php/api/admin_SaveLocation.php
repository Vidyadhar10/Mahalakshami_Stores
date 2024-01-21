<?php
include '../connection.php';

session_start();
$userID = $_SESSION['UserID'];

$res_name = $_POST['res_name'];
$address_input = $_POST['address_input'];
$stateDropDown = $_POST['stateDropDown'];
$districtInput = $_POST['districtInput'];
$CityInput = $_POST['CityInput'];
$pincodeInput = $_POST['pincodeInput'];

$query = mysqli_query($con, "INSERT INTO locations
    (`residency_name`, `address`, `district`, `state`, `city`, `pincode`, `admin_id`)
    VALUES ('$res_name','$address_input','$districtInput','$stateDropDown','$CityInput','$pincodeInput', '$userID')");

if ($query) {
    $response = array(
        "success" => true
    );
} else {
    $response = array(
        "success" => false
    );
    die('Error: ' . mysqli_error($con));
}
mysqli_close($con);

header('Content-Type: application/json');
echo json_encode($response);
