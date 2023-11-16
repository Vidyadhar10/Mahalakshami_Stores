<?php
include '../connection.php';

$query = mysqli_query($con, "SELECT * FROM requests AS rq
                                INNER JOIN users AS urs
                                ON rq.userID = urs.ID
                                WHERE rq.isRequested = 1
                                ORDER BY rq.ID DESC;");
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $row['floorInwords'] = generateFloorInWords($row['floor_num']);
        $result[] = $row;
    }
} else {
    $result = array();
}
header('Content-Type:application/json');
echo json_encode($result);


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
