<div class="row">
    <div class="col-lg-6">
        <div class="p-sm-3">
            <!-- title-->
            
            {{ Form::open(['route' => ['user.register.user'], 'class' => 'kt-form', 'name' => 'admin-register-form', 'id' => 'admin_register_form_id', 'autocomplete'=>'off' ]) }}

                 <div class="form-group mb-3">
                    <label for="user_name">Full Name</label>
                    <input class="form-control" name="user_name" type="text" id="user_name" placeholder="Enter your name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email address</label>
                    <input class="form-control" name="email" type="email" id="email" required="" placeholder="Enter your email">
                </div>
                <div class="form-group mb-3">
                    <label for="fullname">Mobile</label>
                    <input class="form-control allownumericonly" type="text" id="mobile" name="mobile" placeholder="Enter your Mobile No." required maxlength="10">
                </div>
                <div class="form-group mb-3">
                   
                    <label for="password">Password</label>
                    <input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
                </div>

              

            
        </div>
    </div> <!-- end col -->

    <div class="col-lg-6">
        <div class="p-sm-3">           
           
                 <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <input class="form-control" name="address" type="text" id="address" placeholder="Enter Your Address">
                </div>
                
                <div class="form-group mb-3">
                    <label for="user_sponser_id">Sponsor ID.</label>
                    <input class="form-control allownumericonly" type="text" name="user_sponser_id" id="user_sponser_id" placeholder="Sponsor Mobile No.">
                    Stay Blank If No Sponsor
                </div>
               
               
                <div class="form-group mb-0">
                    {{-- <button class="btn btn-success btn-sm float-sm-right" type="submit"> Register Now </button> --}}
                    
                    <div class="custom-control custom-checkbox pt-1">
                        <input type="checkbox" class="custom-control-input" name="terms_check2" id="terms_check" checked>
                        <label class="custom-control-label" for="terms_check">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                    </div>
                    <span id="terms_check-error-new"></span>
                </div> 

                <div class="form-group mb-3">
                    <br>
                    <input type="submit" name="submit" value="Register Now"  class="btn btn-success btn-sm float-sm-left" >
                            
                </div>

               

            {{ Form::close() }}
        </div>
        
    </div> <!-- end col -->
</div>