<div class="row">
    <div class="col-xl-6">
        <div class="card-box">
            <h4 class="header-title m-t-0">Withdraw Money</h4>
            <h4>&nbsp;</h4>
            {{ Form::open(['route' => ['user.wallet.withdraw.request'], 'class' => '', 'name' => 'send_money', 'id' => 'send_money' ]) }}
                <div class="form-group row">
                    <label for="inputEmail3" class="col-4 col-form-label">Current Wallet Amount<span class="text-danger">*</span></label>
                    <div class="col-7">
                        <label for="inputEmail3" class="col-4 col-form-label">2500 INR<span class="text-danger"> </span></label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="withdraw_option" class="col-4 col-form-label">Mobile No.<span class="text-danger">*</span></label>
                    <div class="col-7">
                        <select id="withdraw_option" name="withdraw_option" class="form-control" required="">
                            <option value="BANK">Bank Transfer</option>
                            <option value="UPI">UPI Transfer</option>
                            <option value="PAYTM">Paytm Transfer</option>
                            <option value="TRANSFER">Transfer Request</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="withdraw_amount" class="col-4 col-form-label">Amount<span class="text-danger">*</span></label>
                    <div class="col-7">
                        <input type="text" class="form-control"  id="withdraw_amount" placeholder="Transfer Amount">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-8 offset-4">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Withdraw Money
                        </button>
                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>


</div>