<?php
session_start();
$userID = $_SESSION['UserID'];
$isadmin = $_SESSION['AdminStatus'];

include '../connection.php';

if ($isadmin == 1) {
    $query = mysqli_query($con, "SELECT i.*,
                                ic.category_name,
                                urs.Name, urs.Designation,urs.Profile_Photo
                                FROM issues AS i
                                INNER JOIN users AS urs
                                ON i.raised_by = urs.ID
                                INNER JOIN issues_category AS ic
                                ON i.category = ic.ID
                                WHERE i.under_admin_id = $userID
                                ORDER BY i.ID DESC;");
} else {
    $query = mysqli_query($con, "SELECT i.*,
                                ic.category_name,
                                urs.Name, urs.Designation,urs.Profile_Photo
                                FROM issues AS i
                                INNER JOIN users AS urs
                                ON i.raised_by = urs.ID
                                INNER JOIN issues_category AS ic
                                ON i.category = ic.ID
                                WHERE i.raised_by = $userID
                                ORDER BY i.ID DESC;");
}
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
