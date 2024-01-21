<?php
session_start();
$userID = $_SESSION['UserID'];

include '../connection.php';

$query = mysqli_query($con, "SELECT * FROM users WHERE ID = $userID");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $name = $row['Name'];
        $Address = $row['Address'];
        $Profile_Photo = $row['Profile_Photo'];
        $Documents_All = $row['Documents_All'];
        $tnc = $row['tncAgreed'];
    }
    if ($name == '' || $Address == '' || $Profile_Photo == "" || $Documents_All == "" || $tnc == 0) {
        $response = array(
            "success" => false,
            "message" => "Not updated profile details yet."
        );
    } else {
        $response = array(
            "success" => true,
            "message" => "admin added location already"
        );
    }
} else {
    $response = array(
        "success" => false,
        "message" => "admin has not added location yet."
    );
}
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
header('Content-Type:application/json');
echo json_encode($response);
