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
$dt = $data['dt'];


$sql = "INSERT INTO fgls_output (container_no, pallet_no, position, remarks, poly_size, poly_qty, id_scanned, date_scan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssss", $container_no, $pallet_no, $position, $remarks, $poly_size, $poly_qty, $id_scanned, $dt);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => true, 'message' => 'Record saved successfully!']);
} else {
    error_log("Error executing query: " . mysqli_error($conn)); 
    echo json_encode(['success' => false, 'message' => 'Error saving record: ' . mysqli_error($conn)]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);


?>
