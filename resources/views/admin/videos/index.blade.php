@extends('admin.admin-master')


@section('admin-page-level-css')

@stop

@section('content')

<div class="content-page">


<div class="content">

<!-- Start Content-->
<div class="container-fluid">
    
       <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Video Link </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    
    @include("admin.videos.partials.links")
    


</div> <!-- container -->

</div> <!-- content -->

<!-- Footer Start -->
{{-- @include("admin.partials.master-footer")   --}}
<!-- end Footer -->

</div>



@stop

@section('admin-page-level-js')


<script type="text/javascript">
  
$(document).ready(function() {

});

</script>

@stop