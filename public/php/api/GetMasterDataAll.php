<?php
include '../connection.php';

$response = array();

$query = mysqli_query($con, "SELECT * FROM m_rooms_type;"); // Change this to select from a single table

if ($query) {
    $result = array(); // Initialize an empty array to store the results

    while ($row = mysqli_fetch_assoc($query)) {
        $result['room_type'][] = $row;
    }

    // Repeat the above process for other tables
    $query = mysqli_query($con, "SELECT * FROM m_rooms_deposit;");
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result['room_depo'][] = $row;
        }
    } else {
        die('Error: ' . mysqli_error($con));
    }

    $query = mysqli_query($con, "SELECT * FROM m_rooms_floors;");
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result['rooms_floors'][] = $row;
        }
    } else {
        die('Error: ' . mysqli_error($con));
    }

    $query = mysqli_query($con, "SELECT * FROM m_rooms_per_floor;");
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result['rooms_per_floor'][] = $row;
        }
    } else {
        die('Error: ' . mysqli_error($con));
    }
    $query = mysqli_query($con, "SELECT * FROM m_meter_rate;");
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result['meter_rate'][] = $row;
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
