<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/user_bar.php'; ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"></div>
       
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-gray-dark card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="nav-icon fas fa-qrcode"></i>&nbsp; Scan
              </h3>
          
            </div>

            <div class="card-body">
              <div class="row mb-2"></div>
              <div class="row mt-1 align-items-center">
                <!-- Search Box -->
                <div class="col-md-2 d-flex">
                  <input type="text" class="form-control" id="searchBox" placeholder="Container No" style="height: 35px;">
                </div>
                <div class="col-md-2 d-flex">
                  <input type="text" class="form-control" id="searchBox" placeholder="Pallet No" style="height: 35px;">
                </div>
                <!-- Search Button -->
                <div class="col-md-2 d-flex justify-content-center">
                  <button class="btn btn-success" id="searchBtn" style="height: 35px; width: 100%; background-color: #0c63f3; border-color: #0c63f3;">
                    <i class="fas fa-search mr-2"></i>Search
                  </button>
                </div>

                <!-- Add Record Button -->
                <div class="col-md-2 d-flex justify-content-center">
                  <button class="btn btn-success custom-btn" id="openModalBtn" data-toggle="modal" data-target="#formModal" style="height: 35px; width: 100%; background-color:#008b02; border-color:#008b02;">
                    <i class="fas fa-plus mr-2"></i>Add Record
                  </button>
                </div>
              </div>
            </div>

            <div id="accounts_table_res" class="table-responsive" style="height: 46vh; overflow: auto; display: inline-block; margin-top: 20px; border-top: 1px solid gray;">
              <table id="account" class="table table-sm table-head-fixed text-nowrap table-hover">
                <thead style="text-align: center;">
                  <tr>
                    <th>Container No</th>
                    <th>Pallet No</th>
                    <th>Position</th>
                    <th>Poly Size</th>
                    <th>Quantity of Poly</th>
                    <th>Remarks</th>
                    <th>Scanned By</th>
                  </tr>
                </thead>
                <tbody id="admin_body" style="text-align: center; padding:10px;">
                </tbody>
              </table>
            </div>
            <div id="totalCount" style="text-align: left; margin:10px ;">
              Total Records: 0
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>

function fetchData() {
    fetch('../../process/inventory_view.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('admin_body');
            tableBody.innerHTML = '';
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.container}</td>
                    <td>${item.pallet}</td>
                    <td>${item.position1}</td>
                    <td>${item.poly_size}</td>
                    <td>${item.quantity}</td>
                    <td>${item.remarks}</td>
                    <td>${item.scanned_by}</td>
                `;
                tableBody.appendChild(row);
            });
            document.getElementById('totalCount').innerText = `Total Records: ${data.length}`;
        })
        .catch(error => console.error('Error fetching data:', error));
}
document.addEventListener('DOMContentLoaded', fetchData);
</script>


<?php include 'plugins/footer.php'; ?>
