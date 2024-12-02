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
                <tr data-id="1">
                    <th>Container No</th>
                    <th>Pallet No</th>
                    <th>Position</th>
                    <th>Poly Size</th>
                    <th>Quantity of Poly</th>
                    <th>Remarks</th>
                    <th>Others</th>
                    <th>Scanned By</th>
                  </tr>
                </thead>
                <tbody id="admin_body" style="text-align: center; padding:10px;">
                </tbody>
              </table>
              
            </div>
            <div class="text-center mt-3">
              <button id="load_more_button" class="btn" style="background-color:#008b02; color: white;" onclick="loadMoreData()">Load More</button>
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
            <div class="modal-header" style="background-color: #343a40; color: white; padding: 0.5rem 1rem;">
                <h5 class="modal-title" id="formModalLabel">Add Record</h5>
                
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item mr-4 pt-3">
                        <p style="color: #fff; font-size: 15px;"><i class="fas fa-calendar-check"></i>&nbsp;&nbsp;<span id="datetime"></span></p>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row mb-3">
                    <div class="col-12 col-sm-6 col-md-3">
                            <label for="scanned_by">Scanned By</label>
                            <input type="text" id="scanned_by" class="form-control form-control-sm"
                                   value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>"
                                   readonly>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="container">Container #</label>
                            <div class="input-group">
                                <input type="text" id="container" class="form-control form-control-sm" placeholder="Scan Container">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button">Scan</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="pallet">Pallet #</label>
                            <div class="input-group">
                                <input type="text" id="pallet" class="form-control form-control-sm" placeholder="Scan Pallet">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button">Scan</button>
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
                            <label for="quantity">Quantity of Poly</label>
                            <input type="number" id="quantity" class="form-control form-control-sm" placeholder="Quantity of Poly">
                        </div>
                             
                    <div class="col-12 col-sm-6 col-md-3">
                            <label for="remarks">Remarks</label>
                            <input type="text" id="remarks" class="form-control form-control-sm" placeholder="Remarks">
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="others">Others</label>
                            <input type="text" id="others" class="form-control form-control-sm" placeholder="Others" >
                        </div>
                    </div>
                </form>
            </div> 
            <div class="modal-footer d-flex justify-content-between w-100">
                <button type="button" class="btn btn-danger btn-sm" id="closeButton" style="width: 120px;">Close</button>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary btn-sm mr-2" id="clearButton" style="width: 120px;">Clear</button>
                    <button type="button" class="btn btn-success btn-sm" id="saveButton" style="width: 120px;">Save</button>
                </div>
            </div>

        </div>
    </div>
</div>











<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #343a40; color: white; padding: 0.5rem 1rem;">
                <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
              
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row mb-3">
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="edit_scanned_by">Scanned By</label>
                            <input type="text" id="edit_scanned_by" class="form-control form-control-sm" readonly>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="edit_container">Container #</label>
                            <div class="input-group">
                                <input type="text" id="edit_container" class="form-control form-control-sm" placeholder="Edit Container #">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" id="editContainerScan">Scan</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="edit_pallet">Pallet #</label>
                            <div class="input-group">
                                <input type="text" id="edit_pallet" class="form-control form-control-sm" placeholder="Edit Pallet #">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" id="editPalletScan">Scan</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="edit_position">Position</label>
                            <select id="edit_position" class="form-control form-control-sm">
                                <option value="" disabled>Choose...</option>
                                <option value="Left">Left</option>
                                <option value="Right">Right</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="edit_poly_size">Poly Size</label>
                            <select id="edit_poly_size" class="form-control form-control-sm">
                                <option value="" disabled>Choose...</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="Box">Box</option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="edit_quantity">Quantity of Poly</label>
                            <input type="number" id="edit_quantity" class="form-control form-control-sm" placeholder="Edit Quantity of Poly">
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="edit_remarks">Remarks</label>
                            <input type="text" id="edit_remarks" class="form-control form-control-sm" placeholder="Edit Remarks">
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="edit_others">Others</label>
                            <input type="text" id="edit_others" class="form-control form-control-sm" placeholder="Edit Others">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between w-100">
                <button type="button" class="btn btn-danger btn-sm" id="editCloseButton" style="width: 120px;">Close</button>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary btn-sm mr-2" id="editClearButton" style="width: 120px;">Clear</button>
                    <button type="button" class="btn btn-success btn-sm" id="editSaveButton" style="width: 120px;">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentPage = 1; // Start from the first page
let isFetching = false;

function fetchData() {
    if (isFetching) return;
    isFetching = true;

    fetch(`../../process/inventory_view.php?page=${currentPage}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            const tableBody = document.getElementById('admin_body');

            // Check if there is data to load
            if (data.length > 0) {
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.dataset.id = item.id;
                    row.innerHTML = `
                        <td>${item.container || 'N/A'}</td>
                        <td>${item.pallet || 'N/A'}</td>
                        <td>${item.position || 'N/A'}</td>
                        <td>${item.poly_size || 'N/A'}</td>
                        <td>${item.quantity || 'N/A'}</td>
                        <td>${item.remarks || 'N/A'}</td>
                        <td>${item.others || 'N/A'}</td>
                        <td>${item.scanned_by || 'N/A'}</td>
                    `;
                    tableBody.appendChild(row);
                });

                // Increment the page number after data is loaded
                currentPage++;

                // Update total count
                document.getElementById('totalCount').innerText = `Total Records: ${tableBody.rows.length}`;
            } else {
                // No more data to load
                document.getElementById('load_more_button').disabled = true;
                document.getElementById('load_more_button').innerText = 'No more records';
            }
        })
        .catch(error => console.error('Error fetching data:', error))
        .finally(() => {
            isFetching = false;
        });
}

// Initial data load
fetchData();

// Function to handle "Load More" button click
function loadMoreData() {
    fetchData();
}

// Infinite scroll event listener
const tableContainer = document.getElementById('accounts_table_res');
tableContainer.addEventListener('scroll', () => {
    if (tableContainer.scrollTop + tableContainer.clientHeight >= tableContainer.scrollHeight - 10) {
        // User has scrolled to the bottom, load more data
        loadMoreData();
    }
});



</script>


<?php include 'plugins/js/scan.js'; ?>
<?php include 'plugins/footer.php'; ?>
