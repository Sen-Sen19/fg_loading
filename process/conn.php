<?php
$serverName = "172.25.116.188";
$connectionOptions = array(
    "Database" => "fg_loading_db",
    "Uid" => "sa",
    "PWD" => "SystemGroup@2022"
);

 
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
