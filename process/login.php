<?php
session_name("fgls_db");
session_start();
include 'conn.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['Login'])) {
    $id_number = $_POST['id_number'];  // Capture ID number from form input

    // Using MySQL query with mysqli to fetch account info
    $sql = "SELECT id_number, account_type, name FROM fgls_account WHERE id_number = ?";
    
    // Prepare the statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "s", $id_number); // "s" means string
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Bind the result
            mysqli_stmt_bind_result($stmt, $id_number_db, $account_type, $name);
            
            // Check if there's a result
            if (mysqli_stmt_fetch($stmt)) {
                // Set session variables
                $_SESSION['id_number'] = $id_number_db;
                $_SESSION['account_type'] = $account_type;
                $_SESSION['name'] = $name;

                // Redirect based on account type
                if (strtolower($account_type) == 'user') {
                    header('Location: ../page/user/scan.php');
                    exit;
                } elseif (strtolower($account_type) == 'admin') { 
                    header('Location: /fg_loading/page/admin/history.php');
                    exit;
                }
            } else {
                // Incorrect credentials
                echo '<script>
                        alert("Sign In Failed. Maybe an incorrect credential or account not found");
                        window.location.href = "/fg_loading/index.php";
                      </script>';
                exit;
            }
        } else {
            echo '<script>alert("Sign In Failed. Error in preparing or executing SQL query.")</script>';
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Sign In Failed. Error in preparing SQL query.")</script>';
    }
}


if (isset($_POST['Logout'])) {
    session_unset();
    session_destroy();
    header('Location: /fg_loading/');
    exit;
}
?>
