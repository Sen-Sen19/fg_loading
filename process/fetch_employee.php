<?php
include 'conn.php';

$sql = "SELECT TOP (1000) [employee_id]
      ,[full_name]
      ,[name]
      ,[department]
      ,[password]
      ,[role] FROM [fg_loading_db].[dbo].[accounts]";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(json_encode(array("error" => "Error fetching data.")));
}

$employees = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $employees[] = $row;
}

echo json_encode($employees);
?>
