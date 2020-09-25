@extends('user.user-master')


@section('user-page-level-css')
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
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Wallet</a></li>
                            <li class="breadcrumb-item active">Transactions</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All Transactions</h4>
                </div>
            </div>
        </div>  
        <!-- end page title -->
    
       @include("user.wallet.partials.transaction_table")
        
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
                ajax: '{{ URL::route("user.wallet.all_transactions.getlist") }}',      
                columns: [
                    { data: 'id', name: 'id', width: 300 }, 
                    { data: 'entry_date', name: 'entry_date', width: 300 }, 
                    { data: 'payment_detail', name: 'payment_detail', width: 300 }, 
                    { data: 'sending_or_receiving', name: 'sending_or_receiving', width: 300 }, 
                    { data: 'pay_amount', name: 'pay_amount', width: 300 }, 
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