<div class="container-xxl grow container-p-y">
    <form class="staff-form" method="POST" autocomplete="nope">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                    <h5 class="card-title mb-sm-0 me-2">CLINIC STAFF</h5>
                    <input type="hidden" name="encodedby" id="encodedby" value="<?php echo $_SESSION["empid"];?>">
                    <input type="hidden" name="trans_type" id="trans_type" value="New">
                </div>
                <div class="card-body pt-12">
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <div class="row g-6">
                                <div class="col-md-4">
                                    <label class="form-label" for="firstname">First name</label>
                                    <input type="text" id="firstname" class="form-control" required/>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="lastname">Last name</label>
                                    <input type="text" id="lastname" class="form-control" required/>
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label" for="mi">MI</label>
                                    <input type="text" id="mi" class="form-control" required/>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="extension">Extension</label>
                                    <input type="text" id="extension" class="form-control"/>
                                </div>
                            </div>
                            <br>
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <label for="designation" class="form-label">Designation</label>
                                    <select id="designation" class="select2 form-select" data-allow-clear="true" required>
                                        <option></option>
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
                                    <input type="text" id="prc" class="form-control"/>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="empid">Staff ID</label>
                                    <input type="text" id="empid" class="form-control"/>
                                </div>
                            </div>
                            <br>
                            <div class="row g-6">
                                <div class="col-md-4">
                                    <label class="form-label" for="mobile">Mobile Number</label>
                                    <input type="text" id="mobile" class="form-control"/>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="alternate">Alternate Contact</label>
                                    <input type="text" id="alternate" class="form-control"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="datehired">Date Hired</label>
                                    <input type="text" id="datehired" class="form-control" />
                                </div>
                            </div>
                            <br>
                            <div class="col-12">
                                <label class="form-label" for="address">Address</label>
                                <textarea
                                name="address"
                                class="form-control"
                                id="address"
                                rows="2"></textarea>
                            </div>

                            <div class="demo-inline-spacing">
                                <button type="button" class="btn btn-outline-primary" id="btn-new">
                                    <span class="icon-xs icon-base ti tabler-file me-2"></span>New
                                </button>
                                <button type="button" class="btn btn-outline-success" id="btn-save">
                                    <span class="icon-xs icon-base ti tabler-star me-2"></span>Save
                                </button>
                                <button type="button" 
                                    class="btn btn-outline-info" 
                                    id="btn-search"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal-search-staff">
                                    <span class="icon-xs icon-base ti tabler-search me-2"></span>Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-search-staff" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">STAFF LIST</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered table-hover staffListTable">
                    <thead>
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