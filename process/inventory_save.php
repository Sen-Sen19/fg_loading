<?php

include('conn.php');

if (isset($_POST['data'])) {
    // Decode the JSON data
    $data = json_decode($_POST['data'], true);

    $container = $data['container'];
    $pallet = $data['pallet'];
    $position = $data['position'];
    $remarks = $data['remarks'];
    $poly_size = $data['poly_size'];
    $quantity = $data['quantity'];
    $others = $data['others'];
    $scanned_by = $data['scanned_by'];  
    $date_time = $data['date_time']; 

    $sql = "INSERT INTO [dbo].[inventory] ([container], [pallet], [position], [remarks], [poly_size], [quantity], [others], [scanned_by], [date_time]) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $params = array($container, $pallet, $position, $remarks, $poly_size, $quantity, $others, $scanned_by, $date_time);
    $stmt = sqlsrv_query($conn, $sql, $params);

    // Return JSON response
    if ($stmt) {
        echo json_encode(['success' => true, 'message' => 'Record saved successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error saving record: ' . print_r(sqlsrv_errors(), true)]);
    }

    sqlsrv_close($conn);
}
?>
