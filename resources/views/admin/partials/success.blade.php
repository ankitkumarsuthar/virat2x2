@if (Session::get('success'))
<script type="text/javascript">
	 $.toast({
        heading: 'Success !!',
        text: '{{ Session::get('success') }}',
        position: 'top-right',
        loaderBg: '#009adc',
        icon: 'success',
        hideAfter: 5000,
        stack: false
    });
</script>
@endif

