

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #343a40; color: white;">
                <h5 class="modal-title" id="formModalLabel">Add Record</h5>
             
        
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
    <li class="nav-item mr-4 pt-3">
      <p style="color: #fff; font-size: 15px;"><i class="fas fa-calendar-check"></i>&nbsp;&nbsp;<span id="datetime"></span></p>
    </li>
  </ul>
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
                            <label for="position1">Position</label>
                            <select id="position1" class="form-control form-control-sm">
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



<script>

      function refreshDateTime() {
    const datetimeDisplay = document.getElementById("datetime");
    const now = new Date();

    const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = now.toLocaleDateString(undefined, dateOptions);

    const timeOptions = { hour: 'numeric', minute: 'numeric', second: 'numeric' };
    const formattedTime = now.toLocaleTimeString(undefined, timeOptions);

    const formattedDateTime = `${formattedDate} | ${formattedTime}`;

    datetimeDisplay.textContent = formattedDateTime;
  }
  setInterval(refreshDateTime, 1000); 
document.getElementById("saveButton").addEventListener("click", () => {
    // Collect and validate form data in one step
    const formData = {
        container: document.getElementById("container").value,
        pallet: document.getElementById("pallet").value,
        position1: document.getElementById("position1").value,
        remarks: document.getElementById("remarks").value,
        position2: document.getElementById("position2").value,
        poly_size: document.getElementById("additional2").value,
        quantity: document.getElementById("additional3").value,
        others: document.getElementById("others").value,
        scanned_by: document.getElementById("name").value,
        date_time: new Date().toISOString()  // Add the current date and time
    };

    // Basic validation: Ensure required fields are filled
    if (Object.values(formData).some(value => !value)) {
        return Swal.fire({
            title: 'Error!',
            text: 'Please fill in all required fields.',
            icon: 'error',
            showConfirmButton: true
        });
    }

    // Send data via AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../process/inventory_save.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = () => {
        if (xhr.status === 200) {
            Swal.fire({
                title: 'Success!',
                text: 'Record has been saved.',
                icon: 'success',
                timer: 1000,
                showConfirmButton: false
            }).then(() => location.reload());
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to save the record.',
                icon: 'error',
                showConfirmButton: true
            });
        }
    };
    xhr.send(`data=${JSON.stringify(formData)}`);
});


</script>   
