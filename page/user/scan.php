<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/user_bar.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
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

                                <div class="col-md-2 d-flex mb-1">
                                    <input type="text" class="form-control" id="containerSearchBox"
                                        placeholder="Container No" style="height: 35px;">
                                </div>
                                <div class="col-md-2 d-flex mb-1">
                                    <input type="text" class="form-control" id="palletSearchBox" placeholder="Pallet No"
                                        style="height: 35px;">
                                </div>

                                <div class="col-md-2 d-flex justify-content-center mb-1">
                                    <button class="btn btn-success" id="searchBtn"
                                        style="height: 35px; width: 100%; background-color: #0c63f3; border-color: #0c63f3;">
                                        <i class="fas fa-search mr-2"></i>Search
                                    </button>
                                </div>

                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class="btn btn-success custom-btn" id="openModalBtn" data-toggle="modal"
                                        data-target="#formModal"
                                        style="height: 35px; width: 100%; background-color:#008b02; border-color:#008b02;">
                                        <i class="fas fa-plus mr-2"></i>Add Record
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="accounts_table_res" class="table-responsive"
                            style="height: 46vh; overflow: auto; display: inline-block; margin-top: 20px; border-top: 1px solid gray;">
                            <table id="account" class="table table-sm table-head-fixed text-nowrap table-hover">
                                <thead style="text-align: center;">
                                    <tr data-id="1">

                                        <th>Container No</th>
                                        <th>Pallet No</th>
                                        <th>Position</th>
                                        <th>Poly Size</th>
                                        <th>Quantity of Poly</th>
                                        <th>Remarks</th>
                                        <th>Date Scan</th>
                                        <th>Scanned By</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="admin_body" style="text-align: center; padding:10px;">
                                </tbody>
                            </table>

                        </div>
                        <div class="text-center mt-3">
                            <button id="load_more_button" class="btn" style="background-color:#8e8e8e; color: white;"
                                onclick="loadMoreData()">Load More</button>
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



<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff; color: white; padding: 0.5rem 1rem;">
                <h5 class="modal-title" id="formModalLabel">Add Record</h5>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item mr-4 pt-3">
                        <p style="color: #fff; font-size: 15px;"><i class="fas fa-calendar-check"></i>&nbsp;&nbsp;<span
                                id="datetime"></span></p>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <form>
                    <div id="scanner"
                        style="display:none; position: relative; max-width: 200px; margin: 0 auto; text-align: center;">
                        <video id="video" width="200" height="200"
                            style="border: 1px solid black; object-fit: cover;"></video>
                        <canvas id="canvas" style="display:none;"></canvas>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="id_scanned">Scanned By</label>
                            <input type="text" id="id_scanned" class="form-control form-control-sm"
                                value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>"
                                readonly style="text-transform: uppercase;">
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="container_no">Container #</label>
                            <div class="input-group">
                                <input type="text" id="container_no" class="form-control form-control-sm"
                                    placeholder="Scan Container">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                        onclick="scanQRCode('container_no')">Scan</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="pallet_no">Pallet #</label>
                            <div class="input-group">
                                <input type="text" id="pallet_no" class="form-control form-control-sm"
                                    placeholder="Scan Pallet">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                        onclick="scanBarcode('pallet_no')">Scan</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="position">Position</label>
                            <select id="position" class="form-control form-control-sm">
                                <option value="" disabled selected>Choose...</option>
                                <option value="Left">Left</option>
                                <option value="Right">Right</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="poly_size">Poly Size</label>
                            <select id="poly_size" class="form-control form-control-sm">
                                <option value="" disabled selected>Choose...</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="Box">Box</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="poly_qty">Qty of Poly</label>
                            <input type="number" id="poly_qty" class="form-control form-control-sm"
                                placeholder="Quantity of Poly">
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="remarks">Remarks</label>
                            <input type="text" id="remarks" class="form-control form-control-sm" placeholder="Remarks">
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="date">Date</label>
                            <input type="date" id="date" class="form-control form-control-sm" readonly>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between w-100">
                <button type="button" class="btn btn-danger btn-sm" id="closeButton"
                    style="width: 120px;">Close</button>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary btn-sm mr-2" id="clearButton"
                        style="width: 120px;">Clear</button>
                    <button type="button" class="btn btn-success btn-sm" id="saveButton"
                        style="width: 120px;">Save</button>
                </div>
            </div>

        </div>
    </div>
