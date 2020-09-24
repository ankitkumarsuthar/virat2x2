<script src="{{ asset('public/assets/js/vendor.min.js') }}"></script>

<script src="{{ asset('public/assets/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>

<!-- Plugins js-->
<script src="{{ asset('public/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<script src="{{ asset('public/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>

<!-- Dashboar 1 init js-->
<script src="{{ asset('public/assets/js/pages/dashboard-1.init.js') }}"></script>

<!-- App js-->
<script src="{{ asset('public/assets/js/app.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>

<script type="text/javascript">	
    $(document).ready(function(){
    	$(".allownumericonly").on("keypress keyup blur",function (event) {    
		   $(this).val($(this).val().replace(/[^\d].+/, ""));
		    if ((event.which < 48 || event.which > 57)) {
		        event.preventDefault();
		    }
		});

		$('.allowdecimalonly').keypress(function(evt) {
	        evt = (evt) ? evt : window.event;
	        var charCode = (evt.which) ? evt.which : evt.keyCode;
	        if (charCode == 8 || charCode == 37) {
	            return true;
	        } else if (charCode == 46 && $(this).val().indexOf('.') != -1) {
	            return false;
	        } else if (charCode > 31 && charCode != 46 && (charCode < 48 || charCode > 57)) {
	            return false;
	        } else if($(this).val().indexOf('.') != -1) {
	            var len = $(this).val().length;
	            var index   = $(this).val().indexOf('.');
	            var charAfterdot = (len + 1) - index;
	            if (charAfterdot > 3) {
	                return false;
	            }
	        }
	        return true;
	    });
	});
</script>