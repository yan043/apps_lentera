@php
    use Illuminate\Support\Facades\Request;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - Lentera</title>
    <link rel="shortcut icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMjggMTI4IiBmaWxsPSJub25lIiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjgiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+CiAgPGNpcmNsZSBjeD0iNjQiIGN5PSIzNiIgcj0iMTIiIC8+CiAgPHBhdGggZD0iTTQ4IDhoMzIiIC8+CiAgPHBhdGggZD0iTTQ0IDQ4aDQwdjMyYTIwIDIwIDAgMCAxLTQwIDB6IiAvPgogIDxwYXRoIGQ9Ik02NCA4MHYyNCIgLz4KICA8cGF0aCBkPSJNNjAgMTA0aDg0IiAvPgo8L3N2Zz4=" type="image/x-icon" sizes="32x32">
    <link rel="shortcut icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSI0IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPgogIDxjaXJjbGUgY3g9IjMyIiBjeT0iMTgiIHI9IjYiIC8+CiAgPHBhdGggZD0iTTI0NGgxNiIgLz4KICA8cGF0aCBkPSJNMjIgMjRoMjB2MTZhMTAgMTAgMCAwIDEtMjAgMHoiIC8+CiAgPHBhdGggZD0iTTMyIDQwdjEyIiAvPgogIDxwYXRoIGQ9Ik0yOCA1Mmg4IiAvPgo8L3N2Zz4=" type="image/png" sizes="32x32">
    <link rel="stylesheet" crossorigin href="/assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
    <link rel="stylesheet" href="/assets/extensions/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" crossorigin href="/assets/compiled/css/extra-component-sweetalert.css">
    @yield('styles')
</head>

