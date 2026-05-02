<?php
    $accessUsers = (new ControllerUserRights)->ctrAccessUserList();
    $clinicStaffList = (new ControllerClinicStaff)->ctrClinicStaffList();
    $accessLevels = ["Full", "View", "Restricted"];
?>
<div class="container-xxl grow container-p-y">
    <form class="accessprivelege-form" method="POST" autocomplete="off">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                        <h5 class="card-title mb-sm-0 me-2">ACCESS PRIVELEGE</h5>
                        <input type="hidden" id="trans_type" value="New">
                    </div>

                    <div class="card-body pt-12">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="row g-6">
                                    <div class="col-md-8">
                                        <label for="empid" class="form-label">CLINIC STAFF</label>
                                        <select id="empid" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <?php foreach ($clinicStaffList as $staff): ?>
                                                <option value="<?php echo htmlspecialchars($staff["empid"]); ?>">
                                                    <?php echo htmlspecialchars($staff["lastname"] . ', ' . $staff["firstname"]); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="usertype" class="form-label">User Type</label>
                                        <select id="usertype" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <option value="Master">Master</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Regular">Regular</option>
                                        </select>
                                    </div>
                                </div>

                                <br>

                                <div class="row g-6">
                                    <div class="col-md-4">
                                        <label for="diagnostics" class="form-label">Diagnostics</label>
                                        <select id="diagnostics" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <?php foreach ($accessLevels as $level): ?>
                                                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="clinicstaffaccess" class="form-label">Clinic Staff</label>
                                        <select id="clinicstaffaccess" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <?php foreach ($accessLevels as $level): ?>
                                                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="patientregistryaccess" class="form-label">Patient Registry</label>
                                        <select id="patientregistryaccess" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <?php foreach ($accessLevels as $level): ?>
                                                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <br>

                                <div class="row g-6">
                                    <div class="col-md-4">
                                        <label for="laboratoryassaysaccess" class="form-label">Laboratory Assays</label>
                                        <select id="laboratoryassaysaccess" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <?php foreach ($accessLevels as $level): ?>
                                                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="reportsaccess" class="form-label">Reports</label>
                                        <select id="reportsaccess" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <?php foreach ($accessLevels as $level): ?>
                                                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="accessprivelegeright" class="form-label">Access Privelege</label>
                                        <select id="accessprivelegeright" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <?php foreach ($accessLevels as $level): ?>
                                                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="demo-inline-spacing">
                                    <button type="button" class="btn btn-outline-primary" id="btn-new">
                                        <span class="icon-xs icon-base ti tabler-file me-2"></span>New
                                    </button>
                                    <button type="button" class="btn btn-outline-success" id="btn-save">
                                        <span class="icon-xs icon-base ti tabler-device-floppy me-2"></span>Save
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-outline-info"
                                        id="btn-search"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-search-accessprivelege">
                                        <span class="icon-xs icon-base ti tabler-search me-2"></span>Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-search-accessprivelege" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ACCESS PRIVELEGE LIST</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered table-hover accessPrivelegeListTable">
                    <thead>
                        <tr>
                            <th>Clinic Staff</th>
                            <th>User Type</th>
                            <th>Diagnostics</th>
                            <th>Reports</th>
                            <th>Access Privelege</th>
                            <th>ACT</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
