<?php
session_start();
include '../connection.php';

$userID = $_SESSION['UserID'];
$response = array();

$query = mysqli_query($con, "SELECT * FROM m_rooms_type;"); // Change this to select from a single table

if ($query) {
    $result = array(); // Initialize an empty array to store the results

    while ($row = mysqli_fetch_assoc($query)) {
        $result['room_type'][] = $row;
    }

    // Repeat the above process for other tables
    $query = mysqli_query($con, "SELECT * FROM m_default_settings WHERE userID = $userID;");
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result['rooms_floors'][]['floors'] = $row['floors'];
            $result['rooms_per_floor'][]['room_per_floor'] = $row['rooms_per_floor'];
            $result['meter_rate'][]['rate'] = $row['meter_rate'];
        }
    } else {
        die('Error: ' . mysqli_error($con));
    }


    $response = $result; // Store the result in $response
} else {
    die('Error: ' . mysqli_error($con));
}


header('Content-Type:application/json');
echo json_encode($response);
