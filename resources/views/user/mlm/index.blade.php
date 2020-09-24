    @extends('user.user-master')


@section('page-level-css')

@stop

@section('content')

<div class="content-page">
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        
           <!-- start page title -->
        @include("user.myaccount.partials.title")   
        <!-- end page title -->
    
     
        
        <div class="row">
            <div class="col-xl-6">

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
                
                @include("user.myaccount.partials.personal_detail") 
                @include("user.myaccount.partials.change_password")                
                
                
            </div> <!-- end col -->
            @include("user.myaccount.partials.bank_detail") 
           
            
           </div>
        


    </div> <!-- container -->

</div> <!-- content -->

<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                2018 - <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="">Coderthemes</a> 
            </div>
            
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

@include("user.partials.user-footer-text") 

@stop

@section('page-level-js')

<script type="text/javascript">
    
    jQuery.validator.addMethod("custompassword", function(value, element) {
        // allow any non-whitespace characters as the host part
        return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/.test( value );
    }, 'Password must contains 8 to 16 characters which have 1 uppercase character, 1 lowercase character, 1 number and 1 special character (#?!@$%^&*-). Example: Sumit@123');


    var form1 = $('#change_passwor_form');
    var error1 = $('.alert-danger', form1);
    $("#change_passwor_form").validate({
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
            old_password: {
                required: true,
                custompassword  : true
            }, 
            new_password: {
                required: true,
                custompassword  : true
            }
            
        },
        messages: {                        
            old_password : {
                required : 'Password is a required field.'
            },
            new_password : {
                required : 'Password is a required field.'
            }
        }
    });

    
</script> 

</script>

@stop