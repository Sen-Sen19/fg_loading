<?php
$servername = "127.0.0.1"; //<!-- $servername = "172.25.112.171";
$username = "root";        
$password = "";            
$dbname = "fgls_db";    

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
