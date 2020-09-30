<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">

                   {{ Form::model($user, array('route' => array('admin.user.store'), 'id' => 'add_user_form', 'class' => 'kt-form kt-form--label-left', 'files' => true)) }}
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="user_name">Name</label>
                            <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Enter name" value="{{uniqid()}}">
                        </div>

                         <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="text" id="user_email" name="user_email" class="form-control" placeholder="Enter email" value="{{uniqid()}}@gmail.com">
                        </div>

                        <div class="form-group">
                            <label for="user_mobile">Mobile</label>
                            <input type="text" id="user_mobile" name="user_mobile" class="form-control" placeholder="Enter mobile" value="{{rand()}}">
                        </div>

                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="text" id="user_password" name="user_password" class="form-control" placeholder="Enter password" value="Ankit#123">
                        </div>

                        <div class="form-group">
                            <label for="user_address">Address</label>
                            <input type="text" id="user_address" name="user_address" class="form-control" placeholder="Enter Address" value="TEST ADDRESS">
                        </div>

                        <div class="form-group">
                            <label for="user_sponser_id">Sponser ID</label>
                            <input type="text" id="user_sponser_id" name="user_sponser_id" class="form-control" placeholder="Enter Sponser" value="411816835">
                        </div>

                      
                    </div> <!-- end col-->

                </div>
                <!-- end row -->



                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <?php 
                            $text = "<i class='fe-check-circle mr-1'></i>"."Create";
                        ?>  
                        <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Create</button>
                        {{-- <input type="submit"  class="btn btn-success waves-effect waves-light m-1" name="Create" value="Create"> --}}
                        <button type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</button>
                    </div>
                </div>
                 {{ Form::close() }}

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>