<div class="container-xxl flex-grow-1 container-p-y">
    <div class = "row justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                    <h5 class="card-title mb-sm-0 me-2">RESET ACCOUNT</h5>
                    <input type="hidden" name="encodedby" id="encodedby" value="<?php echo $_SESSION['empid']; ?>">
                    <input type="hidden" name="trans_type" id="trans_type" value="New">
                </div>
                <div class="card-body pt-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="formAuthentication" class="mb-6" method="POST">
                            <div class="mb-6 form-control-validation">
                            <label for="username" class="form-label">Username</label>
                            <input
                                type="text"
                                class="form-control"
                                id="username-validate"
                                name="loginUser"
                                placeholder="Enter Current Username"
                                autofocus />
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input
                                type="password"
                                id="password-validate"
                                class="form-control"
                                name="loginPass"
                                placeholder="Enter Current Password"
                                aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="icon-base ti tabler-eye-off"></i></span>
                            </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary" id="btn-validate" style="width: 100%; border-color:#09e2ff; color:#09e2ff;">
                            <span class="icon-xs icon-base ti tabler-file me-2"></span>Validate
                            </button>
                            </div>
                        </div>

                            <form id="formAuthentication" class="mb-6" method="POST"></form>
                            <div class="mb-6 form-control-validation">
                            <label for="email" class="form-label">Username</label>
                            <input
                                type="text"
                                class="form-control"
                                id="loginUser"
                                name="loginUser"
                                placeholder="Enter New Username"
                                autofocus />
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input
                                type="password"
                                id="loginPass"
                                class="form-control"
                                name="loginPass"
                                placeholder="Enter new password"
                                aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="icon-base ti tabler-eye-off"></i></span>
                                </div>
                                </div>
                            <button type="button" class="btn btn-outline-primary" id="btn-reset" style="width: 100%; border-color:#00ec33; color:#00ec33;">
                            <span class="icon-xs icon-base ti tabler-file me-2"></span>Reset Account
                            </button>
                                </div>
                            <?php
                            $resetloginaccount = new ControllerUserRights();
                            $resetloginaccount -> ctrUSerLogin();
                            ?>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


