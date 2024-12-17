<?php
include 'conn.php';

header('Content-Type: application/json');

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$recordsPerPage = 15;

$containerNo = isset($_GET['container_no']) ? $_GET['container_no'] : '';
$palletNo = isset($_GET['pallet_no']) ? $_GET['pallet_no'] : '';

$offset = ($page - 1) * $recordsPerPage;

$query = "
SELECT 
    `out`.id,
    `out`.container_no,
    `out`.location,
    `out`.position,
    `out`.pallet_no,
    `out`.poly_size,
    `out`.remarks,
    `out`.date_scan,
    `out`.poly_qty,
    `out`.id_scanned
FROM fgls_output AS `out`"; // Escaped the alias `out` with backticks

$conditions = [];
if ($containerNo) {
    $conditions[] = "`out`.container_no LIKE '%" . mysqli_real_escape_string($conn, $containerNo) . "%'";
}
if ($palletNo) {
    $conditions[] = "`out`.pallet_no LIKE '%" . mysqli_real_escape_string($conn, $palletNo) . "%'";
}

if (count($conditions) > 0) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

// Query to get the total number of records (without LIMIT and OFFSET)
$totalQuery = "
SELECT COUNT(*) AS total_records
FROM fgls_output AS `out`";
if (count($conditions) > 0) {
    $totalQuery .= " WHERE " . implode(' AND ', $conditions);
}

// Execute the total query
$totalResult = mysqli_query($conn, $totalQuery);
if (!$totalResult) {
    echo json_encode(['error' => mysqli_error($conn)]);
    exit;
}

$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total_records'];

// Now fetch the data for the current page
$query .= " ORDER BY `out`.id DESC
    LIMIT $recordsPerPage OFFSET $offset";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => mysqli_error($conn)]);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Return the data along with the total count
echo json_encode([
    'data' => $data,
    'totalRecords' => $totalRecords
]);
?>
