<?php
include '../connection.php';

$floorCount = $_POST['flrCnt'];
$enteredRoomNum = $_POST['enteredRoomNum'];
if ($enteredRoomNum != '') {
    $range = explode('-', $enteredRoomNum);
    foreach ($range as $indexVal) {
        $query2 = mysqli_query($con, "SELECT ID FROM rooms where floor = $floorCount and room_no = $indexVal");
        if ($query2 && mysqli_num_rows($query2) > 0) {
            $response = array(
                "success" => true,
                "message" => "Room number $indexVal is already exists on the floor $floorCount"
            );
            break;
        } else {
            $response = array(
                "success" => false
            );
        }
    }
    header('Content-Type:application/json');
    echo json_encode($response);
} else {



    $query = mysqli_query($con, "SELECT
                        (SELECT COUNT(rs.ID) FROM `rooms` AS rs WHERE rs.floor = $floorCount) AS roomCnt,
                        (SELECT room_per_floor FROM `m_rooms_per_floor`) AS roomsPerFloor
                    ");

    $result = mysqli_fetch_assoc($query);

    if ($result['roomCnt'] >= $result['roomsPerFloor']) {
        $roomperflr = $result['roomsPerFloor'];
        $response = array(
            "success" => true,
            "message" => "Room count has exceeded the limit of $roomperflr rooms per floor"
        );
    } else {
        $response = array(
            "success" => false
        );
    }

    if (!$query) {
        $response = array(
            "success" => true
        );
        die('Error: ' . mysqli_error($con));
    }
    header('Content-Type:application/json');
    echo json_encode($response);
}
