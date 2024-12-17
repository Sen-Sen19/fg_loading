<input type="hidden"
    value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>"
    class="form-control" id="name">
<aside class="main-sidebar sidebar-dark-primary elevation-4">


<style>
  /* Change the background color of the sidebar */
  .main-sidebar.sidebar-custom {
      background-color: black !important;
  }

  .sidebar-dark-primary {
      background-color: white !important;
  }

  /* Default text color for sidebar links */
  .sidebar a,
  .sidebar .nav-link,
  .sidebar .nav-item a {
      color: black !important;
  }

  /* Text color when the sidebar item is active */
  .sidebar .nav-link.active,
  .sidebar .nav-item a.active {
      color: white !important;
  }

  /* Optional: Change background color of the active link */
  .sidebar .nav-link.active,
  .sidebar .nav-item a.active {
      background-color: #007bff !important; 
  }

  /* Optional: Change text color on hover */
  .sidebar a:hover,
  .sidebar .nav-link:hover {
      color: #333 !important;
  }
  #scanner {
        position: absolute;
        top: 50%;
        left: 10%;
        transform: translate(-25%, 0%);
        z-index: 10;
        display: none;
        width: 200px;
        height: 200px;
    }

    .modal-content {
        max-height: 500px;
        overflow-y: auto;
    }

    .input-group {
        margin-bottom: 0;
    }

    #container,
    #pallet {
        margin-bottom: 0;

    }


    .modal-content {
        z-index: 1040;

    }

    #scanner {
        z-index: 1050;

    }
    #editscanner {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translate(-25%, 0%);
    z-index: 10;
    display: none;
    width: 200px;
    height: 200px;
}

.modal-content {
    max-height: 500px;
    overflow-y: auto;
}

.input-group {
    margin-bottom: 0;
}

#editContainerNo,
#editPalletNo {
    margin-bottom: 0;
}

.modal-content {
    z-index: 1040;
}

#editscanner {
    z-index: 1050;
}

</style>
<a href="scan.php" class="brand-link" style="display: inline-block; color: black;">
  <img src="../../dist/img/box.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; display: inline-block;">
  <span class="brand-text font-weight-light" style="display: inline-block; color: black;">&ensp;FG Loading &ensp;&ensp;</span>
</a>


  <div class="sidebar">

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../dist/img/user2.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
    <a href="scan.php" class="d-block" style="text-transform: uppercase;"><?= htmlspecialchars($_SESSION['name']); ?></a>
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