<div class="row">
<div class="col-xl-10">

<div class="card-box">
    <h4 class="header-title m-t-0">Level Wise - Daily Payment Amount & Bonus Details </h4>
    <p class="text-muted font-14 m-b-20">
       &nbsp;
    </p>    
    {{ Form::model($user, array('route' => array('admin.level.update'), 'id' => 'update_level_form', 'class' => 'kt-form kt-form--label-left', 'files' => true)) }}            
        @foreach($all_level as $key => $level)  
            <?php 
            $key++;
            ?>
            <div class="form-group row">
                <label for="hori-pass1" class="col-2 col-form-label">{{ $level['level_title'] }}<span class="text-danger">*</span></label>
                <div class="col-3">
                    <?php
                    $keyVal = $key++;
                    ?>
                    <input id="level_title_{{ $keyVal }}" type="text" name="level_title_{{ $keyVal }}" required="" class="form-control allowdecimalonly" value="{{ $level['level_payment'] }}" placeholder="Daily Payment Amount">
                </div>
                <div class="col-7">
                    <input id="level_gift_{{ $keyVal }}" type="text" name="level_gift_{{ $keyVal }}" placeholder="Bonus Details" required="" class="form-control" value="{{ $level['level_gift'] }}">
                </div>
            </div>
        @endforeach
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