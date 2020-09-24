@extends('admin.admin-master')


@section('admin-page-level-css')



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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">MLM</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                <li class="breadcrumb-item active">Create User</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create User</h4>
                    </div>
                </div>
            </div>                     

           
            @include("admin.user.partials.form")


        </div> <!-- container -->

    </div> <!-- content -->

    @include("admin.partials.master-footer")  

</div>



@stop

@section('admin-page-level-js')


<script type="text/javascript">
  
$(document).ready(function() {

    // $('.kt-selectpicker').selectpicker();

    // $('.bootstrap-switch').bootstrapSwitch();

    jQuery.validator.addMethod("custompassword", function(value, element) {
        // allow any non-whitespace characters as the host part
        return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/.test( value );
    }, '{{ trans($lang."password_invalid_lbl") }}');

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
                required: true,
                email:true,
                // remote: {
                //     url: '{{ URL::route("user.users.check.email") }}',
                //     type: "post",
                //     data: {
                //         id: 0
                //     }
                // }
            }, 
            user_password : {
                required        : true, 
                custompassword  : true
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