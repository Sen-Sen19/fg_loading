

<input type="hidden"
    value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>"
    class="form-control" id="username">
<aside class="main-sidebar sidebar-dark-primary elevation-4">

<style>

.main-sidebar.sidebar-custom {
    background-color:black!important;
}

.sidebar-dark-primary {
    background-color:black !important;
}

</style>
  <a href="accounts.php" class="brand-link">
    <img src="../../dist/img/box.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">&ensp;FG Loading &ensp;&ensp;

  </a>

  <div class="sidebar">

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../dist/img/user2.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="accounts.php" class="d-block" style="text-transform: uppercase;"><?= htmlspecialchars($_SESSION['username']); ?></a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/fg_loading/page/admin/accounts.php") { ?>
          <a href="accounts.php" class="nav-link active">
          <?php } else { ?>
          <a href="accounts.php" class="nav-link">
          <?php } ?>
            <i class="nav-icon fas fa-user-cog"></i>
            <p>Account Management</p>
          </a>
        </li>




        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/fg_loading/page/admin/history.php") { ?>
          <a href="history.php" class="nav-link active">
          <?php } else { ?>
          <a href="history.php" class="nav-link">
          <?php } ?>
            <i class="nav-icon fas fa-history"></i>
            <p>History</p>
          </a>
        </li>


        
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/fg_loading/page/admin/export.php") { ?>
          <a href="export.php" class="nav-link active">
          <?php } else { ?>
          <a href="export.php" class="nav-link">
          <?php } ?>
            <i class="nav-icon fas fa-download"></i>
            <p>Export</p>
          </a>
        </li>





        <?php include 'logout.php'; ?>
      </ul>
    </nav>

  </div>

</aside>