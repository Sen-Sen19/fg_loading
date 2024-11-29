<?php
session_name("fg_loading");
session_start();

include 'conn.php';

if (isset($_POST['Login'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $sql = "SELECT name, role FROM account WHERE name = ? AND password = ?";
    $params = array($name, $password);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt && sqlsrv_execute($stmt)) {
        if (sqlsrv_has_rows($stmt)) {
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $role = $result['role']; 
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['role'] = $role;

            if ($role == 'user') {
                header('location:../page/user/scan.php');
                exit;
            } elseif ($role == 'admin') { 
                header('location: /fg_loading/page/admin/accounts.php');
                exit;
            }
        } else {

            echo '<script>
                    alert("Sign In Failed. Maybe an incorrect credential or account not found");
                    window.location.href = "/fg_loading/index.php";
                  </script>';
            exit;
        }
    } else {
        echo '<script>alert("Sign In Failed. Error in preparing or executing SQL query.")</script>';
    }
}

if (isset($_POST['Logout'])) {
    session_unset();
    session_destroy();
    header('location: /fg_loading/');
    exit;
}
?>
