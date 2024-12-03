<!-- 

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
                            <input type="text" id="quantity" class="form-control form-control-sm" placeholder="Quantity of Poly">
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
</div> -->