<body>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo d-flex align-items-center">
                            <a href="/">
                                <img id="icon-logo" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNzM4NzljIiBzdHJva2Utd2lkdGg9IjQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+CiAgPGNpcmNsZSBjeD0iMzIiIGN5PSIxOCIgcj0iNiIgLz4KICA8cGF0aCBkPSJNMjQgNGgxNiIgLz4KICA8cGF0aCBkPSJNMjIgMjRoMjB2MTZhMTAgMTAgMCAwIDEtMjAgMHoiIC8+CiAgPHBhdGggZD0iTTMyIDQwdjEyIiAvPgogIDxwYXRoIGQ9Ik0yOCA1Mmg4IiAvPgo8L3N2Zz4=" alt="Logo" srcset="" style="width: 30px; height: 30px;">
                            </a>
                            <span class="ms-2 align-self-center" style="font-size: 18px;">Lentera</span>
                        </div>
                        <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                role="img" class="iconify iconify--system-uicons" width="20" height="20"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Main Menu</li>
                        <li class="sidebar-item {{ Request::is('/') ? 'active' : '' }}">
                            <a href="/" class='sidebar-link'>
                                <i class="bi bi-speedometer2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub {{ Request::is('order-management/*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-card-list"></i>
                                <span>Order Management</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item {{ Request::is('order-management/new') ? 'active' : '' }}">
                                    <a href="/order-management/new" class="submenu-link">New Orders</a>
                                </li>
                                <li class="submenu-item {{ Request::is('order-management/assigned') ? 'active' : '' }}">
                                    <a href="/order-management/assigned" class="submenu-link">Assigned Orders</a>
                                </li>
                                <li class="submenu-item {{ Request::is('order-management/ongoing') ? 'active' : '' }}">
                                    <a href="/order-management/ongoing" class="submenu-link">Ongoing Orders</a>
                                </li>
                                <li class="submenu-item {{ Request::is('order-management/completed') ? 'active' : '' }}">
                                    <a href="/order-management/completed" class="submenu-link">Completed Orders</a>
                                </li>
                                <li class="submenu-item {{ Request::is('order-management/cancel') ? 'active' : '' }}">
                                    <a href="/order-management/cancel" class="submenu-link">Cancel Orders</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item {{ Request::is('support/order-tracking') ? 'active' : '' }}">
                            <a href="/support/order-tracking" class='sidebar-link'>
                                <i class="bi bi-search"></i>
                                <span>Order Tracking</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::is('support/helpdesk-monitoring') ? 'active' : '' }}">
                            <a href="/support/helpdesk-monitoring" class='sidebar-link'>
                                <i class="bi bi-headset"></i>
                                <span>Helpdesk Monitoring</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::is('support/maps-routing') ? 'active' : '' }}">
                            <a href="/support/maps-routing" class='sidebar-link'>
                                <i class="bi bi-map"></i>
                                <span>Maps & Routing</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub {{ Request::is('technician-attendance/*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-people"></i>
                                <span>Technician Attendance</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item {{ Request::is('technician-attendance/daily-attendance') ? 'active' : '' }}">
                                    <a href="/technician-attendance/daily-attendance" class="submenu-link">Daily Attendance</a>
                                </li>
                                <li class="submenu-item {{ Request::is('technician-attendance/shift-management') ? 'active' : '' }}">
                                    <a href="/technician-attendance/shift-management" class="submenu-link">Shift Management</a>
                                </li>
                                <li class="submenu-item {{ Request::is('technician-attendance/leave-request') ? 'active' : '' }}">
                                    <a href="/technician-attendance/leave-request" class="submenu-link">Leave Requests</a>
                                </li>
                                <li class="submenu-item {{ Request::is('technician-attendance/attendance-report') ? 'active' : '' }}">
                                    <a href="/technician-attendance/attendance-report" class="submenu-link">Attendance Report</a>
                                </li>
                                <li class="submenu-item {{ Request::is('technician-attendance/late-absence-logs') ? 'active' : '' }}">
                                    <a href="/technician-attendance/late-absence-logs" class="submenu-link">Late & Absence Logs</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item has-sub {{ Request::is('inventory-management/*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-box-seam"></i>
                                <span>Inventory Management</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item {{ Request::is('inventory-management/stock-overview') ? 'active' : '' }}">
                                    <a href="/inventory-management/stock-overview" class="submenu-link">Stock Overview</a>
                                </li>
                                <li class="submenu-item {{ Request::is('inventory-management/material-request') ? 'active' : '' }}">
                                    <a href="/inventory-management/material-request" class="submenu-link">Material Request</a>
                                </li>
                                <li class="submenu-item {{ Request::is('inventory-management/material-inbound') ? 'active' : '' }}">
                                    <a href="/inventory-management/material-inbound" class="submenu-link">Material Inbound</a>
                                </li>
                                <li class="submenu-item {{ Request::is('inventory-management/material-usage') ? 'active' : '' }}">
                                    <a href="/inventory-management/material-usage" class="submenu-link">Material Usage</a>
                                </li>
                                <li class="submenu-item {{ Request::is('inventory-management/material-return') ? 'active' : '' }}">
                                    <a href="/inventory-management/material-return" class="submenu-link">Material Return</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item has-sub {{ Request::is('reports-payment/*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-file-earmark-text"></i>
                                <span>Reports & Payment</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item {{ Request::is('reports-payment/daily-reports') ? 'active' : '' }}">
                                    <a href="/reports-payment/daily-reports" class="submenu-link">Daily Reports</a>
                                </li>
                                <li class="submenu-item {{ Request::is('reports-payment/technician-performance') ? 'active' : '' }}">
                                    <a href="/reports-payment/technician-performance" class="submenu-link">Technician Performance</a>
                                </li>
                                <li class="submenu-item {{ Request::is('reports-payment/billing-payment') ? 'active' : '' }}">
                                    <a href="/reports-payment/billing-payment" class="submenu-link">Billing & Payment</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">Administrator</li>
                        <li class="sidebar-item has-sub {{ Request::is('employee-management/*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-badge"></i>
                                <span>Employee Management</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item {{ Request::is('employee-management/list') ? 'active' : '' }}">
                                    <a href="/employee-management/list" class="submenu-link">Employee List</a>
                                </li>
                                <li class="submenu-item {{ Request::is('employee-management/roles-permissions') ? 'active' : '' }}">
                                    <a href="/employee-management/roles-permissions" class="submenu-link">Employee Roles & Permissions</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item has-sub {{ Request::is('regional-unit/*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-globe"></i>
                                <span>Regional & Unit</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item {{ Request::is('regional-unit/regional') ? 'active' : '' }}">
                                    <a href="/regional-unit/regional" class="submenu-link">Regional</a>
                                </li>
                                <li class="submenu-item {{ Request::is('regional-unit/witel') ? 'active' : '' }}">
                                    <a href="/regional-unit/witel" class="submenu-link">Witel</a>
                                </li>
                                <li class="submenu-item {{ Request::is('regional-unit/unit') ? 'active' : '' }}">
                                    <a href="/regional-unit/unit" class="submenu-link">Unit</a>
                                </li>
                                <li class="submenu-item {{ Request::is('regional-unit/sub-unit') ? 'active' : '' }}">
                                    <a href="/regional-unit/sub-unit" class="submenu-link">Sub Unit</a>
                                </li>
                                <li class="submenu-item {{ Request::is('regional-unit/mitra') ? 'active' : '' }}">
                                    <a href="/regional-unit/mitra" class="submenu-link">Mitra</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item has-sub {{ Request::is('reporting-configuration/*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-sliders"></i>
                                <span>Reporting Configuration</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item {{ Request::is('reporting-configuration/status') ? 'active' : '' }}">
                                    <a href="/reporting-configuration/status" class="submenu-link">Order Status</a>
                                </li>
                                <li class="submenu-item {{ Request::is('reporting-configuration/sub-status') ? 'active' : '' }}">
                                    <a href="/reporting-configuration/sub-status" class="submenu-link">Order Sub Status</a>
                                </li>
                                <li class="submenu-item {{ Request::is('reporting-configuration/segments') ? 'active' : '' }}">
                                    <a href="/reporting-configuration/segments" class="submenu-link">Order Segments</a>
                                </li>
                                <li class="submenu-item {{ Request::is('reporting-configuration/actions') ? 'active' : '' }}">
                                    <a href="/reporting-configuration/actions" class="submenu-link">Order Actions</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main" class='layout-navbar navbar-fixed'>
            <header>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="clock-container" style="margin-left: 15px; font-size: 14px; color: #73879c">
                            <span id="clock"></span>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0">
                                @php
                                    $ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
                                    $isMob = is_numeric(strpos($ua, "mobile"));
                                @endphp
                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{ Session::get('full_name') }}</h6>
                                            <p class="mb-0 text-sm text-gray-600">{{ ucwords(str_replace('_', ' ', Session::get('level_name'))) }}</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="/assets/compiled/jpg/{{ Session::get('gender') }}.jpg">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{ explode(' ', Session::get('full_name'))[0] }}!</h6>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/profile">
                                            <i class="icon-mid bi bi-person me-2"></i> My Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/logout">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>@yield('title')</h3>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        @for ($i = 0; $i <= count(Request::segments()); $i++)
                                            <li class="breadcrumb-item {{ $i == count(Request::segments()) ? 'active' : '' }}" aria-current="page">
                                                @if ($i < count(Request::segments()))
                                                    <a href="{{ url(implode('/', array_slice(Request::segments(), 0, $i))) }}">
                                                        {{ $i == 0 ? 'View' : ucwords(str_replace(['-', '_'], ' ', Request::segment($i))) }}
                                                    </a>
                                                @else
                                                    {{ ucwords(str_replace(['-', '_'], ' ', Request::segment($i))) }}
                                                @endif
                                            </li>
                                        @endfor
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    @include('partials.alerts')
                    @yield('content')
                </div>
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>{{ date('Y') }} &copy; Lentera</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/static/js/initTheme.js"></script>
    <script src="/assets/static/js/components/dark.js"></script>
    <script src="/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/compiled/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="/assets/static/js/pages/sweetalert2.js"></script>
    @yield('scripts')
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
