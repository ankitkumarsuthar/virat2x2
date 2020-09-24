{{ Form::open(['route' => ['user.send.reset.password.link'], 'class' => 'kt-form', 'name' => 'forgot_password_form', 'id' => 'forgot_password_form' ]) }}

<div class="form-group mb-3">
    <label for="email">Email address</label>
    <input class="form-control" type="email" name="email" id="email" required="" placeholder="Enter your email">
</div>


<div class="form-group mb-0 text-center">
    <button class="btn btn-primary btn-block" type="submit"> Send Reset Password Link </button>
</div>

{{ Form::close() }}