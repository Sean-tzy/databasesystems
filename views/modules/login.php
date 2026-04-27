<div class="authentication-wrapper authentication-cover">
    <div class="authentication-inner row m-0">
    <div class="d-none d-xl-flex col-xl-8 p-0">
        <div
            style="
                background-image: url('views/assets/images/cover8.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                width: 100%;
                height: 100vh;
                position: relative;
            ">
            <div
                style="
                    position: absolute;
                    inset: 0;
                    background: rgba(0,0,0,0.01);
                ">
            </div>
        </div>
    </div>

    <!-- Login -->
    <div class="d-flex col-12 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
        <div class="w-px-400 mx-auto mt-12 pt-5">
        <h4 class="mb-1">LABORATORY CLINIC NAME HERE...</h4>
        <p class="mb-6">Please sign-in to your account</p>

        <form id="formAuthentication" class="mb-6" method="POST">
            <div class="mb-6 form-control-validation">
            <label for="email" class="form-label">Username</label>
            <input
                type="text"
                class="form-control"
                id="loginUser"
                name="loginUser"
                value="lab"
                placeholder="Enter your email or username"
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
                value="lab"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="icon-base ti tabler-eye-off"></i></span>
            </div>
            </div>
            <div class="my-8">
            <div class="d-flex justify-content-between">
                <div class="form-check mb-0 ms-2">
                <input class="form-check-input" type="checkbox" id="remember-me" />
                <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
                <a href="auth-forgot-password-cover.html">
                <p class="mb-0">Forgot Password?</p>
                </a>
            </div>
            </div>
            <button class="btn btn-primary d-grid w-100">Sign in</button>

            <?php
                $login = new ControllerUserRights();
                $login -> ctrUserLogin();
            ?>
        </form>

        <p class="text-center">
            <span>New on our platform?</span>
            <a href="auth-register-cover.html">
            <span>Create an account</span>
            </a>
        </p>

        <div class="divider my-6">
            <div class="divider-text">or</div>
        </div>

        <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-facebook me-1_5">
            <i class="icon-base ti tabler-brand-facebook-filled icon-20px"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-twitter me-1_5">
            <i class="icon-base ti tabler-brand-twitter-filled icon-20px"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-github me-1_5">
            <i class="icon-base ti tabler-brand-github-filled icon-20px"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-google-plus">
            <i class="icon-base ti tabler-brand-google-filled icon-20px"></i>
            </a>
        </div>
        </div>
    </div>

    </div>
</div>