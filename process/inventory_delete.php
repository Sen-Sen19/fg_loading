<?php
require_once 'conn.php'; 

// Decode JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['id']) || empty($input['id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

$id = $input['id'];

// SQL query to mark the record as deleted
$sql = "UPDATE inventory SET [delete] = ? WHERE id = ?";
$params = ['Deleted', $id]; // Assuming '1' indicates deleted, adjust as per your database schema

$stmt = sqlsrv_prepare($conn, $sql, $params);

if (!$stmt) {
    $errors = sqlsrv_errors();
    echo json_encode(['success' => false, 'message' => 'Failed to prepare statement', 'details' => $errors]);
    exit;
}

if (sqlsrv_execute($stmt)) {
    echo json_encode(['success' => true, 'message' => 'Record marked as deleted']);
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['success' => false, 'message' => 'Failed to mark record as deleted', 'details' => $errors]);
}

// Free statement and close the connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
