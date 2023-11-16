<?php
include '../connection.php';

$query = mysqli_query($con, "SELECT *
FROM m_rooms_floors
ORDER BY ID DESC");
$floorCount;
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $floorCount = $row['floors'];
    }
} else {
    $result = array();
}

$optionString = '<option value="" selected>Select</option>';
$result[] = $optionString;
if (!$query) {
    die('Error: ' . mysqli_error($con));
} else {
    $result[] = generateFloorOptions($floorCount);
}
function generateFloorOptions($count)
{
    $floorNum = 0;
    $options = array();

    for ($i = 0; $i < $count; $i++) {
        $floorText = '';

        if ($floorNum === 0) {
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

        $options[] = '<option value="' . $floorNum . '">' . $floorText . '</option';
        $floorNum++;

        if ($floorNum === 10) {
            $floorNum = 1;
        }
    }

    return $options;
}


header('Content-Type:application/json');
echo json_encode($result);
