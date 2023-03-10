<!DOCTYPE html>
<html lang="en">

<head>
<title>ChatSilio </title>



<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="#">
<meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
<meta name="author" content="#">

<link rel="icon" href="{{ asset('backend/files/assets/images/favicon.ico') }}" type="image/x-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/files/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/icon/themify-icons/themify-icons.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/icon/icofont/css/icofont.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/css/style.css') }}">
</head>
<body class="fix-menu">

    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                     <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                     <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
        </div>
        </div>
    </div>

<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
<form class="md-float-material form-material" method="post" action="{{ route('user.login.submit') }}">
    @csrf
    
    <div class="auth-box card">
        <div class="card-block">
            <div class="row m-b-20">
                <div class="col-md-12">
                    <h3 class="text-center"><strong style="color:red">Chat</strong><strong>Silo</strong></h3>
                </div>
                @if (session()->has('error'))
                             <div class="col-md-12">
                    <div class="alert alert-danger icons-alert" style="margin:0">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled"></i>
                        </button>
                            <p><strong>Error!</strong> Username And Password Mismatch
                      </div>
                    </div>
                    @endif
            </div>
            <div class="form-group form-primary">
                 <input type="text" name="email" class="form-control" required="" placeholder="Your Email Address">
                <span class="form-bar"></span>
            </div>
            <div class="form-group form-primary">
                <input type="password" name="password" class="form-control" required="" placeholder="Password">
                <span class="form-bar"></span>
            </div>
            <div class="row m-t-25 text-left">
                <div class="col-12">
                    <div class="checkbox-fade fade-in-primary d-">
                    <label>
                        <input type="checkbox" value="">
                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                        <span class="text-inverse">Remember me</span>
                    </label>
                    </div>
                <div class="forgot-phone text-right f-right">
                <a href="auth-reset-password.html" class="text-right f-w-600"> Forgot
                Password?</a>
                </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign
                    in</button>
                </div>
            </div>
        <hr />
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="text-inverse text-center m-b-0">Copyright © Chatsilo All Rights Reserved</p>
                    <p class="text-inverse text-center"><a href="https://www.trigvent.com/"><b class="f-w-600"> Design by Trigvent solution</b>
                </a></p>
                </div>
            </div>
        </div>
    </div>
</form>
                 </div>
             </div>
         </div>
     </section>

<script type="text/javascript" src="{{ asset('backend/files/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/popper.js/dist/umd/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('backend/files/bower_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<script type="text/javascript" src="{{ asset('backend/files/bower_components/modernizr/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/modernizr/feature-detects/css-scrollbars.js') }}"></script>

<script type="text/javascript" src="{{ asset('backend/files/bower_components/i18next/i18next.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/jquery-i18next/jquery-i18next.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/assets/js/common-pages.js') }}"></script>
</body>
</html>