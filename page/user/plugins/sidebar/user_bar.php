

<input type="hidden"
    value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>"
    class="form-control" id="name">
<aside class="main-sidebar sidebar-dark-primary elevation-4">

<style>

.main-sidebar.sidebar-custom {
    background-color:black!important;
}

.sidebar-dark-primary {
    background-color:black !important;
}

</style>
  <a href="scan.php" class="brand-link">
    <img src="../../dist/img/box.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">&ensp;FG Loading &ensp;&ensp;

  </a>

  <div class="sidebar">

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../dist/img/user2.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="scan.php" class="d-block"><?= htmlspecialchars($_SESSION['name']); ?></a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <?php if (basename($_SERVER['PHP_SELF']) == "scan.php") { ?>
            <a href="scan.php" class="nav-link active">
            <?php } else { ?>
              <a href="scan.php" class="nav-link">
              <?php } ?>
              <i class="nav-icon fas fa-qrcode"></i>
              <p>Scan</p>
            </a>
        </li>




        <?php include 'logout.php'; ?>
      </ul>
    </nav>

  </div>

</aside>