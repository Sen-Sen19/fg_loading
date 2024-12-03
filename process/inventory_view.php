<?php
include 'conn.php';

header('Content-Type: application/json');

// Get the current page from the GET request (default to 1 if not provided)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$recordsPerPage = 15; // Number of records per batch

// Get search parameters
$containerNo = isset($_GET['container_no']) ? $_GET['container_no'] : '';
$palletNo = isset($_GET['pallet_no']) ? $_GET['pallet_no'] : '';

// Calculate the OFFSET for SQL query
$offset = ($page - 1) * $recordsPerPage;

// Start building the query with basic pagination
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

// Add WHERE conditions if search parameters are provided
$conditions = [];
if ($containerNo) {
    $conditions[] = "container LIKE '%" . $containerNo . "%'";
}
if ($palletNo) {
    $conditions[] = "pallet LIKE '%" . $palletNo . "%'";
}

if (count($conditions) > 0) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

$query .= " ORDER BY [id] DESC  -- Sort by ID in descending order (latest first)
      OFFSET $offset ROWS FETCH NEXT $recordsPerPage ROWS ONLY"; // Pagination added

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
?>
