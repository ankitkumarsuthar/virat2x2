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
                                   
                                    <h4 class="page-title">Notification</h4>
                                </div>
                            </div>
                        </div>     
            <!-- end page title --> 

            <div class="row">
                 <div class="col-12">
                    <div id="form-message">
                    </div>
                    @include("admin.notification.partials.form")
                    @include("admin.notification.partials.table")
                 </div>
            </div>                      

           


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
                ajax: '{{ URL::route("admin.notification.getlist") }}',      
                columns: [
                    { data: 'title', name: 'title', width: 300 , "visible": true }, 
                    { data: 'details', name: 'details', width: 600 }, 
                    
                    // { data: 'created_at', name: 'created_at', width: 300 }, 
                    { data: 'action', name: 'action', width: 100 }, 
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
              text: "Once deleted, you will not be able to recover this notification file!",
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

<script type="text/javascript">
  
$(document).ready(function() {


    var form1 = $('#notification_form');
    var error1 = $('.alert-danger', form1);
    $("#notification_form").validate({
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
            title: {
                required: true                
            }, 
            details : {
                required: true
            }
        },
        messages: {
            title: {
                required: 'Title is a required field.'
            },             
            details : {
                required : 'Detail is a required field.'
            }
        }
    });
});

</script>

@stop