</div>






<div class="modal fade" id="editFormModal" tabindex="-1" role="dialog" aria-labelledby="editFormModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff; color: white; padding: 0.5rem 1rem;">
                <h5 class="modal-title" id="editFormModalLabel">Edit Record</h5>
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item mr-4 pt-3">
                        <p style="color: #fff; font-size: 15px;"><i class="fas fa-calendar-check"></i>&nbsp;&nbsp;<span
                                id="editDatetime"></span></p>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <form>

                    <input type="hidden" id="editRecordId">
                    <div id="editscanner"
                        style="display:none; position: relative; max-width: 200px; margin: 0 auto; text-align: center;">
                        <video id="video2" width="200" height="200"
                            style="border: 1px solid black; object-fit: cover;"></video>
                        <canvas id="canvas2" style="display:none;"></canvas>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="editIdScanned">Scanned By</label>
                            <input type="text" id="editIdScanned" class="form-control form-control-sm" readonly
                                style="text-transform: uppercase;">
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="editContainerNo">Container #</label>
                            <div class="input-group">
                                <input type="text" id="editContainerNo" class="form-control form-control-sm"
                                    placeholder="Edit Container">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                        onclick="editscanQRCode('editContainerNo')">Scan</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="editPalletNo">Pallet #</label>
                            <div class="input-group">
                                <input type="text" id="editPalletNo" class="form-control form-control-sm"
                                    placeholder="Edit Pallet">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                        onclick="editscanBarcode('editPalletNo')">Scan</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="editPosition">Position</label>
                            <select id="editPosition" class="form-control form-control-sm">
                                <option value="" disabled selected>Choose...</option>
                                <option value="LEFT">Left</option>
                                <option value="RIGHT">Right</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="editPolySize">Poly Size</label>
                            <select id="editPolySize" class="form-control form-control-sm">
                                <option value="" disabled selected>Choose...</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="Box">Box</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="editPolyQty">Qty of Poly</label>
                            <input type="number" id="editPolyQty" class="form-control form-control-sm"
                                placeholder="Quantity of Poly">
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="editRemarks">Remarks</label>
                            <input type="text" id="editRemarks" class="form-control form-control-sm"
                                placeholder="Remarks">
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="editDate">Date</label>
                            <input type="date" id="editDate" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between w-100">
                <button type="button" class="btn btn-danger btn-sm" id="editCloseButton"
                    style="width: 120px;">Close</button>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary btn-sm mr-2" id="editClearButton"
                        style="width: 120px;">Clear</button>
                    <button type="button" class="btn btn-success btn-sm" id="editSaveButton"
                        style="width: 120px;">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff; color: white;">
                <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="passwordInput">Password</label>
                    <input type="password" id="passwordInput" class="form-control form-control-sm"
                        placeholder="Enter Password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" id="passwordSubmitButton">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentPage = 1;
    let isFetching = false;

    function fetchData() {
        if (isFetching) return;
        isFetching = true;

        const containerNo = document.getElementById('containerSearchBox').value.trim();
        const palletNo = document.getElementById('palletSearchBox').value.trim();

        let url = `../../process/inventory_view.php?page=${currentPage}`;
        if (containerNo) {
            url += `&container_no=${encodeURIComponent(containerNo)}`;
        }
        if (palletNo) {
            url += `&pallet_no=${encodeURIComponent(palletNo)}`;
        }

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                const tableBody = document.getElementById('admin_body');

                if (data.data.length > 0) {
                    data.data.forEach(item => {
                        const row = document.createElement('tr');
                        row.dataset.id = item.id;
                        row.innerHTML = `
                        <td>${item.container_no || 'N/A'}</td>
                        <td>${item.pallet_no || 'N/A'}</td>
                        <td>${item.position || 'N/A'}</td>
                        <td>${item.poly_size || 'N/A'}</td>
                        <td>${item.poly_qty || 'N/A'}</td>
                        <td>${item.remarks || 'N/A'}</td>
                        <td>${item.date_scan || 'N/A'}</td>
                        <td>${item.id_scanned || 'N/A'}</td>
                        <td>
    <button class="btn btn-primary btn-sm edit-btn" data-id="${item.id}" onclick="editRecord(${item.id})">
        <i class="fas fa-edit"></i>
    </button>
</td>

                    `;
                        tableBody.appendChild(row);
                    });

                    const totalRecords = data.totalRecords || 0;
                    const totalPages = Math.ceil(totalRecords / 15);


                    document.getElementById('totalCount').innerText = `Total Records: ${totalRecords}`;


                    if (currentPage >= totalPages) {
                        document.getElementById('load_more_button').disabled = true;
                        document.getElementById('load_more_button').innerText = 'No more records';
                    } else {
                        document.getElementById('load_more_button').disabled = false;
                        document.getElementById('load_more_button').innerText = 'Load More';
                    }

                    currentPage++;
                } else {

                    document.getElementById('load_more_button').disabled = true;
                    document.getElementById('load_more_button').innerText = 'No more records';
                }
            })
            .catch(error => console.error('Error fetching data:', error))
            .finally(() => {
                isFetching = false;
            });
    }


    function loadMoreData() {
        fetchData();
    }

    const tableContainer = document.getElementById('accounts_table_res');
    tableContainer.addEventListener('scroll', () => {
        if (tableContainer.scrollTop + tableContainer.clientHeight >= tableContainer.scrollHeight - 10) {
            loadMoreData();
        }
    });

    fetchData();


    document.getElementById('searchBtn').addEventListener('click', function () {
        currentPage = 1;
        document.getElementById('admin_body').innerHTML = '';
        fetchData();
    });





    function editRecord(id) {
        const row = document.querySelector(`tr[data-id="${id}"]`);
        const containerNo = row.cells[0].textContent.trim();
        const palletNo = row.cells[1].textContent.trim();
        const position = row.cells[2].textContent.trim();
        const polySize = row.cells[3].textContent.trim();
        const polyQty = row.cells[4].textContent.trim();
        const remarks = row.cells[5].textContent.trim();
        const dateScan = row.cells[6].textContent.trim();
        const idScanned = row.cells[7].textContent.trim();

        $('#passwordModal').modal('show');
        document.getElementById('passwordInput').value = '';

        document.getElementById('passwordSubmitButton').onclick = function () {
            const enteredPassword = document.getElementById('passwordInput').value.trim();

            if (enteredPassword === 'fg123') {
                $('#passwordModal').modal('hide');


                document.getElementById('editContainerNo').value = containerNo;
                document.getElementById('editPalletNo').value = palletNo;
                document.getElementById('editPosition').value = position;
                document.getElementById('editPolySize').value = polySize;
                document.getElementById('editPolyQty').value = polyQty;
                document.getElementById('editRemarks').value = remarks;
                document.getElementById('editDate').value = dateScan;
                document.getElementById('editIdScanned').value = idScanned;

                document.getElementById('editRecordId').value = id;

                $('#editFormModal').modal('show');
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Incorrect password. Please try again.',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        };

    }

    document.getElementById('editSaveButton').addEventListener('click', function () {

        const id = document.getElementById('editRecordId').value;
        const containerNo = document.getElementById('editContainerNo').value;
        const palletNo = document.getElementById('editPalletNo').value;
        const position = document.getElementById('editPosition').value;
        const polySize = document.getElementById('editPolySize').value;
        const polyQty = document.getElementById('editPolyQty').value;
        const remarks = document.getElementById('editRemarks').value;
        const dateScan = document.getElementById('editDate').value;
        const idScanned = document.getElementById('editIdScanned').value;

        fetch('../../process/inventory_update.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}&container_no=${containerNo}&pallet_no=${palletNo}&position=${position}&poly_size=${polySize}&poly_qty=${polyQty}&remarks=${remarks}&date_scan=${dateScan}&id_scanned=${idScanned}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {

                    Swal.fire({
                        title: 'Success!',
                        text: 'Record updated successfully!',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editFormModal').modal('hide');
                        location.reload();
                    });
                } else {

                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update record. Please try again.',
                        icon: 'error',
                        timer: 1000,
                        showConfirmButton: false
                    });
                }
            })
            .catch(error => {
                console.error('Error updating record:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An unexpected error occurred.',
                    icon: 'error',
                    timer: 1000,
                    showConfirmButton: false
                });
            });
    });


</script>





<script src="../../plugins/scanner/jsQR.min.js"></script>
<script src="../../plugins/scanner/quagga.min.js"></script>
<?php include 'plugins/js/scan.js'; ?>
<?php include 'plugins/footer.php'; ?>