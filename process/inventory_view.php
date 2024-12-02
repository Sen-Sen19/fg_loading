<?php
include 'conn.php';

header('Content-Type: application/json');




$query = "SELECT 
       [id]
      ,[container]
      ,[pallet]
      ,[position]
      ,[remarks]
      ,[poly_size]
      ,[quantity]
      ,[others]
      ,[scanned_by]
      
  FROM [fg_loading_db].[dbo].[inventory]";


$result = sqlsrv_query($conn, $query);

if ($result === false) {
    echo json_encode(['error' => sqlsrv_errors()]);
    exit;
}

$data = [];
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

echo json_encode($data);
