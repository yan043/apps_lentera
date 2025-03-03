<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lentera</title>

    <link href="/theme/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/theme/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">

                @include('partials.alerts')

                <section class="login_content">
                    <form method="POST">
                        @csrf
                        @method('POST')

                        <h1><i class="fa fa-fire"></i>&nbsp; Lentera</h1>
                        <div>
                            <input type="text" class="form-control text-center" placeholder="NIK" name="nik" minlength="6" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required />
                        </div>
                        <div>
                            <input type="password" class="form-control text-center" placeholder="Password" name="password" required />
                        </div>
                        <div class="form-group">
                            <label for="captcha">Captcha</label>
                            <div>
                                <img src="{{ captcha_src() }}" alt="captcha">
                                <input type="text" id="captcha" name="captcha">
                            </div>
                        </div>
                        <br /><br />
                        <div>
                            <button type="submit" class="btn btn-xl btn-dark btn-block submit">Sign In</button>
                        </div>

                        <div class="separator">
                            <div class="clearfix"></div>

                            <div>
                                <p>©{{ date('Y') }} All Rights Reserved.</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
</html>

<script src="/theme/vendors/jquery/dist/jquery.min.js"></script>
<script src="/theme/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/theme/build/js/custom.min.js"></script>
