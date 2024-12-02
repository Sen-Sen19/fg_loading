<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #343a40; color: white;">
                <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item mr-4 pt-3">
                        <p style="color: #fff; font-size: 15px;">
                            <i class="fas fa-calendar-check"></i>&nbsp;&nbsp;<span id="datetime"></span>
                        </p>
                    </li>
                </ul>
            </div>

            <div class="modal-body">
                <form id="editForm">
                    <div class="form-row mb-3">
                        <div class="col-3">
                            <label for="container">Container #</label>
                            <div class="input-group">
                                <input type="text" id="container" class="form-control form-control-sm" placeholder="Scan Container">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button">Scan</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="pallet">Pallet #</label>
                            <div class="input-group">
                                <input type="text" id="pallet" class="form-control form-control-sm" placeholder="Scan Pallet">
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
                    <button type="button" class="btn btn-warning btn-sm" id="updateButton" style="width: 120px;">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>


