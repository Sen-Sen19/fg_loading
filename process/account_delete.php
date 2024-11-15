<?php
include 'conn.php';

$data = json_decode(file_get_contents('php://input'), true);
$ids = $data['ids'];  // Array of selected employee IDs

if (empty($ids)) {
    echo json_encode(['success' => false, 'error' => 'No IDs provided']);
    exit;
}

// Create placeholders for prepared statement
$ids_placeholder = implode(',', array_fill(0, count($ids), '?'));
$query = "DELETE FROM [dbo].[account] WHERE employee_id IN ($ids_placeholder)";

// Prepare the SQL statement
$stmt = sqlsrv_prepare($conn, $query, $ids);

if ($stmt === false) {
    echo json_encode(['success' => false, 'error' => 'Failed to prepare query']);
    exit;
}

// Execute the query
$execute_result = sqlsrv_execute($stmt);

if ($execute_result === false) {
    echo json_encode(['success' => false, 'error' => 'Failed to delete accounts']);
    exit;
}

echo json_encode(['success' => true]);
?>
