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
                            <div class="row mt-1 align-items-center">
                                <div class="col-md-3 d-flex mb-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="containerSearchBox" placeholder="Container No" style="height: 35px;">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" id="searchBtn" style="height: 35px; background-color: #0c63f3; border-color: #0c63f3;">
                                                <i class="fas fa-search mr-2"></i>Search
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class="btn btn-success custom-btn" id="openModalBtn" data-toggle="modal"
                                        data-target="#formModal"
                                        style="height: 35px; width: 100%; background-color:#008b02; border-color:#008b02;margin-bottom:3px;">
                                        <i class="fas fa-plus mr-2"></i>Add Record
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="accounts_table_res" class="table-responsive"
                            style="height: 46vh; overflow: auto; display: inline-block; margin-top: 20px; border-top: 1px solid gray;">
                            <table id="account" class="table table-sm table-head-fixed text-nowrap table-hover">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>Container No</th>
                                        <th>Pallet No</th>
                                        <th>Position</th>
                                        <th>Poly Size</th>
                                        <th>Quantity of Poly</th>
                                        <th>Remarks</th>
                                        <th>Date Scan</th>
                                        <th>Scanned By</th>
              
                                    </tr>
                                </thead>
                                <tbody id="admin_body" style="text-align: center; padding:10px;">
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-3">
                            <button id="load_more_button" class="btn" style="background-color:#8e8e8e; color: white;">
                                Load More
                            </button>
                        </div>

                        <div id="totalCount" style="text-align: left; margin:10px;">
                            Total Records: <span id="totalRecordsCount">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'plugins/footer.php'; ?>

<script>
let currentPage = 1;
let isFetching = false;

document.addEventListener('DOMContentLoaded', function () {

    fetchData(currentPage);

   
    const searchButton = document.getElementById('searchBtn');
    searchButton.addEventListener('click', function () {
                currentPage = 1;
        document.getElementById('admin_body').innerHTML = ''; 
        fetchData(currentPage);
    });

    const tableContainer = document.getElementById('accounts_table_res');
    tableContainer.addEventListener('scroll', function () {
        if (tableContainer.scrollTop + tableContainer.clientHeight >= tableContainer.scrollHeight - 10) {
            fetchData(currentPage);
        }
    });

    const loadMoreButton = document.getElementById('load_more_button');
    loadMoreButton.addEventListener('click', function () {
        fetchData(currentPage);
    });
});

function fetchData(page) {
    if (isFetching) return;
    isFetching = true;

    const containerNo = document.getElementById('containerSearchBox').value;
    const url = `../../process/inventory_view.php?page=${page}&container_no=${containerNo}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            const tableBody = document.getElementById('admin_body');
            
            data.data.forEach(item => {
                const row = document.createElement('tr');
                row.dataset.id = item.id;
                row.innerHTML = `
                    <td>${item.container_no}</td>
                    <td>${item.pallet_no}</td>
                    <td>${item.position}</td>
                    <td>${item.poly_size}</td>
                    <td>${item.poly_qty}</td>
                    <td>${item.remarks}</td>
                    <td>${item.date_scan}</td>
                    <td>${item.id_scanned}</td>
                `;
                tableBody.appendChild(row);

                row.addEventListener('click', function () {
                    openEditModal(item);
                });
            });

    
            document.getElementById('totalRecordsCount').textContent = data.totalRecords;
            currentPage += 1;
            isFetching = false;

      
            if (data.data.length === 0) {
                document.getElementById('load_more_button').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            isFetching = false;
        });
}

function openEditModal(item) {
    document.getElementById('editRecordId').value = item.id;
    document.getElementById('editIdScanned').value = item.id_scanned;
    document.getElementById('editContainerNo').value = item.container_no;
    document.getElementById('editPalletNo').value = item.pallet_no;
    document.getElementById('editPosition').value = item.position;
    document.getElementById('editPolySize').value = item.poly_size;
    document.getElementById('editPolyQty').value = item.poly_qty;
    document.getElementById('editRemarks').value = item.remarks;
    document.getElementById('editDate').value = item.date_scan;
    $('#editFormModal').modal('show');
}

$('#openModalBtn').on('click', function() {
        $('#formModal').modal('show'); 
    });
</script>
