@extends('admin.admin-master')


@section('admin-page-level-css')
<style type="text/css">
    .error{color: red;}
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
                <h4 class="page-title">Admin Profile Update</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    
    @include("admin.profile.partials.form")
    


</div> <!-- container -->

</div> <!-- content -->

<!-- Footer Start -->
{{-- @include("admin.partials.master-footer")   --}}
<!-- end Footer -->

</div>



@stop

@section('admin-page-level-js')
<script type="text/javascript">
    jQuery.validator.addMethod("custompassword", function(value, element) {
        if(value != '') {
            return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/.test( value );
        } else {
            return true;
        }
    }, 'Password must contains 8 to 16 characters which have 1 uppercase character, 1 lowercase character, 1 number and 1 special character (#?!@$%^&*-). Example: Sumit@123');


    var form1 = $('#save_admin_profile');
    var error1 = $('.alert-danger', form1);
    $("#save_admin_profile").validate({
          
        rules: {            
            password: {
                custompassword  : true
            },
            email: {
                required: true,
                email:true,
                remote: {
                    url: '{{ URL::route("admin.profile.check.email") }}',
                    type: "post",
                    data: {
                         id: '{{ $user->id }}'
                    }
                }
            }
            
        },
        messages: {                        
            password : {
                required : 'Password is a required field.'
            },
            email: {
                required: 'Email is a required field.',
                 email: 'Invalid Eamil formage.', 
                 remote: 'Duplicate email detected.'
            } 
        }
    });
</script>
@stop