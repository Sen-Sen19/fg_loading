<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
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
                    <div class="form-row mb-3">
                        <div class="col-12 col-sm-6 col-md-6">
                            <label for="scanned_by">Scanned By</label>
                            <input type="text" id="scanned_by" class="form-control form-control-sm"
                                value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>"
                                readonly>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 position-relative">
                            <label for="container">Container #</label>
                            <div class="input-group">
                                <input type="text" id="container" class="form-control form-control-sm"
                                    placeholder="Scan Container" />
                                <span class="input-group-text" id="confirm-btn"
                                    style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); cursor: pointer; background: #f0f0f0; border-radius: 0 0px 0px 0;">
                                    <i class="fas fa-unlock"></i>
                                </span>
                            </div>
                        </div>



                        <div class="col-12 col-sm-6 col-md-3 position-relative">
                            <label for="poly_size">Poly Size</label>
                            <div class="input-group">
                                <select id="poly_size" class="form-control form-control-sm">
                                    <option value="" disabled selected>Choose...</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="Box">Box</option>
                                </select>
                                <span class="input-group-text" id="poly-size-confirm-btn"
                                    style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); cursor: pointer; background: #f0f0f0; border-radius: 0 0px 0px 0;">
                                    <i class="fas fa-unlock"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Position Field with Lock Button -->
                        <div class="col-12 col-sm-6 col-md-3 position-relative">
                            <label for="position">Position</label>
                            <div class="input-group">
                                <select id="position" class="form-control form-control-sm">
                                    <option value="" disabled selected>Choose...</option>
                                    <option value="LEFT">Left</option>
                                    <option value="RIGHT">Right</option>
                                </select>
                                <span class="input-group-text" id="position-confirm-btn"
                                    style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); cursor: pointer; background: #f0f0f0; border-radius: 0 0px 0px 0;">
                                    <i class="fas fa-unlock"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <label for="pallet">Pallet #</label>
                            <div class="input-group">
                                <input type="text" id="pallet" class="form-control form-control-sm"
                                    placeholder="Scan Pallet">
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">

                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="quantity">Quantity of Poly</label>
                            <input type="text" id="quantity" class="form-control form-control-sm"
                                placeholder="Quantity of Poly">
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="remarks">Remarks</label>
                            <input type="text" id="remarks" class="form-control form-control-sm" placeholder="Remarks">
                        </div>


                        <div class="col-12 col-sm-6 col-md-6">
                            <label for="additional" style="visibility: hidden;">Additional</label>
                            <div style="position: relative; display: inline-block; width: 100%;">
                                <input type="text" id="additional" class="form-control form-control-sm"
                                    placeholder="Additional" style="padding-right: 40px;" readonly>
                                <input type="checkbox" id="additionalCheckbox"
                                    style="position: absolute; right: 1px; top: 50%; transform: translateY(-50%); width: 30px; height: 30px; margin: 0; cursor: pointer;">
                            </div>
                        </div>
                        <div class="container mt-4">
                            <table id="new-data-table" class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Container No</th>
                                        <th style="text-align: center;">Pallet No</th>
                                        <th style="text-align: center;">Position</th>
                                        <th style="text-align: center;">Judgement</th>
                                        <th style="text-align: center;">Poly Size</th>
                                        <th style="text-align: center;">Poly Qty</th>
                                        <th style="text-align: center;">Scanned By</th>
                                        <th style="text-align: center;">Date Scan</th>
                                        <th style="text-align: center;">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table rows will be dynamically added here -->
                                </tbody>
                            </table>
                        </div>





                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between w-100">
                <button type="button" class="btn btn-danger btn-sm" id="closeButton"
                    style="width: 120px;">Close</button>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary btn-sm mr-2" id="newButton"
                        style="width: 120px;">New</button>
                    <button type="button" class="btn btn-success btn-sm" id="saveButton"
                        style="width: 120px;">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function updatedatetime() {
        const now = new Date();


        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');


        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');


        const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;


        document.getElementById("datetime").textContent = formattedDateTime;
    }

    document.addEventListener("DOMContentLoaded", function () {
        $('#formModal').on('show.bs.modal', function () {
            updatedatetime();
        });

        setInterval(updatedatetime, 60000);
    });


    document.getElementById("confirm-btn").addEventListener("click", function () {
        const containerInput = document.getElementById("container");
        const icon = this.querySelector("i");

        if (containerInput.readOnly) {
            containerInput.readOnly = false;
            icon.classList.add("fa-unlock");
            icon.classList.remove("fa-lock");
        } else {
            containerInput.readOnly = true;
            icon.classList.add("fa-lock");
            icon.classList.remove("fa-unlock");
        }
    });

    document.getElementById("poly-size-confirm-btn").addEventListener("click", function () {
        const polySizeSelect = document.getElementById("poly_size");
        const icon = this.querySelector("i");


        if (polySizeSelect.readOnly) {
            polySizeSelect.readOnly = false;
            polySizeSelect.style.backgroundColor = '';
            icon.classList.remove("fa-lock");
            icon.classList.add("fa-unlock");
        } else {
            polySizeSelect.readOnly = true;
            polySizeSelect.style.backgroundColor = '#e9ecef';
            icon.classList.remove("fa-unlock");
            icon.classList.add("fa-lock");
        }
    });


    document.getElementById("position-confirm-btn").addEventListener("click", function () {
        const positionSelect = document.getElementById("position");
        const icon = this.querySelector("i");


        if (positionSelect.readOnly) {
            positionSelect.readOnly = false;
            positionSelect.style.backgroundColor = '';
            icon.classList.remove("fa-lock");
            icon.classList.add("fa-unlock");
        } else {
            positionSelect.readOnly = true;
            positionSelect.style.backgroundColor = '#e9ecef';
            icon.classList.remove("fa-unlock");
            icon.classList.add("fa-lock");
        }
    });
    document.getElementById("saveButton").addEventListener("click", function () {
    const container = document.getElementById("container").value;
    const polySize = document.getElementById("poly_size").value;
    const position = document.getElementById("position").value;
    const pallet = document.getElementById("pallet").value;
    const quantity = document.getElementById("quantity").value;
    const remarks = document.getElementById("remarks").value;
    const additionalCheckbox = document.getElementById("additionalCheckbox").checked ? 'Additional' : ' '; // Corrected

    const scannedBy = document.getElementById("scanned_by").value;
    const datetime = document.getElementById("datetime").textContent;

    const [date, time] = datetime.split(' ');

    const dt = `${date} ${time}`;
    const date_scan = date;

    const data = {
        container_no: container,
        pallet_no: pallet,
        position: position,
        judgement: additionalCheckbox,
        poly_size: polySize,
        poly_qty: quantity,
        id_scanned: scannedBy,
        remarks: remarks,
        dt: dt,
        date_scan: date_scan
    };

    fetch('../../process/inventory_save.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: result.message,
                    showConfirmButton: false,
                    timer: 500
                }).then(() => {
                    addToTable(result.record);
                    clearForm();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: result.message,
                    showConfirmButton: false,
                    timer: 500
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'There was an error saving the data.',
                showConfirmButton: false,
                timer: 500
            });
        });
});



    function addToTable(record) {

        const table = document.getElementById("new-data-table");
        const row = table.insertRow(1);
        row.innerHTML = `
        <td>${record.container_no}</td>
        <td>${record.pallet_no}</td>
        <td>${record.position}</td>
        <td>${record.judgement}</td>
        <td>${record.poly_size}</td>
        <td>${record.poly_qty}</td>
        <td>${record.id_scanned}</td>
        <td>${record.date_scan}</td>
        <td>${record.remarks}</td>
    `;
    }

    function clearForm() {

        const containerField = document.getElementById("container");
        const polySizeField = document.getElementById("poly_size");
        const positionField = document.getElementById("position");


        if (!containerField.disabled && !containerField.readOnly) {
            containerField.value = '';
        }


        if (!polySizeField.disabled && !polySizeField.readOnly) {
            polySizeField.value = '';
        }

        if (!positionField.disabled && !positionField.readOnly) {
            positionField.value = '';
        }


        document.getElementById("pallet").value = '';
        document.getElementById("quantity").value = '';
        document.getElementById("remarks").value = '';
        document.getElementById("additional").value = 'N/A';
        document.getElementById("additionalCheckbox").checked = false;

        updatedatetime();
    }


    document.getElementById('closeButton').addEventListener('click', function () {
        // Reload the page
        location.reload();
    })
    document.getElementById("newButton").addEventListener("click", function () {
    // Clear input fields
    const containerInput = document.getElementById("container");
    const polySizeSelect = document.getElementById("poly_size");
    const positionSelect = document.getElementById("position");
    const containerIcon = document.getElementById("confirm-btn").querySelector("i");
    const polySizeIcon = document.getElementById("poly-size-confirm-btn").querySelector("i");
    const positionIcon = document.getElementById("position-confirm-btn").querySelector("i");

    // Unlock and clear Container #
    containerInput.value = "";
    containerInput.readOnly = false;
    containerIcon.classList.remove("fa-lock");
    containerIcon.classList.add("fa-unlock");

    // Unlock and reset Poly Size
    polySizeSelect.selectedIndex = 0; // Reset dropdown to default
    polySizeSelect.readOnly = false;
    polySizeSelect.style.backgroundColor = '';
    polySizeIcon.classList.remove("fa-lock");
    polySizeIcon.classList.add("fa-unlock");

    // Unlock and reset Position
    positionSelect.selectedIndex = 0; // Reset dropdown to default
    positionSelect.readOnly = false;
    positionSelect.style.backgroundColor = '';
    positionIcon.classList.remove("fa-lock");
    positionIcon.classList.add("fa-unlock");

    // Clear other fields
    document.getElementById("pallet").value = "";
    document.getElementById("quantity").value = "";
    document.getElementById("remarks").value = "";
});


</script>