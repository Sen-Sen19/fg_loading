<div class="modal fade" id="editFormModal" tabindex="-1" role="dialog" aria-labelledby="editFormModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:rgb(80, 80, 80); color: white; padding: 0.5rem 1rem;">
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

                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="editPalletNo">Pallet #</label>
                            <div class="input-group">
                                <input type="text" id="editPalletNo" class="form-control form-control-sm"
                                    placeholder="Edit Pallet">

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
                <button type="button" class="btn btn-danger btn-sm" id="editDeleteButton"
                    style="width: 120px;">Delete</button>
                    
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


<script>

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
        if (!id || !containerNo || !palletNo || !position || !polySize || !polyQty || !remarks || !dateScan || !idScanned) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Information',
                text: 'Please fill in all fields.',
                timer: 3000,
                showConfirmButton: false
            });
            return;
        }
        const formData = new FormData();
        formData.append('id', id);
        formData.append('container_no', containerNo);
        formData.append('pallet_no', palletNo);
        formData.append('position', position);
        formData.append('poly_size', polySize);
        formData.append('poly_qty', polyQty);
        formData.append('remarks', remarks);
        formData.append('date_scan', dateScan);
        formData.append('id_scanned', idScanned);
        fetch('../../process/inventory_update.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Record Updated',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(() => {

                        $('#editFormModal').modal('hide');

                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error updating the record.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error with the update process.',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
    });
    document.addEventListener("DOMContentLoaded", function () {
        function updateDatetime() {
            const now = new Date();
            const date = now.toLocaleDateString("en-US", {
                year: 'numeric', month: 'short', day: 'numeric'
            });
            const time = now.toLocaleTimeString("en-US", { hour: '2-digit', minute: '2-digit' });
            document.getElementById("editDatetime").textContent = `${date} - ${time}`;
        }
        $('#editFormModal').on('show.bs.modal', function () {
            updateDatetime();
        });
        setInterval(updateDatetime, 60000);
    });


    document.getElementById('editDeleteButton').addEventListener('click', function () {
    const palletNo = document.getElementById('editPalletNo').value;

    if (!palletNo) {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Pallet number is required for deletion.',
            timer: 3000,
            showConfirmButton: false
        });
        return;
    }

    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('pallet_no', palletNo);

            fetch('../../process/inventory_delete.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            text: 'The record has been deleted.',
                            timer: 500,
                            showConfirmButton: false
                        }).then(() => {
                            $('#editFormModal').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There was an error deleting the record.',
                            timer: 1000,
                            showConfirmButton: false
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error with the delete process.',
                        timer: 1000,
                        showConfirmButton: false
                    });
                });
        }
    });
});

</script>