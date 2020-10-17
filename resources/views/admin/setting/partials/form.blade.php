<div class="card-box">

    <p class="text-muted font-14 m-b-20">
        &nbsp;
    </p>

   {{ Form::open(['route' => ['admin.setting.store'], 'class' => 'kt-form kt-form--label-left', 'name' => 'notification_form', 'id' => 'notification_form' ]) }}   

        <div class="form-group row">
            <p class="text-muted mt-3 mb-2">User access</p>
        </div>
        <div class="form-group row">
            <br>
            @if($setting->user_access == 1)
                <div class="radio radio-info form-check-inline">
                    <input type="radio" id="user_access1" value="1" name="user_access" checked>
                    <label for="user_access1"> All Pages </label>
                </div>
                <div class="radio form-check-inline">
                    <input type="radio" id="user_access2" value="0" name="user_access">
                    <label for="user_access2"> Only Dashboard </label>
                </div>
            @else
                <div class="radio radio-info form-check-inline">
                    <input type="radio" id="user_access1" value="1" name="user_access" >
                    <label for="user_access1"> All Pages </label>
                </div>
                <div class="radio form-check-inline">
                    <input type="radio" id="user_access2" value="0" name="user_access" checked>
                    <label for="user_access2"> Only Dashboard </label>
                </div>
            @endif
            

        </div>
        <div class="form-group row">
            <div class="col-8 ">
                <br>
                <br>
                <br>
                <button type="submit" class="btn btn-primary waves-effect waves-light">
                    Save settings
                </button>

            </div>
        </div>
    {{ Form::close() }}
</div> <!-- end card-box -->