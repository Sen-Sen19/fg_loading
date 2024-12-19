<?php

include('conn.php');

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Invalid JSON data received.']);
    exit();
}

$container_no = $data['container_no'];
$pallet_no = $data['pallet_no'];
$position = $data['position'];
$remarks = $data['remarks'];
$poly_size = $data['poly_size'];
$poly_qty = $data['poly_qty'];
$id_scanned = $data['id_scanned'];
$others = $data['others'];
$dt = $data['dt'];  // full datetime (e.g., "2024-09-17 20:34:55")
$date_scan = $data['date_scan'];  // only date (e.g., "2024-09-17")

// Updated SQL query to save both dt and date_scan
$sql = "INSERT INTO fgls_output (container_no, pallet_no, position, remarks, poly_size, poly_qty, id_scanned, date_scan, others, dt) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

// Updated to match the SQL query structure
mysqli_stmt_bind_param($stmt, "ssssssssss", $container_no, $pallet_no, $position, $remarks, $poly_size, $poly_qty, $id_scanned, $date_scan, $others, $dt);

if (mysqli_stmt_execute($stmt)) {
    // Fetch the saved record to return it to the front end
    $savedRecord = [
        'container_no' => $container_no,
        'pallet_no' => $pallet_no,
        'position' => $position,
        'remarks' => $remarks,
        'poly_size' => $poly_size,
        'poly_qty' => $poly_qty,
        'id_scanned' => $id_scanned,
        'date_scan' => $date_scan,  // Send the date only
        'others' => $others,
        'dt' => $dt // Send the full datetime
    ];
    echo json_encode(['success' => true, 'message' => 'Record saved successfully!', 'record' => $savedRecord]);
} else {
    error_log("Error executing query: " . mysqli_error($conn)); 
    echo json_encode(['success' => false, 'message' => 'Error saving record: ' . mysqli_error($conn)]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
