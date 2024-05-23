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
    <link href="{{ asset("asset/css/bootstrap.css")}}" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="{{ asset("asset/css/font-awesome.css")}}" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="{{ asset("asset/js/dataTables/dataTables.bootstrap.css")}}" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="{{ asset("asset/css/style.css")}}" rel="stylesheet" />
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

                            <h1><a href="/">ADMIN</a></h1>


            </div>

            <div class="right-div">
                <a href="{{route('admin.logout')}}" class="btn btn-info pull-right">LOG ME OUT</a>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
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
                <h4 class="header-line">TABLES</h4>

                            </div>

        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Posts
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User ID</th>
                                            <th>Image Name</th>
                                            <th>Image Path</th>
                                            <th>Links</th>
                                            <th>Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                              @foreach($userInfo->posts as $key => $item)
                                        <tr class="gradeA">
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->user_id}}</td>
                                            <td>{{$item->image_name}}</td>
                                            <td>{{$item->image_pate}}</td>
                                            <td> {{$item->links}}</td>
                                            <td class="center">{{$item->created_at}}</td>
                                        </tr>
                              @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
             <div class="row">
                 <div class="col-md-12">
                     <!-- Advanced Tables -->
                     <div class="panel panel-default">
                         <div class="panel-heading">
                            Education
                         </div>
                         <div class="panel-body">
                             <div class="table-responsive">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                     <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>User ID</th>
                                         <th> Name</th>
                                         <th>Created at</th>
                                     </tr>
                                     </thead>
                                     <tbody>

                                     @foreach($userInfo->educations as $key => $item)
                                         <tr class="gradeA">
                                             <td>{{$key+1}}</td>
                                             <td>{{$item->user_id}}</td>
                                             <td>{{$item->name}}</td>
                                             <td class="center">{{$item->created_at}}</td>
                                         </tr>
                                     @endforeach

                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>
                     <!--End Advanced Tables -->
                 </div>
             </div>
                <!-- /. ROW  -->
             <div class="row">
                 <div class="col-md-12">
                     <!-- Advanced Tables -->
                     <div class="panel panel-default">
                         <div class="panel-heading">
                            Informations
                         </div>
                         <div class="panel-body">
                             <div class="table-responsive">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                     <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>User ID</th>
                                         <th>About me</th>
                                         <th>Created at</th>
                                     </tr>
                                     </thead>
                                     <tbody>

                                     @foreach($userInfo->informations as $key => $item)

                                         <tr class="gradeA">
                                             <td>{{$key+1}}</td>
                                             <td>{{$item->user_id}}</td>
                                             <td>{{$item->about_me}}</td>
                                             <td class="center">{{$item->created_at}}</td>
                                         </tr>
                                     @endforeach

                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>
                     <!--End Advanced Tables -->
                 </div>
             </div>
                <!-- /. ROW  -->
             <div class="row">
                 <div class="col-md-12">
                     <!-- Advanced Tables -->
                     <div class="panel panel-default">
                         <div class="panel-heading">
                             Skills
                         </div>
                         <div class="panel-body">
                             <div class="table-responsive">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                     <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>User ID</th>
                                         <th>Name</th>
                                         <th>Created at</th>
                                     </tr>
                                     </thead>
                                     <tbody>

                                     @foreach($userInfo->skills as $key => $item)

                                         <tr class="gradeA">
                                             <td>{{$key+1}}</td>
                                             <td>{{$item->user_id}}</td>
                                             <td>{{$item->name}}</td>
                                             <td class="center">{{$item->created_at}}</td>
                                         </tr>
                                     @endforeach

                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>
                     <!--End Advanced Tables -->
                 </div>
             </div>
                <!-- /. ROW  -->
             <div class="row">
                 <div class="col-md-12">
                     <!-- Advanced Tables -->
                     <div class="panel panel-default">
                         <div class="panel-heading">
                             Additional links
                         </div>
                         <div class="panel-body">
                             <div class="table-responsive">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                     <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>Post ID</th>
                                         <th>Name</th>
                                         <th>Created at</th>
                                     </tr>
                                     </thead>
                                     <tbody>

                                     @foreach($links as $key => $item)

                                         <tr class="gradeA">
                                             <td>{{$key+1}}</td>
                                             <td>{{$item->post_id}}</td>
                                             <td>{{$item->name}}</td>
                                             <td class="center">{{$item->created_at}}</td>
                                         </tr>
                                     @endforeach

                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>
                     <!--End Advanced Tables -->
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-12">
                     <!-- Advanced Tables -->
                     <div class="panel panel-default">
                         <div class="panel-heading">
                             Failed Jobs
                         </div>
                         <div class="panel-body">
                             <div class="table-responsive">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                     <thead>
                                     <tr>
                                         <th>Uuid</th>
                                         <th>Connection</th>
                                         <th>Queue</th>
                                         <th>Payload</th>
                                         <th>Exception</th>
                                         <th>Failed at</th>
                                     </tr>
                                     </thead>
                                     <tbody>

                                     @foreach($jobs as $key => $job)

                                         <tr class="gradeA">
                                             <td>{{$job->uuid}}</td>
                                             <td>{{$job->connection}}</td>
                                             <td>{{$job->queue}}</td>
                                             <td>{{$job->payload}}</td>
                                             <td>{{$job->exception}}</td>
                                             <td>{{$job->failed_at}}</td>
                                             <td></td>
                                             <td class="center"></td>
                                         </tr>
                                     @endforeach

                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>
                     <!--End Advanced Tables -->
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
    <script src="{{ asset("asset/js/jquery-1.10.2.js")}}"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="{{ asset("asset/js/bootstrap.js")}}"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="{{ asset("asset/js/dataTables/jquery.dataTables.js")}}"></script>
    <script src="{{ asset("asset/js/dataTables/dataTables.bootstrap.js")}}"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="{{ asset("asset/js/custom.js")}}"></script>
</body>
</html>
