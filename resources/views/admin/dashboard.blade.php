<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>FREE RESPONSIVE HORIZONTAL ADMIN</title>
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
            <h1>ADMIN</h1>

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
<!-- MENU SECTION END-->
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">ADMIN DASHBOARD</h4>

            </div>

        </div>

        <div class="row">

            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="alert alert-info back-widget-set text-center">
                    <i class="fa fa-history fa-5x"></i>
{{--                    @dd(count($userInfo->visitors))--}}
                    <h3> {{count($userInfo->visitors)}} notification</h3>

                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="alert alert-success back-widget-set text-center">
                    <i class="fa fa-bars fa-5x"></i>
                    <h3> {{count($userInfo->posts)}} post</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="alert alert-warning back-widget-set text-center">
                    <i class="fa fa-recycle fa-5x"></i>
                    <h3>{{count($userInfo->visitors)}} visit</h3>

                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="alert alert-danger back-widget-set text-center">
                    <i class="fa fa-briefcase fa-5x"></i>
                    <h3>{{count($userInfo->skills)}} skill </h3>
                    That Should Be Resolved Now
                </div>
            </div>

        </div>
        <div class="row">


            <!-- carousel.blade.php -->
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($userInfo->images as $key => $image)
                            <div class="item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/assets/images/' . $image->image_path) }}" alt="{{ $image->image_name }}" />
                            </div>
                        @endforeach
                    </div>

                    <!--INDICATORS-->
                    <ol class="carousel-indicators">
                        @foreach($userInfo->images as $key => $image)
                            <li data-target="#carousel-example" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>

                    <!--PREVIUS-NEXT BUTTONS-->
                    <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                       Notification
                    </div>



                    <div class="panel-body chat-widget-main">
                        @foreach($userInfo->visitors as $item)
                            @php
                                $timeNow = \Carbon\Carbon::now();
                                $isOlderThanOneDay = $item['created_at']->diffInDays($timeNow) > 1;

                            @endphp
                            <div class="chat-widget{{ $isOlderThanOneDay ? '-left' : '-right'}}">
                                {{$item->message}}
                            </div>

                            <div class="chat-widget-name{{ $isOlderThanOneDay ? '-left' : '-right'}}">
                                <h4> {{$item->name}}</h4>
                                <h5>{{$item->email}}</h5>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>

        </div>


        <div class="row">

            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Responsive Table Example
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th>Ip Address</th>
                                    <th>User Agent</th>
                                    <th>Referer</th>
                                    <th>Visit time</th>
                                    <th>Country Name</th>
                                    <th>Region Name</th>
                                    <th>City</th>
                                    <th>Created at</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userInfo->visitors as $item)

                                <tr>
                                    <td>{{$item}}</td>
                                    <td>{{$item->ip_address}}</td>
                                    <td>{{$item->user_agent}}</td>
                                    <td>{{$item->referrer}}</td>
                                    <td>{{$item->visit_time}}</td>
                                    <td>{{$item->country_name}}</td>
                                    <td>{{$item->region_name}}</td>
                                    <td>{{$item->city}}</td>
                                    <td>{{$item->created_at}}</td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md-4 col-sm-4 col-xs-12" >

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Compose a Message
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <div class="form-group">
                                <label>Enter Name</label>
                                <input class="form-control" type="text" />
                            </div>
                            <div class="form-group">
                                <label>Enter Email</label>
                                <input class="form-control" type="text" />
                            </div>
                            <div class="form-group">
                                <label>Subject</label>
                                <input class="form-control" type="text" />
                            </div>
                            <div class="form-group">
                                <label>Enter Message</label>
                                <input class="form-control" type="text" style="min-height:100px;" />
                            </div>

                            <div class="form-group">
                                <label>Attach File </label>
                                <input type="file" />
                            </div>

                            <div class="form-group">
                                <label>For Role </label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" />Webmaster
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" />Admin
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" />Employee
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" />User
                                    </label>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-success">Send Message </button>
                            <button type="reset" class="btn btn-primary">Reset Fields</button>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
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
