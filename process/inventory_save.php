<?php
// Include the database connection script
include('conn.php');

// Check if the form data is received
if (isset($_POST['data'])) {
    // Decode the JSON data
    $data = json_decode($_POST['data'], true);

    // Extract the values from the decoded array
    $container = $data['container'];
    $pallet = $data['pallet'];
    $position1 = $data['position1'];
    $remarks = $data['remarks'];
    $position2 = $data['position2'];
    $poly_size = $data['poly_size'];
    $quantity = $data['quantity'];
    $others = $data['others'];
    $scanned_by = $data['scanned_by'];  // Add the scanned_by field from the form data
    $date_time = $data['date_time'];  // Add the date_time field from the form data

    // Prepare the SQL query to insert the data
    $sql = "INSERT INTO [dbo].[inventory] ([container], [pallet], [position1], [remarks], [position2], [poly_size], [quantity], [others], [scanned_by], [date_time]) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $params = array($container, $pallet, $position1, $remarks, $position2, $poly_size, $quantity, $others, $scanned_by, $date_time);
    $stmt = sqlsrv_query($conn, $sql, $params);

    // Check if the insertion was successful
    if ($stmt) {
        echo "Record saved successfully!";
    } else {
        echo "Error saving record: " . print_r(sqlsrv_errors(), true);
    }

    // Close the connection
    sqlsrv_close($conn);
}
?>
