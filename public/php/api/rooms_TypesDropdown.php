<?php
include '../connection.php';

$query = mysqli_query($con, "SELECT *
FROM m_rooms_type
ORDER BY ID DESC");
$optionString = '<option value="" selected>Select</option>';
$result[] = $optionString;
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $optionString = '<option value="' . $row['ID'] . '">' . $row['room_type'] . '</option>';
        $result[] = $optionString;
    }
} else {
    $result = array();
}
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
header('Content-Type:application/json');
echo json_encode($result);
