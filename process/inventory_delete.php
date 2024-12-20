<?php
include('conn.php'); // Include your connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $palletNo = $_POST['pallet_no'] ?? '';

    if (empty($palletNo)) {
        echo json_encode(['success' => false, 'message' => 'Pallet number is required']);
        exit;
    }

    $query = "DELETE FROM fgls_output WHERE pallet_no = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $palletNo);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete record']);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare query']);
    }

    mysqli_close($conn);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
