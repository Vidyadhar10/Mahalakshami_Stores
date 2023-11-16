<?php
session_start();
if (isset($_SESSION['UserID']) && isset($_SESSION['AdminStatus'])) {
    $userID = $_SESSION['UserID'];
    $roomNo = $_SESSION['roomNo'];
    $propPhoto = $_SESSION['profilephoto'];
} else {
    header('location:./php/logout.php');
}
