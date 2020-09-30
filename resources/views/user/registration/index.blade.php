@extends('user.auth-master')


@section('page-level-css')

@stop

@section('content')

<div class="account-pages mt-5 mb-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card bg-pattern">

                <div class="card-body p-4">
                    
                    <div class="text-center mb-4">
                        <div class="auth-logo">
                            <a href="index.html" class="logo logo-dark text-center">
                                <span class="logo-lg">
                                    <img src="{{ asset('public//assets/images/logo-dark.png') }}" alt="" height="70">
                                </span>
                            </a>
        
                            <a href="index.html" class="logo logo-light text-center">
                                <span class="logo-lg">
                                    <img src="{{ asset('public/assets/images/logo-light.png') }}" alt="" height="70s">
                                </span>
                            </a>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-warning fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">
                                @foreach ($errors->all() as $error)
                                    <p class="mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif

                    @include("user.registration.partials.form")
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div>
            <!-- end card -->

        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- end container -->
</div>

@stop

@section('page-level-js')

<script type="text/javascript">
    jQuery.validator.addMethod("custompassword", function(value, element) {
        // allow any non-whitespace characters as the host part
        return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/.test( value );
    }, 'Password must contains 8 to 16 characters which have 1 uppercase character, 1 lowercase character, 1 number and 1 special character (#?!@$%^&*-). Example: Sumit@123');

    var form1 = $('#admin_register_form_id');
    var error1 = $('.alert-danger', form1);
    $("#admin_register_form_id").validate({
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

            if(element.attr("name") == "terms_check" )     
                error.insertAfter("#terms_check-error-new");
            else
                error.insertAfter(element);
        },
        rules: {
            user_name: {
                required: true            
            }, 
            email: {
                required: true,
                email:true,
                remote: {
                    url: '{{ URL::route("user.users.check.email") }}',
                    type: "post",
                    data: {
                        id: 0
                    }
                }
            }, 
            password: {
                required: true,
                custompassword  : true
            }, 
            terms_check2: {
                required: true                
            },
            mobile:{
                number: true
            },
            user_sponser_id:{
                number: true
            }
            
        },
        messages: {
            email: {
                required: 'Email is a required field.',
                 email: 'Invalid Eamil formage.', 
                 remote: 'Duplicate email detected.'
            },             
            password : {
                required : 'Password is a required field.'
            },             
            user_name : {
                required : 'User name is required field.'
            }, 
            terms_check2: {
                required : 'Check terms and condition of MLM application.'              
            }, 
            mobile: {
                required : 'Invalid mobile number.'              
            }, 
            user_sponser_id: {
                required : 'Invalid sponser id.'              
            }
        }
    });

</script>

@stop