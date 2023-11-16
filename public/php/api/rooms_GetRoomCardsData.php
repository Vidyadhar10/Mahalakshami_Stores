<?php
include '../connection.php';


$query = mysqli_query($con, "SELECT
                            rms.*,
                            rty.room_type,
                            COUNT(usr.ID) as roomTenants
                            FROM `rooms` AS rms
                            INNER JOIN `m_rooms_type` AS rty ON rty.ID = rms.room_type
                            LEFT JOIN `users` AS usr ON usr.Room_No = rms.room_no AND usr.Floor_No = rms.floor AND usr.isAdmin <> 1
                            GROUP BY rms.ID, rty.room_type;");
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $row['available'] = $row['room_capacity'] - $row['roomTenants'];
        $row['floorInwords'] = generateFloorInWords($row['floor']);
        $response[] = $row;
    }
} else {
    $response = array();
}
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
header('Content-Type:application/json');
echo json_encode($response);

function generateFloorInWords($floorNum)
{

    $floorText = '';

    if ($floorNum == 0) {
        $floorText = 'Ground Floor';
    } elseif ($floorNum === 1) {
        $floorText = '1st Floor';
    } elseif ($floorNum % 10 == 1 && $floorNum != 11) {
        $floorText = $floorNum . 'st Floor';
    } elseif ($floorNum % 10 == 2 && $floorNum != 12) {
        $floorText = $floorNum . 'nd Floor';
    } elseif ($floorNum % 10 == 3 && $floorNum != 13) {
        $floorText = $floorNum . 'rd Floor';
    } else {
        $floorText = $floorNum . 'th Floor';
    }

    return $floorText;
}
