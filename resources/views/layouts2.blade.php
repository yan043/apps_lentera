@php
    use Illuminate\Support\Facades\Request;
@endphp
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title', 'Home') - Lentera</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <script src="/assets/js/plugin.js"></script>

        @yield('styles')

        <link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body data-sidebar="dark">

        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box">
                            <a href="/" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="/assets/images/logo-light.svg" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="/assets/images/logo-dark.png" alt="" height="70">
                                </span>
                            </a>

                            <a href="/" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="/assets/images/logo-light.svg" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="/assets/images/logo-light.png" alt="" height="70">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="/assets/images/users/avatar-1.jpg"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-{{ Session::get('full_name') }}">{{ Session::get('full_name') }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="/profile">
                                    <i class="bx bx-user font-size-16 align-middle me-1"></i>
                                    <span key="t-profile">Profile</span>
                                </a>
                                <a class="dropdown-item text-danger" href="/logout">
                                    <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                                    <span key="t-logout">Logout</span>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="bx bx-cog bx-spin"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </header>

            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <div id="sidebar-menu">
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Main Menu</li>
                            <li>
                                <a href="/" class="waves-effect">
                                    <i class="bx bx-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-list-check"></i>
                                    <span>Order Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/order-management/new">New Orders</a></li>
                                    <li><a href="/order-management/assigned">Assigned Orders</a></li>
                                    <li><a href="/order-management/ongoing">Ongoing Orders</a></li>
                                    <li><a href="/order-management/completed">Completed Orders</a></li>
                                    <li><a href="/order-management/cancel">Cancel Orders</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="/support/order-tracking" class="waves-effect">
                                    <i class="bx bx-search-alt-2"></i>
                                    <span>Order Tracking</span>
                                </a>
                            </li>
                            <li>
                                <a href="/support/helpdesk-monitoring" class="waves-effect">
                                    <i class="bx bx-support"></i>
                                    <span>Helpdesk Monitoring</span>
                                </a>
                            </li>
                            <li>
                                <a href="/support/maps-routing" class="waves-effect">
                                    <i class="bx bx-map-alt"></i>
                                    <span>Maps & Routing</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user-check"></i>
                                    <span>Technician Attendance</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/technician-attendance/daily-attendance">Daily Attendance</a></li>
                                    <li><a href="/technician-attendance/shift-management">Shift Management</a></li>
                                    <li><a href="/technician-attendance/leave-request">Leave Requests</a></li>
                                    <li><a href="/technician-attendance/attendance-report">Attendance Report</a></li>
                                    <li><a href="/technician-attendance/late-absence-logs">Late & Absence Logs</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-box"></i>
                                    <span>Inventory Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/inventory-management/stock-overview">Stock Overview</a></li>
                                    <li><a href="/inventory-management/material-request">Material Request</a></li>
                                    <li><a href="/inventory-management/material-inbound">Material Inbound</a></li>
                                    <li><a href="/inventory-management/material-usage">Material Usage</a></li>
                                    <li><a href="/inventory-management/material-return">Material Return</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-file"></i>
                                    <span>Reports & Payment</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/reports-payment/daily-reports">Daily Reports</a></li>
                                    <li><a href="/reports-payment/technician-performance">Technician Performance</a></li>
                                    <li><a href="/reports-payment/billing-payment">Billing & Payment</a></li>
                                </ul>
                            </li>
                            <li class="menu-title">Administrator</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-group"></i>
                                    <span>Employee Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/employee-management/list">Employee List</a></li>
                                    <li><a href="/employee-management/roles-permissions">Employee Roles & Permissions</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-world"></i>
                                    <span>Regional & Unit</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/regional-unit/regional">Regional</a></li>
                                    <li><a href="/regional-unit/witel">Witel</a></li>
                                    <li><a href="/regional-unit/sub-unit">Sub Unit</a></li>
                                    <li><a href="/regional-unit/sub-group">Sub-Group</a></li>
                                    <li><a href="/regional-unit/mitra">Mitra</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-cog"></i>
                                    <span>Reporting Configuration</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/reporting-configuration/status">Order Status</a></li>
                                    <li><a href="/reporting-configuration/sub-status">Order Sub Status</a></li>
                                    <li><a href="/reporting-configuration/segments">Order Segments</a></li>
                                    <li><a href="/reporting-configuration/actions">Order Actions</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">
                                        {{ ucfirst(Request::segment(1) ?? 'View') }}
                                    </h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            @for ($i = 1; $i <= count(Request::segments()); $i++)
                                                <li class="breadcrumb-item {{ $i == count(Request::segments()) ? 'active' : '' }}" aria-current="page">
                                                    @if ($i < count(Request::segments()))
                                                        <a href="{{ url(implode('/', array_slice(Request::segments(), 0, $i))) }}">
                                                            {{ ucwords(str_replace(['-', '_'], ' ', Request::segment($i))) }}
                                                        </a>
                                                    @else
                                                        {{ ucwords(str_replace(['-', '_'], ' ', Request::segment($i))) }}
                                                    @endif
                                                </li>
                                            @endfor
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>

                        @include('partials.alerts')

                        @yield('content')

                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Lentera.
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

        </div>

        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">

                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="/assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="/assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="/assets/images/layouts/layout-3.jpg" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch">
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="/assets/images/layouts/layout-4.jpg" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                        <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
                    </div>


                </div>

            </div>
        </div>

        <div class="rightbar-overlay"></div>

        <script src="/assets/libs/jquery/jquery.min.js"></script>
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/node-waves/waves.min.js"></script>

        @yield('scripts')

        <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="/assets/js/pages/sweet-alerts.init.js"></script>

        <script src="/assets/js/app.js"></script>

    </body>
</html>
