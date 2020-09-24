<!DOCTYPE html>
<html lang="en">
<head>
    @include("admin.partials.auth-header")        
    @yield('admin-page-level-css')
</head>

<body class="authentication-bg authentication-bg-pattern">

        @yield('content');

        @include("admin.partials.auth-footer")   
        @include("admin.partials.success")      
        @include("admin.partials.error")       
        @yield('admin-page-level-js')  
    
</body>
</html>