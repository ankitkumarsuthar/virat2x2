@extends('admin.admin-master')


@section('admin-page-level-css')
<link href="{{ asset('public/assets/tree.css') }}" rel="stylesheet" type="text/css" />
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
    
       <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Downline Tree</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    
    @include("admin.tree.partials.level")
    {{-- @include("admin.tree.partials.table") --}}
    


</div> <!-- container -->

</div> <!-- content -->

<!-- Footer Start -->
{{-- @include("admin.partials.master-footer")   --}}
<!-- end Footer -->

</div>



@stop

@section('admin-page-level-js')

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

<script type="text/javascript">
    var table = '';
    jQuery(document).ready(function() {
        loadClientList();
    });

    function loadClientList()
    {
        if(table != '') {
            // a.fnDestroy();
        }        
    }

    table = $("#datatable-buttons").DataTable({
        lengthChange: !1,
        // buttons: [
        //     { extend: "copy", className: "btn-light" },
        //     { extend: "print", className: "btn-light" },
        //     { extend: "pdf", className: "btn-light" },
        // ],
         // buttons: [
         //        'copy', 'excel', 'pdf'
         //    ],
           dom: 'Bfrtip',
    buttons: [
        'copy',
        'print',
        'pdf'
    ],
         responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: '{{ URL::route("admin.mlm_tree_view.getlist") }}',      
        columns: [
            { data: 'user_name', name: 'user_name', width: 300 }, 
            { data: 'email', name: 'email', width: 300 }, 
            // { data: 'sponser', name: 'sponser', width: 300 }, 
            // { data: 'side', name: 'side', width: 300 }, 
            { data: 'action', name: 'action', width: 300 }, 
        ], 
        initComplete: function() {
            // unBlockPage();
        },
        language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" } },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        },
    });
    // a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
    // table.buttons().container()
    // .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
//     new $.fn.dataTable.Buttons( table, {
//     buttons: [
//             { extend: "copy", className: "btn-light" },
//             { extend: "print", className: "btn-light" },
//             { extend: "pdf", className: "btn-light" },
//         ]
// } );
 
// table.buttons().container().appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );


</script>

@stop