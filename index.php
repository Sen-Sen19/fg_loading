<?php
session_name("fgls_db");
session_start();


if (isset($_SESSION['login_error'])) {
    echo '<script>alert("Sign In Failed. Maybe an incorrect credential or account not found")</script>';
    $_SESSION['login_error'] = NULL;
}


if (isset($_SESSION['id_number'])) {
    if ($_SESSION['account_type'] == 'admin') {
        header('Location: page/admin/history.php');
        exit;
    } elseif ($_SESSION['account_type'] == 'user') {
        header('Location: page/user/scan.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<style>
    body {
      background: url('dist/img/box4.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    .login-box {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9), 0 6px 20px rgba(0, 0, 0, 0.30);
    border-radius: 10px; 
 
    padding: 20px; 
  }
  </style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FG Loading</title>
  <link rel="icon" href="dist/img/box.png" type="image/x-icon" />
  <link rel="stylesheet" href="dist/css/font.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box" style="margin-top:20px;">
    <div class="login-logo">
      <img src="dist/img/box.png" style="height:150px;">
      <h2><b>FG Loading</b></h2>
    </div>


      <div class="card-body login-card-body">


        <form action="process/login.php" method="POST" id="login_form">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" id="id_number" name="id_number" placeholder="ID Number" autocomplete="off" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
          </div>
     
          <div class="row mb-2">
            <div class="col">
              <button type="submit" class="btn bg-primary btn-block" name="Login" value="login">Login</button>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <button type="button" href="#" target="_blank" class="btn bg-danger btn-block" id="wi">Work Instruction</button>
            </div>
          </div>
          <div class="row">
            <div class="col">
            
            </div>
          </div>
        </form>
      </div>
    </div>

</body>

<script src="plugins/jquery/dist/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>



</html>
