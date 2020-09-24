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
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    
    @include("admin.dashboard.partials.level")
    


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


    var form1 = $('#add_user_form');
    var error1 = $('.alert-danger', form1);
    $("#add_user_form").validate({
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
            user_email: {
                required: true                
            }, 
            user_password : {
                required        : true
            },
            user_name: {
                required: true
            }, 
            user_mobile : {
                number: true
            }
            
            
        },
        messages: {
            user_email: {
                required: 'Email is a required field.',
                 email: 'Invalid Eamil formage.', 
                 remote: 'Duplicate email detected.'
            },             
            user_password : {
                required : 'Password is a required field.'
            },             
            user_name : {
                required : 'User name is required field.'
            },              
            user_mobile: {
               number : 'Invalid mobile number.'              
            }
        }
    });
});

</script>

@stop