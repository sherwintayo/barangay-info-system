<?php
// Include database connection
include "pages/connection.php";

// Query to check for pending approvals
$query = "SELECT COUNT(*) as pending_count FROM tbluser WHERE isApproved = 0";
$result = mysqli_query($con, $query);

// Fetch result
$data = mysqli_fetch_assoc($result);
$pendingCount = $data['pending_count'];

// Return JSON response
echo json_encode(['pendingCount' => $pendingCount]);
?>
