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
                                   
                                    <h4 class="page-title">Settings</h4>
                                </div>
                            </div>
                        </div>     
            <!-- end page title --> 

            <div class="row">
                 <div class="col-12">
                    <div id="form-message">
                    </div>
                    @include("admin.setting.partials.form")
                 </div>
            </div>                      

           


        </div> <!-- container -->

    </div> <!-- content -->

    @include("admin.partials.master-footer")  

</div>



@stop

@section('admin-page-level-js')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@stop