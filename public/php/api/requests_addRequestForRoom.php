<?php
include '../connection.php';
session_start();
$userID = $_SESSION['UserID'];
$rmid = $_POST['rmid'];
$admid = $_POST['admid'];

// check request by this user already exist?
$queryToCheck = mysqli_query($con, "SELECT rq.ID FROM requests AS rq
                                    INNER JOIN rooms AS rm
                                    ON rm.ID = rq.room_id
                                    WHERE rq.userID = $userID
                                    AND rm.created_by = $admid;");
if (mysqli_num_rows($queryToCheck) > 0) {
    $responce = array(
        "success" => false,
        "message" => "Already requested for a room of this residency"
    );
} else {

    $query = mysqli_query($con, "INSERT INTO requests
                                (userID, room_id, isRequested)
                             VALUES
                                ($userID,
                                $rmid,
                                1);");

    $queryToNotification = mysqli_query($con, "INSERT INTO notifications (title,notification_for, notification_by)
                                            VALUES
                                            ('A new room details and booking request has been
                                            submitted by a user. Please review the details and take 
                                            necessary actions.',
                                            (SELECT created_by FROM rooms WHERE ID = $rmid),
                                            $userID)");
    if (!$query && !$queryToNotification) {
        die('Error: ' . mysqli_error($con));
        $responce = array(
            "success" => false
        );
    } else {
        $responce = array(
            "success" => true
        );
    }
}

header('Content-Type:application/json');
echo json_encode($responce);
