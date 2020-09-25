<div class="row">
    <div class="col-xl-10">
       
		<div class="card-box">
           
            <p class="text-muted font-14 m-b-20">
               &nbsp;
            </p>

           {{ Form::open(['route' => ['admin.refferal.update'], 'class' => '', 'name' => 'save_referral', 'id' => 'save_referral' ]) }}
              
                <div class="form-group row">
                    <label for="refferal_bonus_amount"  class="col-2 col-form-label">Referral Bonus<span class="text-danger">*</span></label>
                    <div class="col-7">
                        <input id="refferal_bonus_amount" name="refferal_bonus_amount"  type="text" required="" class="form-control allowdecimalonly" value="{{ @$refferal_bonus->refferal_bonus_amount }}">
                    </div>					
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