<?php
// Utility function to send JSON responses with HTTP status codes
function sendResponse($status, $response) {
    header("HTTP/1.1 " . $status);
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}
?>
