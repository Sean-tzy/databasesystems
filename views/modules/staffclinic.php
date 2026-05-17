<div class="container-xxl flex-grow-1 container-p-y">
    <form class="staff-form" method="POST" autocomplete="off">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">

                    <!-- CARD HEADER -->
                    <div class="card-header sticky-element bg-label-secondary d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">CLINIC STAFF</h5>

                        <input type="hidden" name="encodedby" id="encodedby"
                            value="<?php echo $_SESSION['empid']; ?>">

                        <input type="hidden" name="trans_type" id="trans_type" value="New">
                    </div>

                    <!-- CARD BODY -->
                    <div class="card-body">

                        <!-- NAME -->
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label" for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-1">
                                <label class="form-label" for="mi">MI</label>
                                <input type="text" name="mi" id="mi"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="extension">Extension</label>
                                <input type="text" name="extension" id="extension"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- DESIGNATION -->
                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label for="designation" class="form-label">Designation</label>

                                <select name="designation" id="designation"
                                    class="form-select" required>
                                    <option value="">Select Designation</option>

                                    <option value="Administrative Staff">Administrative Staff</option>
                                    <option value="Billing Officer">Billing Officer</option>
                                    <option value="Laboratory Assistant">Laboratory Assistant</option>
                                    <option value="Laboratory Manager">Laboratory Manager</option>
                                    <option value="Laboratory Supervisor">Laboratory Supervisor</option>
                                    <option value="Medical Laboratory Technician">Medical Laboratory Technician</option>
                                    <option value="Medical Technologist">Medical Technologist</option>
                                    <option value="Pathologist">Pathologist</option>
                                    <option value="Phlebotomist">Phlebotomist</option>
                                    <option value="Quality Assurance Officer">Quality Assurance Officer</option>
                                    <option value="Receptionist">Receptionist</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="prc">PRC No.</label>
                                <input type="text" name="prc" id="prc"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="empid">Staff ID</label>
                                <input type="text" name="empid" id="empid"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- CONTACT -->
                        <div class="row g-3 mt-1">
                            <div class="col-md-4">
                                <label class="form-label" for="mobile">Mobile Number</label>
                                <input type="text" name="mobile" id="mobile"
                                    class="form-control">
                            </div>

                            <div class="col-md-5">
                                <label class="form-label" for="alternate">Alternate Contact</label>
                                <input type="text" name="alternate" id="alternate"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="datehired">Date Hired</label>
                                <input type="date" name="datehired" id="datehired"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- ADDRESS -->
                        <div class="mt-3">
                            <label class="form-label" for="address">Address</label>

                            <textarea name="address"
                                id="address"
                                rows="3"
                                class="form-control"></textarea>
                        </div>

                        <!-- BUTTONS -->
                        <div class="mt-4 d-flex gap-2 flex-wrap">

                            <button type="button"
                                class="btn btn-outline-primary"
                                id="btn-new">
                                <i class="ti ti-file me-1"></i> New
                            </button>

                            <button type="button"
                                class="btn btn-outline-success"
                                id="btn-save">
                                <i class="ti ti-device-floppy me-1"></i> Save
                            </button>

                            <button type="button"
                                class="btn btn-outline-info"
                                id="btn-search"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-search-staff">
                                <i class="ti ti-search me-1"></i> Search
                            </button>

                            <!-- PRINT BUTTON ADDED -->
                            <button type="button"
                                class="btn btn-outline-info"
                                id="btn-print">
                                <span class="icon-xs icon-base ti tabler-printer me-2"></span>
                                Print
                            </button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- SEARCH MODAL -->
<div class="modal fade" id="modal-search-staff" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">STAFF LIST</h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover staffListTable">

                        <thead class="table-light">
                            <tr>
                                <th>Emp ID</th>
                                <th>Lastname</th>
                                <th>Firstname</th>
                                <th>MI</th>
                                <th>Designation</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0">
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>
</div>