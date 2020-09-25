<div class="row">
    <div class="col-lg-3">
    </div> <!-- end col -->
    <div class="col-lg-6">
        <div class="card-box">
            <div class="embed-responsive embed-responsive-16by9">
                @if(!empty($video_id) && $videoStart == 1)
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $video_id }}?ecver=1"></iframe>                
                @endif
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-lg-3">
    </div> 
</div>