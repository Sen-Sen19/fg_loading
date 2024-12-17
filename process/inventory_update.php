<?php
// Include your database connection file
include('conn.php');

// Get the updated data from the POST request
$id = isset($_POST['id']) ? $_POST['id'] : '';
$container_no = isset($_POST['container_no']) ? $_POST['container_no'] : '';
$pallet_no = isset($_POST['pallet_no']) ? $_POST['pallet_no'] : '';
$position = isset($_POST['position']) ? $_POST['position'] : '';
$poly_size = isset($_POST['poly_size']) ? $_POST['poly_size'] : '';
$poly_qty = isset($_POST['poly_qty']) ? $_POST['poly_qty'] : '';
$remarks = isset($_POST['remarks']) ? $_POST['remarks'] : '';
$date_scan = isset($_POST['date_scan']) ? $_POST['date_scan'] : '';
$id_scanned = isset($_POST['id_scanned']) ? $_POST['id_scanned'] : '';

// Sanitize the input values to avoid SQL injection
$container_no = mysqli_real_escape_string($conn, $container_no);
$pallet_no = mysqli_real_escape_string($conn, $pallet_no);
$position = mysqli_real_escape_string($conn, $position);
$poly_size = mysqli_real_escape_string($conn, $poly_size);
$poly_qty = mysqli_real_escape_string($conn, $poly_qty);
$remarks = mysqli_real_escape_string($conn, $remarks);
$date_scan = mysqli_real_escape_string($conn, $date_scan);
$id_scanned = mysqli_real_escape_string($conn, $id_scanned);

// SQL query to update the record in the database
$sql = "UPDATE fgls_output SET
    container_no = '$container_no',
    pallet_no = '$pallet_no',
    position = '$position',
    poly_size = '$poly_size',
    poly_qty = '$poly_qty',
    remarks = '$remarks',
    date_scan = '$date_scan',
    id_scanned = '$id_scanned'
WHERE id = '$id'";

// Execute the query and check if it was successful
if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}

// Close the database connection
mysqli_close($conn);
?>
