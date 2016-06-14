
<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>VXC</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>VaultXChange</b></span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
           <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{!! auth()->user()->full_name !!}</span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('admin.sign-out') !!}"> <span class="hidden-xs">Sign out</span></a>
                </li>
            </ul>
        </div>
    </nav>
</header>