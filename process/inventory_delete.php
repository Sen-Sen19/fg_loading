<?php
require_once 'conn.php'; 


$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['id']) || empty($input['id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

$id = $input['id'];

$sql = "DELETE FROM inventory WHERE id = ?";
$params = [$id];

$stmt = sqlsrv_prepare($conn, $sql, $params);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare statement']);
    exit;
}

if (sqlsrv_execute($stmt)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete record']);
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
