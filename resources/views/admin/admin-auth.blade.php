<!DOCTYPE html>
<html lang="en">
<head>
    @include("admin.partials.auth-header")        
    @yield('admin-page-level-css')
    <style type="text/css">
            .help-block-error{
                color: red !important;
                font-family: inherit;
            }
        </style>
</head>

<body class="authentication-bg authentication-bg-pattern">

        @yield('content');

        @include("admin.partials.auth-footer")   
        @include("admin.partials.success")      
        @include("admin.partials.error")       
        @yield('admin-page-level-js')  
    
</body>
</html>