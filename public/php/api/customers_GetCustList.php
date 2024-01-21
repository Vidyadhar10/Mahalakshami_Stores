<?php
include '../connection.php';
session_start();
$userID = $_SESSION['UserID'];

if (isset($_POST['roomID'])) {
    $roomID = $_POST['roomID'];
    //card data
    $query2GetCardData = mysqli_query($con, "SELECT
                                                rty.room_type,
                                                rms.*,
                                                IFNULL(COUNT(usr.ID), 0) as roomTenants,
                                                (SELECT meter_rate from m_default_settings where userID=$userID) AS meterRate
                                            FROM `rooms` AS rms
                                            LEFT JOIN users AS usr ON rms.room_no = usr.Room_No
                                            AND rms.floor = usr.Floor_No
                                            AND usr.isAdmin <> 1
                                            LEFT JOIN `m_rooms_type` AS rty ON rty.ID = rms.room_type
                                            WHERE rms.ID = $roomID
                                            AND rms.created_by=$userID
                                            GROUP BY rms.ID, rty.room_type");
    if (!$query2GetCardData) {
        die('Error: ' . mysqli_error($con));
    }
    while ($row = $query2GetCardData->fetch_assoc()) {
        $row['available'] = $row['room_capacity'] - $row['roomTenants'];
        $row['floorInwords'] = generateFloorInWords($row['floor']);
        $cardData[] = $row;
    }

    $response['CardData'] = $cardData;

    $query2GetUserData = mysqli_query($con, "SELECT usr.Account_No, usr.Room_No, usr.Floor_No,
                                usr.Name, usr.Designation, usr.Profile_Photo,
                                usr.Date_Time, usr.ID AS userID,
                                rty.room_type,
                                rms.*, COUNT(usr.ID) as roomTenants
                                FROM `users` AS usr
                                INNER JOIN `rooms` AS rms ON rms.room_no = usr.Room_No AND usr.Floor_No = rms.floor
                                LEFT JOIN `m_rooms_type` AS rty ON rty.ID = rms.room_type
                                WHERE rms.ID = $roomID
                                AND usr.isAdmin <> 1
                                AND usr.created_by_or_approved_by = $userID
                                GROUP BY usr.ID;");
    if (!$query2GetUserData) {
        die('Error: ' . mysqli_error($con));
    }
    if (mysqli_num_rows($query2GetUserData) > 0) {
        while ($row = $query2GetUserData->fetch_assoc()) {
            $userData[] = $row;
        }
        $response['userData'] = $userData;
    } else {
        $response['userData'] = array();
    }
} else {
    $query = mysqli_query($con, "SELECT usr.Account_No, usr.Room_No, usr.Floor_No,
                                    usr.Name, usr.Designation, usr.Profile_Photo,
                                    usr.Date_Time, usr.ID AS userID,
                                    rty.room_type,
                                    rms.*,
                                    (SELECT
                                          COALESCE(SUM(
                                            (txn.`ongoing_meter_reading` - txn.`previous_meter_reading`)
                                            * txn.`meter_rate` + txn.`rent` - txn.`amt_paid`),
                                            0)
                                        - COALESCE((SELECT SUM(sub_txn.`amt_paid`) FROM transactions AS sub_txn
                                        WHERE sub_txn.`ongoing_meter_reading` IS NULL
                                        AND sub_txn.`txn_by_or_under_admin` = $userID),
                                        0) AS PendingAmt FROM transactions AS txn
                                        WHERE txn.txn_of_room_no = usr.Room_No) AS PendingAmt FROM
                                    `users` AS usr
                                    INNER JOIN `rooms` AS rms ON rms.room_no = usr.Room_No
                                    LEFT JOIN `m_rooms_type` AS rty ON rty.ID = rms.room_type
                                    WHERE usr.isAdmin <> 1
                                    AND usr.created_by_or_approved_by = $userID
                                    GROUP BY usr.ID;");
    if (!$query) {
        die('Error: ' . mysqli_error($con));
    }
    if (mysqli_num_rows($query) > 0) {
        while ($row = $query->fetch_assoc()) {
            $row['floorInwords'] = generateFloorInWords($row['floor']);
            $userData[] = $row;
        }
        $response['userData'] = $userData;
    } else {
        $response['userData'] = array();
    }
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
