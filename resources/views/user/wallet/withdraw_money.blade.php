@extends('user.user-master')


@section('user-page-level-css')

@stop

@section('content')

 <div class="content-page">
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        
         <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Withdraw Money</h4>
                </div>
            </div>
        </div>   
        <!-- end page title -->
    
       @include("user.wallet.partials.withdraw_money_form")
        
    </div> <!-- container -->

</div> <!-- content -->

<!-- Footer Start -->
@include("user.partials.user-footer-text")  
<!-- end Footer -->

</div>



@stop

@section('page-level-js')

<script type="text/javascript">
  
$(document).ready(function() {

    var form1 = $('#send_money');
    var error1 = $('.alert-danger', form1);
    $("#send_money").validate({
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
            receiver_unique_id: {
                required: true,
                number: true
            }, 
            transfer_amount : {
                required: true,
                number: true
            }, 
            transfer_message : {
                required: true
            }
        },
        messages: {                         
            receiver_unique_id : {
                required : 'Receiver Unique ID is required field.',
                number : 'Invalid Receiver Unique ID. Enter correct one !!!'
            },              
            transfer_amount: {
               required : 'Enter amount of transfer.',
               number : 'Invalid amount detail.'              
            },              
            transfer_message: {
               required : 'Enter something with transction detail.'            
            }
        }
    });
});

</script>

@stop