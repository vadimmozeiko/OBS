<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>OBS Dashboard</title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <li class="nav-item pt-3 pb-3">
            <!-- Sidebar - Brand -->
            <div class="sidebar-brand-text mx-3 d-flex align-items-center justify-content-center">
                <img class="logo" src="{{asset('assets/img/logo.png')}}" alt="logo">
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link text-center text-uppercase" href="{{route('index')}}">
                <i class="fas fa-globe"></i>
                <span>Go to Web Page</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div style="color: #fff" class="sidebar-heading">
            Daily
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ request()->is('dashboard') ? 'active-link' : '' }}">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="fas fa-calendar-check"></i>
                <span>New bookings
                   <span class="messages">
                    @if(\App\Models\Order::getNumberOfNewOrders())
                       {{\App\Models\Order::getNumberOfNewOrders()  >= 100 ?
                            '99+' : \App\Models\Order::getNumberOfNewOrders()}}
                    @else
                      0
                    @endif
                   </span>
                </span></a>
        </li>
        <li class="nav-item {{ request()->is('dashboard/messages/new') ? 'active-link' : '' }}">
            <a class="nav-link" href="{{route('message.new')}}">
                <i class="fas fa-envelope"></i>
                <span>New messages
                    <span class="messages">
                    @if(\App\Models\Contact::getNumberOfMessages())
                            {{\App\Models\Contact::getNumberOfMessages() >= 100 ?
                                '99+' : \App\Models\Contact::getNumberOfMessages()}}
                        @else
                            0
                        @endif
                        </span>
                    </span></a>
        </li>

        <li class="nav-item {{ request()->is('dashboard/notifications') ? 'active-link' : '' }}">
            <a class="nav-link" href="{{route('notifications.index')}}">
                <i class="fas fa-bell"></i>
                <span>Notifications
                   <span class="messages">
                    @if(\App\Models\Notification::getNumberOfNotifications())
                           {{\App\Models\Notification::getNumberOfNotifications() >= 100 ?
                                '99+' : \App\Models\Notification::getNumberOfNotifications()}}
                       @else
                           0
                       @endif
                   </span>
                </span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div style="color: #fff" class="sidebar-heading">
            Messages
        </div>

        <li class="nav-item {{ request()->is('dashboard/messages/create') ? 'active-link' : '' }}">
            <a class="nav-link" href="{{route('message.create')}}">
                <i class="fas fa-envelope-open"></i>
                <span>Create new message</span></a>
        </li>

        <li class="nav-item {{ request()->is('dashboard/messages') ? 'active-link' : '' }}">
            <a class="nav-link" href="{{route('message.index')}}">
                <i class="fas fa-inbox"></i>
                <span>Manage messages </span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div style="color: #fff" class="sidebar-heading">
            Bookings
        </div>

        <li class="nav-item {{ request()->is('dashboard/orders/create') ? 'active-link' : '' }}">
            <a class="nav-link" href="{{route('create.order')}}">
                <i class="fas fa-calendar-plus"></i>
                <span>Create new booking</span></a>
        </li>

        <li class="nav-item {{ request()->is('dashboard/orders') ? 'active-link' : '' }}">
            <a class="nav-link" href="{{route('list.order')}}">
                <i class="fas fa-list-alt"></i>
                <span>Manage bookings </span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div style="color: #fff" class="sidebar-heading">
            Users
        </div>

        <li class="nav-item {{ request()->is('dashboard/users/create') ? 'active-link' : '' }}">
            <a class="nav-link" href="{{route('user.create')}}">
                <i class="fas fa-user-plus"></i>
                <span>Register new user</span></a>
        </li>

        <li class="nav-item {{ request()->is('dashboard/users') ? 'active-link' : '' }}">
            <a class="nav-link" href="{{route('list.user')}}">
                <i class="fas fa-user-friends"></i>
                <span>Manage users</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div style="color: #fff" class="sidebar-heading">
            Products
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item {{ request()->is('dashboard/products/create') ? 'active-link' : '' }}">
            <a class="nav-link" href="{{route('product.create')}}">
                <i class="far fa-plus-square"></i>
                <span>Add new product</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ request()->is('dashboard/products') ? 'active-link' : '' }}">
            <a class="nav-link" href="{{route('product.index')}}">
                <i class="fas fa-list"></i>
                <span>Manage products</span></a>
        </li>

{{--        <!-- Divider -->--}}
{{--        <hr class="sidebar-divider d-none d-md-block">--}}

{{--        <!-- Sidebar Toggler (Sidebar) -->--}}
{{--        <div class="text-center d-none d-md-inline">--}}
{{--            <button class="rounded-circle border-0" id="sidebarToggle"></button>--}}
{{--        </div>--}}

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{route('user.index')}}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            @if(session()->has('success_message'))
                                <div class="alert alert-success" role="alert">
                                    {{session()->get('success_message')}}
                                </div>
                            @endif

                            @if(session()->has('info_message'))
                                <div class="alert alert-info" role="alert">
                                    {{session()->get('info_message')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Page Heading -->
                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <form action="{{ route('logout') }}" method="POST">
                    <button type="submit" class="btn btn-primary">Logout</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    @csrf
                </form>

            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('assets/js/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

<!-- Select search-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select-search').select2();
    });
</script>
</body>
</html>
