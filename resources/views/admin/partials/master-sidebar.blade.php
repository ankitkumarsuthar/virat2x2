<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">

           

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>

          
          
            <li class=" notification-list">
                <a href="{{ URL::route('admin.logout') }}" class="nav-link waves-effect waves-light">
                    <i class="fe-lock noti-icon"></i> <span class="pro-user-name ml-1">
                        Logout 
                    </span>
                </a>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="{{ URL::route('admin.dashboard') }}" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="{{ asset('public/assets/images/logo-sm.png') }}" alt="" height="70">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('public/assets/images/logo-dark.png') }}" alt="" height="70">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
            </a>

            <a href="{{ URL::route('admin.dashboard') }}" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('public/assets/images/logo-sm.png') }}" alt="" height="70">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('public/assets/images/logo-light.png') }}" alt="" height="70">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>   

        
             </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->

<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

      
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>
    
                <li>
                    <a href="{{ URL::route('admin.dashboard') }}">
                        <i data-feather="airplay"></i>
						<span> Dashboard </span>
                    </a>
                   
                </li>

              
                <li>
                    <a href="{{ URL::route('admin.activation.index') }}">
                        <i data-feather="check-square"></i>
                        <span> Activation </span>
                    </a>
                </li> 
				
				<li>
                    <a href="{{ URL::route('admin.user.index') }}">
                        <i data-feather="users"></i>
                        <span> Users </span>
                    </a>
                </li>
				
				<li>
                    <a href="{{ URL::route('admin.videos.index') }}">
                        <i data-feather="video"></i>
                        <span> Video Links </span>
                    </a>
                </li>
				
				<li>
                    <a href="{{ URL::route('admin.mlm_tree_view') }}">
                        <i data-feather="share-2"></i>
                        <span> Downline </span>
                    </a>
                </li>
				
				<li>
                    <a href="{{ URL::route('admin.refferal.index') }}">
                        <i data-feather="gift"></i>
                        <span> Referral Bonus Setting  </span>
                    </a>
                </li>
				
				<li>
                    <a href="{{ URL::route('admin.withdrawal.index') }}">
                        <i data-feather="dollar-sign"></i>
                        <span> Withdrawal Request  </span>
                    </a>
                </li>
				
				 
				<li>
                    <a href="{{ URL::route('admin.notification.index') }}">
                        <i data-feather="bell"></i>
                        <span> Notification   </span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('admin.profile.index') }}">
                        <i data-feather="user"></i>
                        <span> Profile   </span>
                    </a>
                </li>

                <li>
                    <a href="{{ URL::route('admin.setting.index') }}">
                        <i class="fe-settings noti-icon"></i>
                        <span> Setting   </span>
                    </a>
                </li>
				
				<li>
                    <a href="{{ URL::route('admin.logout') }}">
                        <i data-feather="lock"></i>
                        <span> Logout </span>
                    </a>
                </li>

            </ul>
                    </div>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
