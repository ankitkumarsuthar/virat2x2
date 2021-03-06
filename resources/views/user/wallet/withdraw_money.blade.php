@extends('user.user-master')


@section('user-page-level-css')
<style type="text/css"></style>
<link href="{{ asset('public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    div.dataTables_wrapper div.dataTables_filter{
            margin-top: -33px;
    }
</style>
@stop

@section('content')

 <div class="content-page">
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        
         <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Withdraw Money</h4>
                </div>
            </div>
        </div>   
        <!-- end page title -->
    
       @include("user.wallet.partials.withdraw_money_form")
       @include("user.wallet.partials.withdraw_request_table")
        
    </div> <!-- container -->

</div> <!-- content -->

<!-- Footer Start -->
@include("user.partials.user-footer-text")  
<!-- end Footer -->

</div>



@stop

@section('page-level-js')
<script src="{{ asset('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
  
$(document).ready(function() {

    var form1 = $('#withdraw_money');
    var error1 = $('.alert-danger', form1);
    $("#withdraw_money").validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        invalidHandler: function(event, validator) { //display error alert on form submit
            error1.show();
            window.scrollTo(error1, -200);
        },
        highlight: function(element) { // hightlight error inputs
            $(element).addClass('is-invalid');
            $(element).closest('.form-group').addClass('validated'); // set error class to the control group
        },
        unhighlight: function(element) { // revert the change done by hightlight
            $(element).removeClass('is-invalid');
            $(element).closest('.form-group').removeClass('validated'); // set error class to the control group
        },
        success: function(element) {
            $(element).removeClass('is-invalid');
            $(element).closest('.form-group').removeClass('validated'); // set success class to the control group
        },
        rules: {           
            withdraw_option: {
                required: true
            }, 
            withdraw_amount : {
                required: true,
                number: true
            }
        },
        messages: {                         
            withdraw_option : {
                required : 'Withdraw option selection is a required field.'
            },              
            withdraw_amount: {
               required : 'Enter amount of withdraw.',
               number : 'Invalid amount detail.'              
            }
        }
    });
});

</script>

<script type="text/javascript">
    var table = '';
    jQuery(document).ready(function() {
        loadClientList();
    });

    function loadClientList()
    {
        // table.destroy();   
        if(table != '') {
            table.destroy();
        } 
        table = $("#datatable-buttons").DataTable({
                lengthChange: !1,    
                   dom: 'Bfrtip',
            buttons: [
                'copy',
                'print',
                'pdf'
            ],
                "order": [[ 0, "desc" ]],
                 responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: '{{ URL::route("user.wallet.request.getlist") }}',      
                columns: [
                    { data: 'withdraw_request_date', name: 'withdraw_request_date', width: 300 }, 
                    { data: 'withdraw_detail', name: 'withdraw_detail', width: 300 }, 
                    { data: 'withdraw_amount', name: 'withdraw_amount', width: 300 }, 
                    { data: 'withdraw_option', name: 'withdraw_option', width: 300 }, 
                    { data: 'withdraw_status', name: 'withdraw_status', width: 300 }, 
                ], 
                initComplete: function() {
                    // unBlockPage();
                },
                language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" } },
                drawCallback: function () {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                },
            });    
    }
</script>

@stop