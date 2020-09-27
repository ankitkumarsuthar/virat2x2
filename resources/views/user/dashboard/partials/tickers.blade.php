<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                        <i class="fe-heart font-22 avatar-title text-primary"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1">{{ $user_level_data['current_level'] }}</h3>
                        <p class="text-muted mb-1 text-truncate">Your Level</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                        <i class="fe-video font-22 avatar-title text-success"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="text-dark mt-1">{{ $video_count }}/ 10</h3>
                        <p class="text-muted mb-1 text-truncate">Today's Work</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                        <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        @if(!empty($user_master->sponsor_id))
                            <h3 class="text-dark mt-1">{{ $user_master->sponser->name }}</h3>
                        @else
                            <h3 class="text-dark mt-1">No-Sponser</h3>
                        @endif
                        <p class="text-muted mb-1 text-truncate">Your Sponser</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                        <i class="fe-dollar-sign font-22 avatar-title text-warning"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ @$current_balance }} </span> ₹</h3>
                        <p class="text-muted mb-1 text-truncate">Current Wallet</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->
</div>
<!-- end row-->