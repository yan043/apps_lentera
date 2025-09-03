@php
    use Illuminate\Support\Facades\Request;
@endphp
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title', 'Dashboard') - Lentera</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="/assets/libs/toastr/build/toastr.min.css">

        @yield('styles')

        <script src="/assets/js/plugin.js"></script>
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

                        <div class="clock-container d-flex align-items-center" style="margin-left: 10px; font-size: 14px; color: #73879c;">
                            <span id="clock"></span>
                        </div>

                        @php
                            $ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
                            $isMob = is_numeric(strpos($ua, "mobile"));
                        @endphp
                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="/assets/images/{{ Session::get('gender') }}.png"
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
                            <li class="{{ Request::is('/') ? 'active' : '' }}">
                                <a href="/" class="waves-effect">
                                    <i class="bx bx-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('work-order-management/*') ? 'active' : '' }}">
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-list-check"></i>
                                    <span>Work Order Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class="{{ Request::is('work-order-management/new') ? 'active' : '' }}"><a href="/work-order-management/new">New Orders</a></li>
                                    <li class="{{ Request::is('work-order-management/assigned') ? 'active' : '' }}"><a href="/work-order-management/assigned">Assigned Orders</a></li>
                                    <li class="{{ Request::is('work-order-management/in-progress') ? 'active' : '' }}"><a href="/work-order-management/in-progress">In Progress</a></li>
                                    <li class="{{ Request::is('work-order-management/completed') ? 'active' : '' }}"><a href="/work-order-management/completed">Completed Orders</a></li>
                                    <li class="{{ Request::is('work-order-management/cancelled') ? 'active' : '' }}"><a href="/work-order-management/cancelled">Cancelled Orders</a></li>
                                </ul>
                            </li>
                            <li class="{{ Request::is('support/order-tracking') ? 'active' : '' }}">
                                <a href="/support/order-tracking" class="waves-effect">
                                    <i class="bx bx-search-alt-2"></i>
                                    <span>Order Tracking</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('support/helpdesk-monitoring') ? 'active' : '' }}">
                                <a href="/support/helpdesk-monitoring" class="waves-effect">
                                    <i class="bx bx-support"></i>
                                    <span>Helpdesk Monitoring</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('support/maps-routing') ? 'active' : '' }}">
                                <a href="/support/maps-routing" class="waves-effect">
                                    <i class="bx bx-map-alt"></i>
                                    <span>Maps & Routing</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('technician-attendance/*') ? 'active' : '' }}">
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user-check"></i>
                                    <span>Technician Attendance</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class="{{ Request::is('technician-attendance/daily-attendance') ? 'active' : '' }}"><a href="/technician-attendance/daily-attendance">Daily Attendance</a></li>
                                    <li class="{{ Request::is('technician-attendance/shift-management') ? 'active' : '' }}"><a href="/technician-attendance/shift-management">Shift Management</a></li>
                                    <li class="{{ Request::is('technician-attendance/leave-request') ? 'active' : '' }}"><a href="/technician-attendance/leave-request">Leave Requests</a></li>
                                    <li class="{{ Request::is('technician-attendance/attendance-report') ? 'active' : '' }}"><a href="/technician-attendance/attendance-report">Attendance Report</a></li>
                                    <li class="{{ Request::is('technician-attendance/late-absence-logs') ? 'active' : '' }}"><a href="/technician-attendance/late-absence-logs">Late & Absence Logs</a></li>
                                </ul>
                            </li>
                            <li class="{{ Request::is('inventory-management/*') ? 'active' : '' }}">
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-box"></i>
                                    <span>Inventory Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class="{{ Request::is('inventory-management/stock-overview') ? 'active' : '' }}"><a href="/inventory-management/stock-overview">Stock Overview</a></li>
                                    <li class="{{ Request::is('inventory-management/material-request') ? 'active' : '' }}"><a href="/inventory-management/material-request">Material Request</a></li>
                                    <li class="{{ Request::is('inventory-management/material-inbound') ? 'active' : '' }}"><a href="/inventory-management/material-inbound">Material Inbound</a></li>
                                    <li class="{{ Request::is('inventory-management/material-usage') ? 'active' : '' }}"><a href="/inventory-management/material-usage">Material Usage</a></li>
                                    <li class="{{ Request::is('inventory-management/material-return') ? 'active' : '' }}"><a href="/inventory-management/material-return">Material Return</a></li>
                                </ul>
                            </li>
                            <li class="{{ Request::is('reports-payment/*') ? 'active' : '' }}">
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-file"></i>
                                    <span>Reports & Payment</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class="{{ Request::is('reports-payment/daily-reports') ? 'active' : '' }}"><a href="/reports-payment/daily-reports">Daily Reports</a></li>
                                    <li class="{{ Request::is('reports-payment/technician-performance') ? 'active' : '' }}"><a href="/reports-payment/technician-performance">Technician Performance</a></li>
                                    <li class="{{ Request::is('reports-payment/billing-payment') ? 'active' : '' }}"><a href="/reports-payment/billing-payment">Billing & Payment</a></li>
                                </ul>
                            </li>
                            <li class="menu-title">Administrator</li>
                            <li class="{{ Request::is('employee-management/*') ? 'active' : '' }}">
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-user-circle"></i>
                                    <span>Employee Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class="{{ Request::is('employee-management/list') ? 'active' : '' }}"><a href="/employee-management/list">Employee List</a></li>
                                    <li class="{{ Request::is('employee-management/roles-permissions') ? 'active' : '' }}"><a href="/employee-management/roles-permissions">Employee Roles & Permissions</a></li>
                                </ul>
                            </li>
                            <li class="{{ Request::is('organization-structure/*') ? 'active' : '' }}">
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-user-detail"></i>
                                    <span>Organization Structure</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class="{{ Request::is('organization-structure/regional') ? 'active' : '' }}"><a href="/organization-structure/regional">Regional</a></li>
                                    <li class="{{ Request::is('organization-structure/witel') ? 'active' : '' }}"><a href="/organization-structure/witel">Witel</a></li>
                                    <li class="{{ Request::is('organization-structure/sub-unit') ? 'active' : '' }}"><a href="/organization-structure/sub-unit">Sub Unit</a></li>
                                    <li class="{{ Request::is('organization-structure/sub-group') ? 'active' : '' }}"><a href="/organization-structure/sub-group">Sub-Group</a></li>
                                    <li class="{{ Request::is('organization-structure/mitra') ? 'active' : '' }}"><a href="/organization-structure/mitra">Mitra</a></li>
                                    <li class="{{ Request::is('organization-structure/service-area') ? 'active' : '' }}"><a href="/organization-structure/service-area">Service Area</a></li>
                                    <li class="{{ Request::is('organization-structure/team') ? 'active' : '' }}"><a href="/organization-structure/team">Team</a></li>

                                </ul>
                            </li>
                            <li class="{{ Request::is('reporting-configuration/*') ? 'active' : '' }}">
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-cog"></i>
                                    <span>Reporting Configuration</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class="{{ Request::is('reporting-configuration/status') ? 'active' : '' }}"><a href="/reporting-configuration/status">Order Status</a></li>
                                    <li class="{{ Request::is('reporting-configuration/sub-status') ? 'active' : '' }}"><a href="/reporting-configuration/sub-status">Order Sub Status</a></li>
                                    <li class="{{ Request::is('reporting-configuration/segments') ? 'active' : '' }}"><a href="/reporting-configuration/segments">Order Segments</a></li>
                                    <li class="{{ Request::is('reporting-configuration/actions') ? 'active' : '' }}"><a href="/reporting-configuration/actions">Order Actions</a></li>
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
                                        @yield('title', 'Dashboard')
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
        <script src="/assets/libs/toastr/build/toastr.min.js"></script>

        @yield('scripts')

        <script src="/assets/js/app.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                var isMob = {!! json_encode($isMob) !!};

                if (isMob == false) {
                    function showTime() {
                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                        var date = new Date();
                        var day = date.getDate();
                        var month = date.getMonth();
                        var thisDay = date.getDay();
                        thisDay = myDays[thisDay];
                        var yy = date.getFullYear();
                        var year = yy;

                        var today = new Date();
                        var curr_hour = today.getHours();
                        var curr_minute = today.getMinutes();
                        var curr_second = today.getSeconds();

                        curr_hour = checkTime(curr_hour);
                        curr_minute = checkTime(curr_minute);
                        curr_second = checkTime(curr_second);

                        document.getElementById('clock').innerHTML = thisDay + ', ' + day + ' ' + months[month] + ' ' + year + ' | ' + curr_hour + ":" + curr_minute + ":" + curr_second;
                    }

                    function checkTime(i) {
                        if (i < 10) {
                            i = "0" + i;
                        }
                        return i;
                    }
                    setInterval(showTime, 500);
                }

                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;
                        var accuracy = position.coords.accuracy;
                        var roundedAccuracy = Math.round(accuracy * 100) / 100;

                        console.log("Latitude:", lat);
                        console.log("Longitude:", lng);
                        console.log("Accuracy:", roundedAccuracy, "meters");

                        $('#latitude').html(`${lat}`);
                        $('#longitude').html(`${lng}`);
                        $('#accuracy').html(`${roundedAccuracy}`);
                    }, function(error) {
                        switch(error.code) {
                            case error.PERMISSION_DENIED:
                                console.error("User denied the request for Geolocation.");
                                break;
                            case error.POSITION_UNAVAILABLE:
                                console.error("Location information is unavailable.");
                                break;
                            case error.TIMEOUT:
                                console.error("The request to get user location timed out.");
                                break;
                            case error.UNKNOWN_ERROR:
                                console.error("An unknown error occurred.");
                                break;
                        }
                    }, {
                        enableHighAccuracy: true,
                        maximumAge: 10000,
                        timeout: 5000,
                    });
                } else {
                    console.error("Geolocation is not available.");
                }
            });
        </script>

    </body>
</html>
