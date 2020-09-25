<div class="row">
    <div class="col-xl-6">
        <div class="card-box">
            <h4 class="header-title m-t-0">Transfer Money</h4>
            <h4>&nbsp;</h4>
          {{ Form::open(['route' => ['user.wallet.transfer.to.another.send'], 'class' => '', 'name' => 'send_money', 'id' => 'send_money' ]) }}
                <div class="form-group row">
                    <label for="receiver_unique_id" class="col-4 col-form-label">Receiver Unique ID.<span class="text-danger">*</span></label>
                    <div class="col-7">
                        <input type="text" name="receiver_unique_id"  class="form-control allownumericonly" id="receiver_unique_id" placeholder="Receiver Unique ID." >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="transfer_amount" class="col-4 col-form-label">Amount<span class="text-danger">*</span></label>
                    <div class="col-7">
                        <input type="text" name="transfer_amount"  class="form-control allowdecimalonly" id="transfer_amount" placeholder="Amount to transfer" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="transfer_message" class="col-4 col-form-label">Message<span class="text-danger">*</span></label>
                    <div class="col-7">
                        <input type="text" name="transfer_message"  class="form-control" id="transfer_message" placeholder="Message" >
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-8 offset-4">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Transfer Money
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