<div class="col-xl-6">
<div class="card-box">
    <h4 class="header-title m-t-0">Bank Details</h4>
   <h4>&nbsp;</h4>
    {{ Form::open(['route' => ['user.myaccount.save.bankdetail'], 'class' => 'kt-form', 'name' => 'save_bank_detail', 'id' => 'save_bank_detail', 'autocomplete'=>'off' ]) }}
        <div class="form-group row">
            <label for="bank_beneficiary_name" class="col-4 col-form-label">Bank Beneficiary Name<span class="text-danger">*</span></label>
            <div class="col-7">
                <input type="text" class="form-control" id="bank_beneficiary_name" name="bank_beneficiary_name" placeholder="Beneficiary Name" value="{{ $user_master->bank_beneficiary_name }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="account_mumber" class="col-4 col-form-label">Bank A/c Number<span class="text-danger">*</span></label>
            <div class="col-7">
                <input type="text" class="form-control" name="account_mumber" id="account_mumber" placeholder="A/c Number" value="{{ $user_master->account_mumber }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="ifsc_code" class="col-4 col-form-label">IFSC Code<span class="text-danger">*</span></label>
            <div class="col-7">
                <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="IFSC Code" value="{{ $user_master->ifsc_code }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-8 offset-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light">
                    Save Details
                </button>
                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                    Cancel
                </button>
            </div>
        </div>
    {{ Form::close() }}
    
    <h4 class="header-title m-t-0">UPI Details</h4>
   <h4>&nbsp;</h4>
    {{ Form::open(['route' => ['user.myaccount.save.upi'], 'class' => 'kt-form', 'name' => 'save_upi_detai_form', 'id' => 'save_upi_detai_form', 'autocomplete'=>'off' ]) }}
        <div class="form-group row">
            <label for="upi_id" class="col-4 col-form-label">UPI ID<span class="text-danger">*</span></label>
            <div class="col-7">
                <input type="text" name="upi_id" class="form-control" id="upi_id" placeholder="UPI" value="{{ $user_master->upi_id }}">
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-8 offset-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light">
                    Save Details
                </button>
                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                    Cancel
                </button>
            </div>
        </div>
    {{ Form::close() }}
    
    <h4 class="header-title m-t-0">Paytm Phone No.</h4>
   <h4>&nbsp;</h4>
    {{ Form::open(['route' => ['user.myaccount.save.paytm'], 'class' => 'kt-form', 'name' => 'save_paytm_detail', 'id' => 'save_paytm_detail', 'autocomplete'=>'off' ]) }}

        <div class="form-group row">
            <label for="paytm_phone" class="col-4 col-form-label">Paytm Phone No.<span class="text-danger">*</span></label>
            <div class="col-7">
                <input type="text" name="paytm_phone" class="form-control" id="paytm_phone" placeholder="Paytm No" value="{{ $user_master->paytm_phone }}">
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-8 offset-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light">
                    Save Details
                </button>
                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                    Cancel
                </button>
            </div>
        </div>
    {{ Form::close() }}
</div>
</div>
