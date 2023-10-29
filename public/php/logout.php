<?php
session_start();
session_unset();
session_destroy();

if (isset($_GET['logout'])) {
    header("Location: ../pages/index.html?logout=true");
} else {
    header("Location: ../pages");
}
