<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">

                   {{ Form::model($user_master, array('route' => array('admin.user.update'), 'id' => 'edit_user_form', 'class' => 'kt-form kt-form--label-left', 'files' => true)) }}
                   <input type="hidden" name="user_master_id" value="{{ $user_master->id }}">
                <div class="row">
                    {{-- {{ dd($user_master->name) }} --}}
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="user_name">Name</label>
                            <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Enter name" value="{{ $user_master->name }}">
                        </div>

                         <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="text" id="user_email" name="user_email" class="form-control" placeholder="Enter email" value="{{ $user_master->email }}">
                        </div>

                        <div class="form-group">
                            <label for="user_mobile">Mobile</label>
                            <input type="text" id="user_mobile" name="user_mobile" class="form-control" placeholder="Enter mobile" value="{{ $user_master->mobile }}">
                        </div>

                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="text" id="user_password" name="user_password" class="form-control" placeholder="Enter New password" value="">
                        </div>

                        <div class="form-group">
                            <label for="user_address">Address</label>
                            <input type="text" id="user_address" name="user_address" class="form-control" placeholder="Enter Address" value="{{ $user_master->address }}">
                        </div>

                        <div class="form-group">
                            @if(!empty($user_master->sponsor_id))
                                <label for="user_sponser_id">Sponser ID: {{ $user_master->sponser->name }}</label>                         
                            @else
                                <label for="user_sponser_id">Sponser ID: SELF</label>
                            @endif
                        </div>

                      
                    </div> <!-- end col-->

                </div>
                <!-- end row -->



                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <?php 
                            $text = "<i class='fe-check-circle mr-1'></i>"."Create";
                        ?>  
                        <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Update</button>
                        {{-- <input type="submit"  class="btn btn-success waves-effect waves-light m-1" name="Create" value="Create"> --}}
                        <button type="button" onClick="redirectTo('{{ URL::route('admin.user.index') }}');" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</button>
                    </div>
                </div>
                 {{ Form::close() }}

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-6">
        <div class="card">
            <div class="card-body">

                   {{ Form::model($user_master, array('route' => array('admin.user.update'), 'id' => 'edit_user_form', 'class' => 'kt-form kt-form--label-left', 'files' => true)) }}
                   <input type="hidden" name="user_master_id" value="{{ $user_master->id }}">
                <div class="row">
                    {{-- {{ dd($user_master->name) }} --}}
                    <div class="col-xl-12">                       

                        <div class="form-group">
                            <label for="user_sponser_id">Bank Beneficiary Name: <b>{{ $user_master->bank_beneficiary_name }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="user_sponser_id">Bank A/c Number: <b>{{ $user_master->account_mumber }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="user_sponser_id">IFSC Code: <b>{{ $user_master->ifsc_code }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="user_sponser_id">UPI ID: <b>{{ $user_master->upi_id }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="user_sponser_id">Paytm Phone No: <b>{{ $user_master->paytm_phone }}</b></label>
                        </div>



                      
                    </div> <!-- end col-->

                </div>
                <!-- end row -->



               

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>