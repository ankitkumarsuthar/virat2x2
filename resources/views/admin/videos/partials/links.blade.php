<div class="row">
<div class="col-xl-10">

<div class="card-box">
    <h4 class="header-title m-t-0">Youtube Video Links </h4>
    <p class="text-muted font-14 m-b-20">
       &nbsp;
    </p>    
    {{ Form::open(['route' => ['admin.videos.update'], 'class' => 'kt-form kt-form--label-left', 'name' => 'admin-login-form', 'id' => 'update_level_form' ]) }}          
        @foreach($videos_link as $key => $videos)  
        <?php
            $keyVal = $key+1;
        ?>
            <div class="form-group row">
                <label for="hori-pass1" class="col-2 col-form-label">Video{{ $keyVal }}<span class="text-danger">*</span></label>
                <div class="col-7">                    
                    <input id="video_link_{{ $keyVal }}" type="text" name="video_link_{{ $keyVal }}" required="" class="form-control" value="{{ $videos['video_link'] }}" placeholder="Daily Payment Amount">
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