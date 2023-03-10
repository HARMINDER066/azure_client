<nav class="navbar header-navbar pcoded-header">
   <div class="navbar-wrapper">
      <div class="navbar-logo">
         <a class="mobile-menu" id="mobile-collapse" href="#!">
            <i class="feather icon-menu"></i>
         </a>
         <a href="{{ route('admin.dashboard') }}">
            <!--<h3 class="text-center"><strong style="color:red">Chat</strong><strong>Silo</strong></h3>
                    --->
                    <img src="{{ asset('backend/files/assets/images/admin.png') }}" style="width: 50px;border-radius:50px"; class="img-radius" alt="User-Profile-Image">
         </a>
         <a class="mobile-options">
            <i class="feather icon-more-horizontal"></i>
         </a>
      </div>
      <div class="navbar-container">
         <ul class="nav-left">
            <li>
               <a href="#!" onclick="javascript:toggleFullScreen()">
                  <i class="feather icon-maximize full-screen"></i>
               </a>
            </li>
         </ul>
         <ul class="nav-right">
            <li class="user-profile header-notification">
               <div class="dropdown-primary dropdown">
                  <div class="dropdown-toggle" data-toggle="dropdown">
                     <img src="{{ asset('backend/files/assets/images/admin.png') }}" style="width: 50px;border-radius:50px"; class="img-radius" alt="User-Profile-Image">
                     @if(Auth::guard('admin')->check())
                     <span>{{Auth::guard('admin')->user()->name}}</span>
                     @endif
                     <i class="feather icon-chevron-down"></i>
                  </div>
                  <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                     <li>
                        <a href="{{ route('admin.changeemail') }}">
                           <i class="feather icon-settings"></i> Change Email
                        </a>
                     </li>
                     <li>
                        <a href="{{ route('admin.changepassword') }}">
                           <i class="feather icon-user"></i> Change Password
                        </a>
                     </li>
                     <li>
                        <a href="{{ route('admin.logout') }}">
                           <i class="feather icon-log-out"></i> Logout
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
         </ul>
      </div>
   </div>
</nav>