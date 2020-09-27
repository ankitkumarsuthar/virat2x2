<!DOCTYPE html>
<html lang="en">
    <head>  
        @include("admin.partials.master-header")        
        @yield('admin-page-level-css')
        <style type="text/css">
            .help-block-error{
                color: red !important;
                font-family: inherit;
            }
        </style>
    </head>

    <body>
			
        <!-- Begin page -->
        <div id="wrapper">

		<!--- Sidemenu -->
				@include("admin.partials.master-sidebar")  
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            @yield('content');

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        {{-- @include("admin.partials.master-footer")   --}}
        @include("admin.partials.master-footer-js")  
        @include("admin.partials.success")      
        @include("admin.partials.error")  
        @yield('admin-page-level-js')
    

		
    </body>
</html>