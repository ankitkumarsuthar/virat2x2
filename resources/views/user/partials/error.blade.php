@if (Session::get('error'))
<script type="text/javascript">
	 $.toast({
        heading: 'Error !!',
        text: '{{ Session::get('error') }}',
        position: 'top-right',
        loaderBg: '#bf441d',
        icon: 'error',
        hideAfter: 5000,
        stack: false
    });
</script>
@endif