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
            
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">MLM</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                <li class="breadcrumb-item active">Edit User</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit User</h4>
                    </div>
                </div>
            </div>                     

           
            @include("admin.user.partials.formEdit")


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
        if(value != '') {
            return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/.test( value );
        } else {
            return true;
        }
    }, 'Password must contains 8 to 16 characters which have 1 uppercase character, 1 lowercase character, 1 number and 1 special character (#?!@$%^&*-). Example: Sumit@123');

    var form1 = $('#edit_user_form');
    var error1 = $('.alert-danger', form1);
    $("#edit_user_form").validate({       
        rules: {   
            user_email: {
                required: true,
                email:true,
                remote: {
                    url: '{{ URL::route("admin.panel.user.check.email") }}',
                    type: "post",
                    data: {
                         id: '{{ $user->id }}'
                    }
                }
            },
            user_password : {               
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