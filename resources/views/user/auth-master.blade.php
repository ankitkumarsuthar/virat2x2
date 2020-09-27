<!DOCTYPE html>
<html lang="en">
    <head>
        @include("user.partials.auth-header")        
        @yield('page-level-css')
        <style type="text/css">
            .help-block-error{
                color: red !important;
                font-family: inherit;
            }
        </style>
    </head>

    <body class="authentication-bg authentication-bg-pattern">

        @yield('content');

        @include("user.partials.auth-footer")   
        @include("user.partials.success")      
        @include("user.partials.error")       
        @yield('page-level-js')        
        
    </body>
</html>