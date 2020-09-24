<div class="card-box">
    <h4 class="header-title m-t-0">Change Password</h4>
    <p class="text-muted font-14 m-b-20">
       &nbsp;
    </p>

   
   {{ Form::open(['route' => ['user.myaccount.change.password'], 'class' => 'kt-form', 'name' => 'change_passwor_form', 'id' => 'change_passwor_form', 'autocomplete'=>'off' ]) }}
      
        <div class="form-group row">
            <label for="old_password" class="col-4 col-form-label">Old Password<span class="text-danger">*</span></label>
            <div class="col-7">
                <input id="old_password" type="password" name="old_password" placeholder="Old Password"  class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="new_password" class="col-4 col-form-label">New Password
                <span class="text-danger">*</span></label>
            <div class="col-7">
                <input name="new_password" type="password" placeholder="New Password" class="form-control" id="new_password">
            </div>
        </div>

      
        <div class="form-group row">
            <div class="col-8 offset-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light">
                    Change Password
                </button>
                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                    Cancel
                </button>
            </div>
        </div>
    {{ Form::close() }}
</div> <!-- end card-box -->