<?php
include '../connection.php';

$id = $_POST['rowid'];

$query = mysqli_query($con, "SELECT * FROM users AS u
WHERE u.ID = $id");
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $result[] = $row;
    }
} else {
    $result = array();
}
header('Content-Type:application/json');
echo json_encode($result);
