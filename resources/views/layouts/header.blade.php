
{{--    <!DOCTYPE html>--}}
{{--    <html xmlns="http://www.w3.org/1999/xhtml">--}}
{{--    <head>--}}
{{--        <meta charset="utf-8" />--}}
{{--        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />--}}
{{--        <meta name="description" content="" />--}}
{{--        <meta name="author" content="" />--}}
{{--        <!--[if IE]>--}}
{{--        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">--}}
{{--        <![endif]-->--}}
{{--        <title>@yield('title')</title>--}}
{{--        <!-- BOOTSTRAP CORE STYLE  -->--}}
{{--        <link href="{{asset("asset/css/bootstrap.css")}}" rel="stylesheet" />--}}
{{--        <!-- FONT AWESOME STYLE  -->--}}
{{--        <link href="{{asset("asset/css/font-awesome.css")}}" rel="stylesheet" />--}}
{{--        <!-- CUSTOM STYLE  -->--}}
{{--        <link href="{{asset("asset/css/style.css")}}" rel="stylesheet" />--}}
{{--        <!-- GOOGLE FONT -->--}}
{{--        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />--}}

{{--    </head>--}}
{{--    <body>--}}


{{--    <div class="navbar navbar-inverse set-radius-zero" >--}}
{{--        <div class="container">--}}
{{--            <div class="navbar-header">--}}
{{--                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">--}}
{{--                    <span class="icon-bar"></span>--}}
{{--                    <span class="icon-bar"></span>--}}
{{--                    <span class="icon-bar"></span>--}}
{{--                </button>--}}
{{--                <h1>ADMIN</h1>--}}

{{--            </div>--}}

{{--            <div class="right-div">--}}
{{--                <a href="{{route('admin.logout')}}" class="btn btn-danger pull-right">LOG ME OUT</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- LOGO HEADER END-->--}}
{{--    <section class="menu-section">--}}
{{--        <div class="container">--}}
{{--            <div class="row ">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="navbar-collapse collapse ">--}}
{{--                        <ul id="menu-top" class="nav navbar-nav navbar-right">--}}
{{--                            <li><a href="{{route("admin.adminDashboard")}}" class="menu-top-active">DASHBOARD</a></li>--}}

{{--                            <li><a href="{{route("admin.adminForm")}}">FORMS</a></li>--}}


{{--                            <li><a href="{{route("admin.adminTable")}}">TABLES</a></li>--}}


{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@yield("header-content")--}}

{{--    <!-- resources/views/layouts/app.blade.php -->--}}

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
        <title>@yield('title')</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="{{asset("asset/css/bootstrap.css")}}" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="{{asset("asset/css/font-awesome.css")}}" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="{{asset("asset/css/style.css")}}" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>
    <body>
    <div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
           <a href="{{route('welcome')}}"  >   ADMIN   </a>

            </div>

            <div class="right-div">
                <a href="{{route('admin.logout')}}" class="btn btn-danger pull-right">LOG ME OUT</a>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="{{route("admin.adminDashboard")}}" class="menu-top-active">DASHBOARD</a></li>

                            <li><a href="{{route("admin.adminForm")}}">FORMS</a></li>


                            <li><a href="{{route("admin.adminTable")}}">TABLES</a></li>


                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <main>
        @yield('content')
    </main>

    <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2014 Yourdomain.com |<a href="http://www.binarytheme.com/" target="_blank"  > Designed by : binarytheme.com</a>
                </div>

            </div>
        </div>
    </section>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="{{asset("asset/js/jquery-1.10.2.js")}}"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="{{asset("asset/js/bootstrap.js")}}"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="{{asset("asset/js/custom.js")}}"></script>
    </body>
    </html>

