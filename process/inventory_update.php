<?php
include 'conn.php';


$data = json_decode(file_get_contents("php://input"));

if (isset($data->id) && is_numeric($data->id)) {
    $id = (int) $data->id;
    $container = $data->container;
    $pallet = $data->pallet;
    $position = $data->position;
    $polySize = $data->polySize;
    $quantity = $data->quantity;
    $remarks = $data->remarks;
    $others = $data->others;
    $scannedBy = $data->scannedBy;


    $sql = "UPDATE [fg_loading_db].[dbo].[inventory]
            SET [container] = ?, [pallet] = ?, [position] = ?, [poly_size] = ?, [quantity] = ?, [remarks] = ?, [others] = ?, [scanned_by] = ?
            WHERE [id] = ?";

    $stmt = sqlsrv_prepare($conn, $sql, [
    &
        $container,
    &
        $pallet,
    &
        $position,
    &
        $polySize,
    &
        $quantity,
    &
        $remarks,
    &
        $others,
    &
        $scannedBy,
    &
        $id
    ]);

    if (sqlsrv_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => sqlsrv_errors()]);
    }

} else {
    echo json_encode(['success' => false, 'error' => 'Invalid ID']);
}


sqlsrv_close($conn);
?>