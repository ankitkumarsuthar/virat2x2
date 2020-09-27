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
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>     
        <!-- end page title -->
    
       @include("user.dashboard.partials.tickers")        
        <div class="row">                      
            @include("user.dashboard.partials.personal_detail")
            @include("user.dashboard.partials.latest_transaction")
        </div>
        


    </div> <!-- container -->

</div> <!-- content -->

<!-- Footer Start -->
@include("user.partials.user-footer-text")  
<!-- end Footer -->

</div>



@stop

@section('page-level-js')

<script type="text/javascript">
    
    jQuery.validator.addMethod("custompassword", function(value, element) {
        // allow any non-whitespace characters as the host part
        return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/.test( value );
    }, 'Password must contains 8 to 16 characters which have 1 uppercase character, 1 lowercase character, 1 number and 1 special character (#?!@$%^&*-). Example: Sumit@123');


    var form1 = $('#admin_login_form_id');
    var error1 = $('.alert-danger', form1);
    $("#admin_login_form_id").validate({
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
        errorPlacement: function(error, element) {
            if (element.attr("name") == "password" )
                error.insertAfter("#password-error-new");           
            else
                error.insertAfter(element);
        },
        rules: {
            email: {
                required: true,
                email:true
            }, 
            password: {
                required: true,
                custompassword  : true
            }
            
        },
        messages: {
            email: {
                required: 'Email is a required field.'
            },             
            password : {
                required : 'Password is a required field.'
            }
        }
    });
</script> 

</script>

@stop