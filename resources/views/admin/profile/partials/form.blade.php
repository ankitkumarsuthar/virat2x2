<div class="row">
    <div class="col-xl-10">
       
		<div class="card-box">
           
            <p class="text-muted font-14 m-b-20">
               &nbsp;
            </p>

           {{ Form::open(['route' => ['admin.profile.update'], 'class' => '', 'name' => 'save_admin_profile', 'id' => 'save_admin_profile' ]) }}
           <input type="hidden" name="id" value="{{ $user->id }}">
                
                <div class="form-group row">
                    <label for="first_name"  class="col-2 col-form-label">Name:<span class="text-danger">*</span></label>
                    <div class="col-7">
                        <input id="first_name" name="first_name"  type="text" class="form-control" value="{{ $user->first_name }}">
                    </div>                  
                </div>
                <div class="form-group row">
                    <label for="email"  class="col-2 col-form-label">Email:<span class="text-danger">*</span></label>
                    <div class="col-7">
                        <input id="email " name="email"  type="text" class="form-control" value="{{ $user->email }}">
                    </div>                  
                </div>
                <div class="form-group row">
                    <label for="password"  class="col-2 col-form-label">Password:</label>
                    <div class="col-7">
                        <input id="password " name="password"  type="text" class="form-control">
                    </div> 
                    <span id="password_error_span"></span>                 
                </div>           

                <div class="form-group row">
                    <div class="col-8 offset-4">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Save Changes
                        </button>                       
                    </div>
                </div>
            {{ Form::close() }}
        </div> <!-- end card-box -->
		
    </div> <!-- end col -->

 
   </div>