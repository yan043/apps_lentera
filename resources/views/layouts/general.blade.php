<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="/theme/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    {{-- <link href="/theme/vendors/nprogress/nprogress.css" rel="stylesheet"> --}}
    <link href="/theme/build/css/custom.min.css" rel="stylesheet">
    <style>
        .nav.toggle {
            position: relative;
            top: -5px;
        }
        .dropdown-item {
            color: #73879c;
        }
        .dropdown-item:hover {
            background-color: #f7f7f7;
        }
    </style>
    @yield('css')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/" class="site_title"><i class="fa fa-fire"></i>Lentera</a>
            </div>

            <div class="clearfix"></div>

            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="/theme/production/images/avatar_{{ Session::get('gender') }}.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>{{ ucwords(str_replace('_', ' ', Session::get('level_name'))) }}</span>
                <h2>{{ Session::get('full_name') }}</h2>
              </div>
              <div class="clearfix"></div>
            </div>

            <br />

            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-trophy"></i> Provisioning <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="/provisioning/search">Search Order</a>
                        </li>
                        <li>
                            <a href="/provisioning/track">Track Order</a>
                        </li>
                        <li>
                            <a href="/provisioning/daily-report">Daily Report</a>
                        </li>
                        <li>
                            <a>
                                Dashboard
                                <span class="fa fa-chevron-down"></span>
                            </a>
                            <ul class="nav child_menu">
                                <li class="sub_menu">
                                    <a href="/provisioning/dashboard/order">Order</a>
                                </li>
                                <li>
                                    <a href="/provisioning/dashboard/undispatch">Undispatch</a>
                                </li>
                                <li>
                                    <a href="/provisioning/dashboard/productivity">Productivity</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="/provisioning/maps">Maps Order</a>
                        </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-shield"></i> Assurance <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="/assurance/search">Search Order</a>
                        </li>
                        <li>
                            <a href="/assurance/track">Track Order</a>
                        </li>
                        <li>
                            <a href="/assurance/daily-report">Daily Report</a>
                        </li>
                        <li>
                            <a>
                                Dashboard
                                <span class="fa fa-chevron-down"></span>
                            </a>
                            <ul class="nav child_menu">
                                <li class="sub_menu">
                                    <a href="/assurance/dashboard/order">Order</a>
                                </li>
                                <li>
                                    <a href="/assurance/dashboard/undispatch">Undispatch</a>
                                </li>
                                <li>
                                    <a href="/assurance/dashboard/productivity">Productivity</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="/assurance/maps">Maps Order</a>
                        </li>
                    </ul>
                  </li>
                  <li>
                    <a>
                        <i class="fa fa-suitcase"></i>
                        Shared Service
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            <a>
                                Warehouse
                                <span class="fa fa-chevron-down"></span>
                            </a>
                            <ul class="nav child_menu">
                                <li class="sub_menu">
                                    <a href="/shared_service/warehouse/stock">Stock</a>
                                </li>
                                <li>
                                    <a href="/shared_service/warehouse/return">Return</a>
                                </li>
                                <li>
                                    <a href="/shared_service/warehouse/usage">Usage</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a>
                                Procurement
                                <span class="fa fa-chevron-down"></span>
                            </a>
                            <ul class="nav child_menu">
                                <li class="sub_menu">
                                    <a href="/shared_service/procurement/document">Documents</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                  </li>
                  <li>
                    <a>
                        <i class="fa fa-group"></i>
                        Administrators
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="/administrators/employee">Employee</a>
                        </li>
                        <li>
                            <a href="/administrators/team">Team</a>
                        </li>
                        <li>
                            <a href="/administrators/sector">Sector</a>
                        </li>
                        <li>
                            <a>
                                Order
                                <span class="fa fa-chevron-down"></span>
                            </a>
                            <ul class="nav child_menu">
                                <li class="sub_menu">
                                    <a href="/administrators/order/stock">Status</a>
                                </li>
                                <li>
                                    <a href="/administrators/order/return">Action</a>
                                </li>
                                <li>
                                    <a href="/administrators/order/return">Segment</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                  </li>
                  <li>
                    <a>
                        <i class="fa fa-cog"></i>
                        Settings
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="/settings/regional">Regional</a>
                        </li>
                        <li>
                            <a href="/settings/witel">Witel</a>
                        </li>
                        <li>
                            <a href="/settings/mitra">Mitra</a>
                        </li>
                        <li>
                            <a href="/settings/level">Level</a>
                        </li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top" title="Profile" href="/profile">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Lock">
                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Logout" href="/logout">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
            </div>
          </div>
        </div>

        <div class="top_nav">
            <div class="nav_menu d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    @php
                        $ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
                        $isMob = is_numeric(strpos($ua, "mobile"));
                    @endphp
                    @if (!$isMob)
                    <div class="clock-container" style="margin-left: 15px; font-size: 14px; color: #73879c">
                        <span id="clock"></span>
                    </div>
                    @endif
                </div>
                <nav class="nav navbar-nav ml-auto">
                    <ul class="navbar-right">
                        <li class="nav-item dropdown open">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                <img src="/theme/production/images/avatar_{{ Session::get('gender') }}.png" alt="">{{ Session::get('full_name') }}
                            </a>
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile"><i class="fa fa-user pull-right"></i> Profile</a>
                                <a class="dropdown-item" href="/logout"><i class="fa fa-sign-out pull-right"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>


        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <p style="color: gray; opacity: 0.7;">
                    {{ ucwords(Request::segment(0)) ? : 'View' }} / {{ ucwords(str_replace(['-', '_'], ' ', Request::segment(1))) ? : 'Home' }}
                    @if (Request::segment(2))
                    / {{ ucwords(str_replace(['-', '_'], ' ', Request::segment(2))) ? : 'Pages' }}
                    @endif
                    @if (Request::segment(3))
                    / {{ ucwords(str_replace(['-', '_'], ' ', Request::segment(3))) ? : 'Sub Pages' }}
                    @endif
                </p>
              </div>
            </div>

            <div class="clearfix"></div>

            @yield('content')
          </div>
        </div>

        <footer>
          <div class="pull-right">
            ©{{ date('Y') }} All Rights Reserved&nbsp;<i class="fa fa-fire"></i>&nbsp;Lentera
          </div>
          <div class="clearfix"></div>
        </footer>
      </div>
    </div>

    <script src="/theme/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/theme/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="/theme/vendors/fastclick/lib/fastclick.js"></script>
    <script src="/theme/vendors/nprogress/nprogress.js"></script> --}}
    <script src="/theme/build/js/custom.min.js"></script>
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
    @yield('scripts')
  </body>
</html>
