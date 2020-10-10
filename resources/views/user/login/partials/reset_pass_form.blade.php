{{ Form::open(['route' => ['user.reset.password.check.update'], 'class' => 'kt-form', 'name' => 'forgot_password_form', 'id' => 'forgot_password_form' ]) }}
<input type="hidden" name="email" value="{{ $email }}">
<input type="hidden" name="code" value="{{ $code }}">
<div class="form-group mb-3">
    <label for="password">New Password</label>
    <input class="form-control" type="password" name="password" id="password" required="" placeholder="Enter your password">
</div>
<div class="form-group mb-3">
    <label for="password_confirm">Confirm Password</label>
    <input class="form-control" type="password" name="password_confirm" id="password_confirm" required="" placeholder="Enter your again">
</div>


<div class="form-group mb-0 text-center">
    <button class="btn btn-primary btn-block" type="submit"> Send Reset Password Link </button>
</div>

{{ Form::close() }}