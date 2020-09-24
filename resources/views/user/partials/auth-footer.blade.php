<footer class="footer footer-alt">
2015 - <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="" class="text-white-50">Coderthemes</a> 
</footer>

<!-- Vendor js -->
<script src="{{ asset('public/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('public/assets/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<!-- App js -->
<script src="{{ asset('public/assets/js/app.min.js') }}"></script>	

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>

<script type="text/javascript">
$(".allownumericonly").on("keypress keyup blur",function (event) {    
   $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});
function redirectTo(url)
{
	window.location = url;
}

</script>