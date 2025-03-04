<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lentera</title>
    <link rel="shortcut icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMjggMTI4IiBmaWxsPSJub25lIiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjgiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+CiAgPGNpcmNsZSBjeD0iNjQiIGN5PSIzNiIgcj0iMTIiIC8+CiAgPHBhdGggZD0iTTQ4IDhoMzIiIC8+CiAgPHBhdGggZD0iTTQ0IDQ4aDQwdjMyYTIwIDIwIDAgMCAxLTQwIDB6IiAvPgogIDxwYXRoIGQ9Ik02NCA4MHYyNCIgLz4KICA8cGF0aCBkPSJNNjAgMTA0aDg0IiAvPgo8L3N2Zz4=" type="image/x-icon" sizes="32x32">
    <link rel="shortcut icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSI0IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPgogIDxjaXJjbGUgY3g9IjMyIiBjeT0iMTgiIHI9IjYiIC8+CiAgPHBhdGggZD0iTTI0IDRoMTYiIC8+CiAgPHBhdGggZD0iTTIyIDI0aDIwdjE2YTEwIDEwIDAgMCAxLTIwIDB6IiAvPgogIDxwYXRoIGQ9Ik0zMiA0MHYxMiIgLz4KICA8cGF0aCBkPSJNMjggNTJoOCIgLz4KPC9zdmc+" type="image/png" sizes="32x32">
    <link rel="stylesheet" crossorigin href="/assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" crossorigin href="/assets/compiled/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/extensions/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" crossorigin href="/assets/compiled/css/extra-component-sweetalert.css">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">
                        <img id="icon-logo" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMjUzOTZmIiBzdHJva2Utd2lkdGg9IjQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+CiAgPGNpcmNsZSBjeD0iMzIiIGN5PSIxOCIgcj0iNiIgLz4KICA8cGF0aCBkPSJNMjQgNGgxNiIgLz4KICA8cGF0aCBkPSJNMjIgMjRoMjB2MTZhMTAgMTAgMCAwIDEtMjAgMHoiIC8+CiAgPHBhdGggZD0iTTMyIDQwdjEyIiAvPgogIDxwYXRoIGQ9Ik0yOCA1Mmg4IiAvPgo8L3N2Zz4=" alt="Logo" srcset="" style="width: 59px; height: 59px;">
                    Lentera</h1>
                    <p class="auth-subtitle mb-4" style="font-size: 1rem;">Memudahkan pengawalan order dengan laporan yang rapi, akurat, dan transparan. Kelola tugas lebih efisien bersama Lentera!</p>

                    @include('partials.alerts')
                    <form method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="NIK" name="nik" minlength="6" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <div class="d-flex justify-content-center">
                                <img id="captcha-img" src="{{ captcha_src() }}" alt="captcha" class="img-fluid" style="width: 200px; height: auto;">
                                <button type="button" id="refresh-captcha" class="btn btn-primary ml-2">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </div>
                            <div id="captcha-timer" class="text-center mt-2"></div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <input type="text" class="form-control form-control-xl" placeholder="Masukan Captcha" name="captcha" minlength="6" required>
                            <div class="form-control-icon">
                                <i class="bi bi-key"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>
    </div>
</body>
<script src="/assets/extensions/jquery/jquery.min.js"></script>
<script src="/assets/static/js/initTheme.js"></script>
<script src="/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
<script src="/assets/static/js/pages/sweetalert2.js"></script>
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
</html>
