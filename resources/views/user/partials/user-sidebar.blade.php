<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">

           

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>

          
           
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-bell noti-icon"></i>
                    <span class="badge badge-danger rounded-circle noti-icon-badge">{{ $notification_count }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-right">
                               {{--  <a href="" class="text-dark">
                                    <small>Clear All</small>
                                </a> --}}
                            </span>Notification
                        </h5>
                    </div>

                    <div class="noti-scroll" data-simplebar>

                     

                        @if(!empty($notification))
                            @foreach($notification as $note)
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary">
                                        <i class="mdi mdi-comment-account-outline"></i>
                                    </div>
                                    <p class="notify-details">{{ $note->title }}</p>
                                    <p class="text-muted mb-0 user-msg">
                                        <small>{{ $note->details }}</small>
                                    </p>
                                </a>
                            @endforeach
                        @endif
                        

                    </div>

                   

                </div>
            </li>

            <li class=" notification-list">
                <a href="{{ URL::route('user.logout') }}" class="nav-link waves-effect waves-light">
                    <i class="fe-lock noti-icon"></i> <span class="pro-user-name ml-1">
                        Logout 
                    </span>
                </a>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="{{ asset('public/assets/images/logo-sm.png') }}" alt="" height="22">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('public/assets/images/logo-dark.png') }}" alt="" height="20">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
            </a>

            <a href="index.html" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('public/assets/images/logo-sm.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('public/assets/images/logo-light.png') }}" alt="" height="20">
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
                    <a href="{{ URL::route('user.dashboard') }}">
                        <i data-feather="airplay"></i>
						<span> Dashboard </span>
                    </a>
                   
                </li>

                <li class="menu-title mt-2">Menu</li>

                <li>
                    <a href="{{ URL::route('user.work.index') }}">
                        <i data-feather="video"></i>
                        <span> Work </span>
                    </a>
                </li>
				
				<li>
                    <a href="{{ URL::route('user.myaccount') }}">
                        <i data-feather="user"></i>
                        <span> My Account </span>
                    </a>
                </li>
				
				<li>
                    <a href="tree.php">
                        <i data-feather="share-2"></i>
                        <span> Downline Tree </span>
                    </a>
                </li>
				 
				 <li>
                    <a href="#sidebarCrm" data-toggle="collapse">
                        <i data-feather="dollar-sign"></i>
                        <span> Wallet </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                             <li>
                                <a href="{{ URL::route('user.wallet.transfer.to.another') }}">Transfer to Account</a>
                            </li>
							<li>
                                <a href="{{ URL::route('user.wallet.withdraw.index') }}">Withdraw Money</a>
                            </li>
                            <li>
                                <a href="{{ URL::route('user.wallet.all_transactions.index') }}">Transactions</a>
                            </li>
                           
                        </ul>
                    </div>
                </li>
				
				{{-- <li>
                    <a href="#">
                        <i data-feather="gift"></i>
                        <span> Referral Bonus  </span>
                    </a>
                </li> --}}
				
				
				
				<li>
                    <a href="{{ URL::route('user.logout') }}">
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
