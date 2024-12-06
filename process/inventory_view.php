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
    inv.[id],
    inv.[container],
    inv.[pallet],
    inv.[position],
    inv.[remarks],
    inv.[poly_size],
    inv.[quantity],
    inv.[others],
    inv.[scanned_by],
    loc.[destination],
     inv.[status],
          inv.[delete],
          inv.[additional],
        loc.[polytainer_name]
FROM [fg_loading_db].[dbo].[inventory] AS inv
LEFT JOIN [fg_loading_db].[dbo].[location] AS loc
    ON loc.[tw_no] = inv.[container]";

$conditions = [];
if ($containerNo) {
    $conditions[] = "inv.container LIKE '%" . $containerNo . "%'";
}
if ($palletNo) {
    $conditions[] = "inv.pallet LIKE '%" . $palletNo . "%'";
}

if (count($conditions) > 0) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

$query .= " ORDER BY inv.[id] DESC
      OFFSET $offset ROWS FETCH NEXT $recordsPerPage ROWS ONLY";

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
