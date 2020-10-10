@extends('user.auth-master')


@section('page-level-css')
<style type="text/css">
    .error{
        color: red !important;
    }
</style>
@stop

@section('content')


<div class="account-pages mt-5 mb-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-pattern">

                <div class="card-body p-4">
                    
                    <div class="text-center w-75 m-auto">
                        <div class="auth-logo">
                            <a href="{{ URL::route('user.login') }}" class="logo logo-dark text-center">
                                <span class="logo-lg">
                                    <img src="{{ asset('public//assets/images/logo-dark.png') }}" alt="" height="70">
                                </span>
                            </a>
        
                            <a href="{{ URL::route('user.login') }}" class="logo logo-light text-center">
                                <span class="logo-lg">
                                    <img src="{{ asset('public/assets/images/logo-light.png') }}" alt="" height="70">
                                </span>
                            </a>
                        </div>
                        <p class="text-muted mb-4 mt-3">Please enter a new password and retype the password again for confirmation. Pelase be creative with your password for uniqueness.
After resetting you can access your account with a new password if your account is active.</p>
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

                    @include("user.login.partials.reset_pass_form")

                  

                </div> <!-- end card-body -->
            </div>
            <!-- end card -->

            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p> <a href="{{ URL::route('user.login') }}" class="text-white-50 ml-1">Back to Login</a></p>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

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


    var form1 = $('#forgot_password_form');
    var error1 = $('.alert-danger', form1);
    $("#forgot_password_form").validate({        
        rules: {
            password : {
                required: true,
                custompassword  : true
            },
            password_confirm : {
                required: true,
                custompassword  : true,
                equalTo : "#password"
            }
            
        },
        messages: {
            password: {
                required: 'Password is a required field.'
            },
            password_confirm: {
                required: 'Password confirm is a required field.',
                required: 'Password is not the same as above.'
            }
        }
    });
</script> 

</script>

@stop