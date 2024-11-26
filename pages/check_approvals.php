<?php
// Include database connection
include "../connection.php";

// Initialize response
$response = [];

// Check database connection
if (!$con) {
    $response['error'] = "Database connection failed: " . mysqli_connect_error();
    echo json_encode($response);
    exit;
}

// Query to check for pending approvals
$query = "SELECT COUNT(*) as pending_count FROM tbluser WHERE type = 'Zone Leader' AND isApproved = 0";
$result = mysqli_query($con, $query);

if (!$result) {
    $response['error'] = "Query failed: " . mysqli_error($con);
    echo json_encode($response);
    exit;
}

// Fetch result
$data = mysqli_fetch_assoc($result);
$response['pendingCount'] = $data['pending_count'];

// Return JSON response
echo json_encode($response);
?>
