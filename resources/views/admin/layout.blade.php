<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    @include('admin.partials.html_head')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('admin.partials.header')
    @include('admin.partials.left_menu')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title or '' }}
                <small>{{ $pageSecond or '' }}</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
    </footer>

</div>
<!-- ./wrapper -->

@include('admin.partials.html_scripts')
</body>
</html>
