<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login - Lentera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/images/lentera-light.ico">

    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="/assets/js/plugin.js"></script>

    <link rel="stylesheet" type="text/css" href="/assets/libs/toastr/build/toastr.min.css">
    <link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary-subtle">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Welcome Back!</h5>
                                        <p>Sign in to continue to <b>Lentera</b>.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="/assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="#" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="/assets/images/logo.svg" alt="" class="rounded-circle" height="60">
                                        </span>
                                    </div>
                                </a>
                                <a href="#" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="/assets/images/logo-light.svg" alt="" class="rounded-circle" height="60">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                @include('partials.alerts')
                                <form method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik" placeholder="Enter NIK" minlength="6" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                            <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>

                                    <div class="mb-3 text-center">
                                        <div class="d-flex justify-content-center">
                                            <img id="captcha-img" src="{{ captcha_src() }}" alt="captcha" class="img-fluid" style="width: 200px; height: auto;">
                                            <button type="button" id="refresh-captcha" class="btn btn-primary ml-2">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                        <div id="captcha-timer" class="text-center mt-2"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="captcha" class="form-label">Captcha</label>
                                        <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Enter Captcha" minlength="6" maxlength="6" required>
                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Log In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <script src="/assets/libs/toastr/build/toastr.min.js"></script>
    <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            var interval;

            function startTimer(duration, display) {
                var timer = duration, minutes, seconds;
                interval = setInterval(function() {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    display.text(minutes + ":" + seconds);

                    if (--timer < 0) {
                        clearInterval(interval);
                        refreshCaptcha();
                    }
                }, 1000);
            }

            function refreshCaptcha() {
                clearInterval(interval);
                $('#captcha-img').attr('src', '{{ captcha_src() }}' + '?' + Math.random());
                startTimer(60, $('#captcha-timer'));
            }

            $('#refresh-captcha').click(function() {
                refreshCaptcha();
            });

            startTimer(60, $('#captcha-timer'));
        });
    </script>

    <script src="/assets/js/app.js"></script>
</body>
</html>
