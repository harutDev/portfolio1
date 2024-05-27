@extends('layouts.header')
@section('title', 'Tables')
@section('content')

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
    @endsection
