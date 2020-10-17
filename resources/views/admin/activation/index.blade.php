@extends('admin.admin-master')


@section('admin-page-level-css')
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
                       
                        <h4 class="page-title">Pending Activation List</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->                       

           
            @include("admin.activation.partials.table")


        </div> <!-- container -->

    </div> <!-- content -->

    @include("admin.partials.master-footer")  

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
                ajax: '{{ URL::route("admin.activation.getlist") }}',      
                columns: [
                    { data: 'id', name: 'id', width: 100 , "visible": true }, 
                    { data: 'self_sponsor_key', name: 'self_sponsor_key', width: 300 }, 
                    { data: 'name', name: 'name', width: 300 }, 
                    { data: 'email', name: 'email', width: 300 }, 
                    { data: 'sponser', name: 'sponser', width: 300 }, 
                    { data: 'mobile', name: 'mobile', width: 300 }, 
                    // { data: 'created_at', name: 'created_at', width: 300 }, 
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
    }

    function deleteClient(id)
    {
        var url = $("#delete_"+id).data('url');   

        swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((result) => {
                console.log(result);
              if (result) {
                $.ajax({
                    type : 'GET',
                    url : url,
                    success: function(data) {
                        if( data.reqstatus == 'success' ) {        
                            //swal.fire("", data.msg, "success");
                            showFormMessage('alert alert-success fade show', 'fa fa-check-circle', data.message);
                            loadClientList();
                        } else {
                            showFormMessage('alert alert-danger fade show', 'fa fa-exclamation-circle', data.message);
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        
                    }
                });
              } 
            }); 
    }


   
</script>

@stop