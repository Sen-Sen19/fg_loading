

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #343a40; color: white;">
                <h5 class="modal-title" id="formModalLabel">Add Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Form inside the modal -->
                <form>
                    <div class="form-row mb-3">
                        <div class="col-3">
                            <label for="container">Container #</label>
                            <div class="input-group">
                                <input type="text" id="container" class="form-control form-control-sm"
                                    placeholder="Scan Container">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button">Scan</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="pallet">Pallet #</label>
                            <div class="input-group">
                                <input type="text" id="pallet" class="form-control form-control-sm"
                                    placeholder="Scan Pallet">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button">Scan</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="position2">Position</label>
                            <select id="position2" class="form-control form-control-sm">
                                <option value="" disabled selected>Choose...</option>
                                <option value="Left">Left</option>
                                <option value="Right">Right</option>
                            </select>
                        </div>

                        <div class="col-3">
                            <label for="remarks">Remarks</label>
                            <input type="text" id="remarks" class="form-control form-control-sm" placeholder="Remarks">
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col-3">
                            <label for="position2">Position</label>
                            <select id="position2" class="form-control form-control-sm">
                                <option value="" disabled selected>Choose...</option>
                                <option value="Left">Left</option>
                                <option value="Right">Right</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="additional2">Poly Size</label>
                            <select id="additional2" class="form-control form-control-sm">
                                <option value="" disabled selected>Choose...</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="Box">Box</option>
                            </select>
                        </div>


                        <div class="col-3">
                            <label for="additional3">Quantity of Poly</label>
                            <input type="text" id="additional3" class="form-control form-control-sm">
                        </div>
                        <div class="col-3">
                            <label for="others">Others</label>
                            <input type="text" id="others" class="form-control form-control-sm">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer (buttons at the bottom) -->
            <div class="modal-footer d-flex justify-content-end w-100">
                <button type="button" class="btn btn-secondary btn-sm mr-2" id="clearButton"
                    style="width: 120px;">Clear</button>
                <button type="button" class="btn btn-success btn-sm" id="saveButton" style="width: 120px;">Save</button>
            </div>



        </div>
    </div>
</div>



<script>
    document.getElementById("saveButton").addEventListener("click", function () {
        // Get values from form
        var container = document.getElementById("container").value;
        var pallet = document.getElementById("pallet").value;
        var position1 = document.getElementById("position2").value;
        var remarks = document.getElementById("remarks").value;
        var position2 = document.getElementById("position2").value;  // Same issue with the ID
        var poly_size = document.getElementById("additional2").value;
        var quantity = document.getElementById("additional3").value;
        var others = document.getElementById("others").value;
        var scanned_by = document.getElementById("name").value;  // Value from the hidden input

        // Create an object to hold form data
        var formData = {
            container: container,
            pallet: pallet,
            position1: position1,
            remarks: remarks,
            position2: position2,
            poly_size: poly_size,
            quantity: quantity,
            others: others,
            scanned_by: scanned_by // Add scanned_by to form data
        };

        // Send the data via AJAX to the PHP script
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../process/save_inventory.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Show SweetAlert on success
                Swal.fire({
                    title: 'Success!',
                    text: 'Record has been saved.',
                    icon: 'success',
                    timer: 1000, // Auto-close after 1 second
                    showConfirmButton: false
                }).then(() => {
                    // Reload the page after the SweetAlert timer finishes
                    location.reload();
                });
            }
        };
        xhr.send("data=" + JSON.stringify(formData));  // Send the data as a JSON string
    });
</script>   
