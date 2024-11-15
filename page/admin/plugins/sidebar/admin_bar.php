<style>
  .main-sidebar {
    background-color: #000 !important;
  }
  

  .nav-link.active {
    background-color: #d8d8d8 !important; 
    color: #000 !important; 
  }
  

  .nav-link.active .nav-icon {
    color: #000 !important;
  }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../dist/img/bubonic-plague.png" class="img-circle elevation-2" alt="User Image" style="background-color: green;">
      </div>
      <div class="info">
        <a href="dashboard.php" class="d-block" style="text-transform: uppercase;">
          <?=htmlspecialchars($_SESSION['username']);?>
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/accounts.php") { ?>
          <a href="accounts.php" class="nav-link active">
          <?php } else { ?>
          <a href="accounts.php" class="nav-link">
          <?php } ?>
            <i class="nav-icon fas fa-user-cog"></i>
            <p>Account Management</p>
          </a>
        </li>
        
    

        <?php include 'logout.php'; ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
