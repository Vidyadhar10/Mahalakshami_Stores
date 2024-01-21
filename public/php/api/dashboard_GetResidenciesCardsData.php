<?php
session_start();
$userID = $_SESSION['UserID'];

include '../connection.php';

$query = mysqli_query($con, "SELECT ls.ID,
                                ls.residency_name,
                                ls.address,
                                ls.district,
                                ds.DistrictName AS district_name,
                                ls.state,
                                ms.StateName AS state_name,
                                ls.city,
                                ls.pincode,
                                ls.admin_id,
                                ls.datetime,
                                AVG(sr.ratings) AS average_ratings
                                FROM locations AS ls
                                INNER JOIN m_district AS ds ON ls.district = ds.DistrictID
                                INNER JOIN m_state AS ms ON ls.state = ms.StateID
                                LEFT JOIN start_ratings AS sr ON ls.ID = sr.location_id
                                GROUP BY ls.district, ls.ID;");
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    $response = array();
}
if (!$query) {
    die('Error: ' . mysqli_error($con));
}
header('Content-Type:application/json');
echo json_encode($response);
