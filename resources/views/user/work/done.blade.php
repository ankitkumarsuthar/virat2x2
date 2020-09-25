@extends('user.user-master')


@section('page-level-css')

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
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Wallet</a></li>
                                <li class="breadcrumb-item active">Transactions</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Work Finish - Came Back Tomorrow</h4>
                    </div>
                </div>
            </div>      
        <!-- end page title -->
    
       {{-- @include("user.work.partials.buttons") --}}
       {{-- @include("user.work.partials.video") --}}


    </div> <!-- container -->

</div> <!-- content -->

<!-- Footer Start -->
@include("user.partials.user-footer-text")  
<!-- end Footer -->

</div>



@stop

@section('page-level-js')


@stop