<?php
$url = 'https://www.google.com';

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (not recommended for production)

// Execute cURL session and get the result
$response = curl_exec($ch);

// Check if cURL request was successful
if ($response !== false) {
    $output = array(
        'success' => true
    );
} else {
    $output = array(
        'success' => false
    );
}

// Close cURL session
curl_close($ch);

header('Content-Type:application/json');
echo json_encode($output);
