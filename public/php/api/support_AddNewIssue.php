<?php
include '../connection.php';

session_start();
$isadmin = $_SESSION['AdminStatus'];

$uid = $_POST['userID'];
$ititle = $_POST['ititle'];
$icategory = $_POST['icategory'];
$idescription = $_POST['idescription'];
if ($isadmin == 1) {
    $query = mysqli_query($con, "INSERT INTO issues (title,category,description, raised_by, under_admin_id)
                                 VALUES ('$ititle', '$icategory', '$idescription', $uid, $uid);");
} else {
    $queryToGetAdmin = mysqli_query($con, "SELECT created_by_or_approved_by FROM users WHERE ID=$uid");
    $idval = mysqli_fetch_assoc($queryToGetAdmin);
    $created_by = $idval['created_by_or_approved_by'];
    $query = mysqli_query($con, "INSERT INTO issues
                                (title,category,description,raised_by,under_admin_id)
                                VALUES ('$ititle', '$icategory', '$idescription', $uid, $created_by);");
}
if (!$query) {
    die('Error: ' . mysqli_error($con));
    $responce = array(
        "success" => false
    );
} else {
    $responce = array(
        "success" => true
    );
}
header('Content-Type:application/json');
echo json_encode($responce);
