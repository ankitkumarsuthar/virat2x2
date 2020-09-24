<!DOCTYPE html>
<html lang="en">
    <head>
        @include("user.partials.user-header")        
        @yield('user-page-level-css')

    </head>

    <body>
			
        <!-- Begin page -->
        <div id="wrapper">

		<!--- Sidemenu -->
				
            @include("user.partials.user-sidebar")  
                
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

           @yield('content');

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

    
        @include("user.partials.user-footer")  
        @include("user.partials.success")      
        @include("user.partials.error")  
        @yield('page-level-js')   
        
    </body>
</html>
