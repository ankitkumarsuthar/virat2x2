{{ Form::open(['route' => ['admin.login.check'], 'class' => 'kt-form', 'name' => 'admin-login-form', 'id' => 'admin_login_form_id' ]) }}

    <div class="form-group mb-3">
        <label for="email">Email address</label>
        <input class="form-control" type="email" name="email" id="email" required="" placeholder="Enter your email">
    </div>

    <div class="form-group mb-3">
        <label for="password">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
            <div class="input-group-append" data-password="false">
                <div class="input-group-text">
                    <span class="password-eye"></span>
                </div>
            </div>
        </div>
        <span id="password-error-new"></span>
    </div>

    <div class="form-group mb-3">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
        </div>
    </div>

    <div class="form-group mb-0 text-center">
        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
    </div>

{{ Form::close() }}