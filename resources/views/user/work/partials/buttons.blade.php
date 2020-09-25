<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<center>
					@if(!empty($video_id))
						
						@if($current_video >= 1 && $current_video <= 9 && $videoStart == 1)
							<button type="button" class="btn btn-primary waves-effect waves-light"  onClick="redirectTo('{{ URL::route('user.work.next',['video'=>$videos_link->id]) }}');"><i class="mdi mdi-arrow-collapse-right mr-1"></i> Next </button>
						@else
							<button type="button" class="btn btn-primary waves-effect waves-light" onClick="redirectTo('{{ URL::route('user.work.start') }}');"><i class="mdi mdi-video mr-1"></i> Start Watching</button>
						@endif
						@if($current_video == 10)
							<button type="button" class="btn btn-success waves-effect waves-light" onClick="redirectTo('{{ URL::route('user.work.finish',['video'=>$videos_link->id]) }}');"><i class="fa fa-check"></i>Click to submit today's video report</button>
						@endif	
					@endif				
				</center> 
				<br>
				<center>
					Total Watched Video : {{ $current_video }} / 10
					<br>
					VIDEO START: {{ $videoStart }} <br>					
					CURRENT VIDEO: {{ $current_video }} <br>
					VIDEO END: {{ $videoEnd }}
				</center> 
			</div> <!-- end card body-->
		</div> <!-- end card -->
	</div><!-- end col-->
</div>
<!-- end row-->