<?php
include '../connection.php';

session_start();
$userID = $_SESSION['UserID'];

$rowid = $_POST['rowid'];
$ititle = $_POST['ititle'];
$icategory = $_POST['icategory'];
$idescription = $_POST['idescription'];

$query = mysqli_query($con, "UPDATE issues SET
                                title='$ititle',
                                category='$icategory',
                                description='$idescription',
                                updated_by=$userID
                                WHERE ID = $rowid;");
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
