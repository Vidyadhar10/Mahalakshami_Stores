<?php

// session_start();
// $userID = $_SESSION['UserID'];
// $isadmin = $_SESSION['AdminStatus'];

include '../connection.php';

$query = mysqli_query($con, "SELECT * from issues_category");
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
$optionString = '<option value="" selected>Select</option>';
$result[] = $optionString;
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $optionString = '<option value="' . $row['ID'] . '">' . $row['category_name'] . '</option>';
        $result[] = $optionString;
    }
} else {
    $result = array();
}
header('Content-Type:application/json');
echo json_encode($result);
