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
@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif
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
                    <h4 class="header-line">FORM EXAMPLES</h4>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            User Form
                        </div>
                        <div class="panel-body">
                            <form action="{{route('admin.updateUser')}}" method="post" role="form">
                                @csrf
{{--                                @dd($userInfo)--}}
                                <input type="hidden" name="id" value="{{$userInfo->id}}">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" value="{{$userInfo->name}}"/>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input class="form-control" type="text" name="surname" value="{{$userInfo->surname}}"/>
                                    @error('surname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" value="{{$userInfo->email}}"/>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Enter Age</label>
                                    <input class="form-control" type="number" name="age" value="{{$userInfo->age}}"/>
                                    @error('age')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Enter Address</label>
                                    <input class="form-control" type="text" name="address" value="{{$userInfo->address}}"/>
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" type="text" name="phone" value="{{$userInfo->phone}}" />
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Gander</label>
                                    <input disabled class="form-control" type="text" name="gander" value="{{$userInfo->gander}}" />

                                </div>
                                <div class="form-group">
                                    <label>Languages</label>
                                    <input class="form-control" type="text" name="languages" value="{{$userInfo->languages}}"/>
                                    @error('languages')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-info">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if (session('success'))
                    <div>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            About Me
                        </div>
                        <div class="panel-body">
                            @if($userInfo->informations !== null)
                                <form action="{{route('admin.updateAboutMe')}}" method="post" role="form">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$userInfo->informations[0]->id}}">
                                    <div class="form-group">
                                        <textarea name="about_me" value="{{$userInfo->informations[0]->about_me}}">{{$userInfo->informations[0]->about_me}}</textarea>
                                        @error('about_me')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </form>
                            @else
                                <form action="{{route('admin.createAboutMe')}}" method="post" role="form">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="about_me"></textarea>
                                        @error('about_me')
                                        <div>{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-danger">Save</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!--/.ROW-->
  <div style="display: flex">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1> Create Education section </h1>
                        My Education
                    </div>
                    <div class="panel-body">
                        @if (session('success'))
                            <div>
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{route("admin.createEducation")}}" method="post" role="form" >
                            @csrf
                            <div class="form-group has-success">
                                <label class="control-label" for="success">My Education</label>
                                <input type="text" class="form-control" id="success" name="education" />
                                @error('education')
                                <div style="color: red">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-danger">Save </button>
                        </form>


                    </div>
                </div>
            </div>

{{--      @dd($userInfo)--}}
            @foreach($userInfo->educations as $education)

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1> Update education section </h1>
                            My education #{{$education->id}}
                            <button ><a href="{{route('admin.deleteEducation',[$education->id])}}"  class="menu-top-active">X</a></button>

                        </div>
                        <div class="panel-body">

                            <form action="{{route("admin.updateEducation")}}" method="post" role="form" >
                                @csrf
                                <input type="hidden" name="id" value="{{$education->id}}">
                                <div class="form-group has-success">
                                    <label class="control-label" for="success">My education</label>
                                    <input type="text" class="form-control" id="success" name="name" value="{{$education->name}}" />
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-danger">Update </button>
                            </form>


                        </div>
                    </div>
                </div>
            @endforeach
 </div>
            <div style="display: flex">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1> Create skills section </h1>
                        My Skills
                    </div>
                    <div class="panel-body">
                        @if (session('success'))
                            <div>
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{route("admin.createSkills")}}" method="post" role="form" >
                            @csrf
                            <div class="form-group has-success">
                                <label class="control-label" for="success">My skills</label>
                                <input type="text" class="form-control" id="success" name="name" />
                                @error('name')
                                <div style="color: red">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-danger">Save </button>
                        </form>


                    </div>
                </div>
            </div>


            @foreach($userInfo->skills as $skill)
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1> Update skills section </h1>
                            My Skills #{{$skill->id}}
                            <button ><a href="{{route('admin.deleteSkills',[$skill->id])}}"  class="menu-top-active">X</a></button>
                        </div>
                        <div class="panel-body">

                            <form action="{{route("admin.updateSkills")}}" method="post" role="form" >
                                @csrf
                                <input type="hidden" name="id" value="{{$skill->id}}">
                                <div class="form-group has-success">
                                    <label class="control-label" for="success">My skills</label>
                                    <input type="text" class="form-control" id="success" name="name" value="{{$skill->name}}" />
                                    @error('name')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-danger">Update </button>
                            </form>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
            <div style="display: flex">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1> Create post section </h1>
                        Create POSTS
                    </div>
                    <div class="panel-body">

                        <form action="{{route('admin.createPost')}}" method="post" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group has-success">
                                <label class="control-label" for="success">Image</label>
                                <input type="file" class="form-control" id="success" name="image"/>
                                @error('image_full_path')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group has-error">
                                <label class="control-label" for="error">LInks</label>
                                <input type="text" class="form-control" id="error" name="links"  />
                            </div>
                            <button type="submit" class="btn btn-danger">Save </button>
                        </form>


                    </div>
                </div>

            </div>

            @foreach($userInfo->posts as $post)

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1> Update post section </h1>
                            Update POSTS #{{ $post->id }}
                            <form action="{{route('admin.deletePost')}}" method="post" role="form">
                                @csrf
                                @method('delete')
                                    <input type="hidden" name="id" value="{{$post->id}}">
                                    <input type="hidden" name="path" value="{{$post->image_full_path}}">
                                <button type="submit" class="btn btn-danger">
                                    delete
                                </button>
                            </form>
                        </div>
                        <div class="panel-body">

                            <form action="{{route('admin.updatePost')}}" method="post" role="form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$post->id}}">

                                <img style="width: 100px; height: 100px;" src="{{ asset('storage/assets/images/'.$post->image_pate) }}" alt={{ $post->image_name}}>
                                <div class="form-group has-success">
                                    <label class="control-label" for="success">Image</label>
                                    <input type="file" class="form-control" id="success" name="image"/>
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group has-error">
                                    <label class="control-label" for="error">LInks</label>
                                    <input type="text" class="form-control" id="error" name="links" value="{{$post->links}}" />
                                    @error('links')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-danger">Update</button>
                            </form>


                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <div style="display: flex">

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1> Create Additional links </h1>

                    </div>
                    <div class="panel-body">

                        <form action="{{route("admin.createLinks")}}" method="post" role="form" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group has-success">
                                <label class="control-label" for="success">My links</label>
                                <input type="text" class="form-control" id="success" name="name" />
                                @error('name')
                                <div style="color: red">{{ $message }}</div>
                                @enderror

                                <select name="post_id">
                                    @foreach($userInfo->posts as $post)
                                        <option value="{{$post->id}}">{{$post->links}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Save </button>
                        </form>


                    </div>
                    @foreach($links as $link)
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h1> Update Additional links #{{ $link->id }} </h1>
                                    <button ><a href="{{route('admin.deleteLinks',[$link->id])}}"  class="menu-top-active">X</a></button>

                                </div>
                                <div class="panel-body">

                                    <form action="{{route("admin.updateLinks")}}" method="post" role="form"  >
                                        @csrf
                                        <input type="hidden" name="id" value="{{$link->id}}">
                                        <div class="form-group has-success">

                                            <label class="control-label" for="success">My links</label>
                                            <input type="text" class="form-control" id="success" name="name" value="{{$link->name}}"/>
                                            @error('name')
                                            <div style="color: red">{{ $message }}</div>
                                            @enderror
                                            <select name="post_id">
                                                @foreach($userInfo->posts as $post)
                                                    <option value="{{$post->id}}">{{$post->links}}</option>
                                                    @error('post_id')
                                                    <div style="color: red">{{ $message }}</div>
                                                    @enderror
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-danger">Save </button>
                                    </form>


                                </div>
                            </div>
                        </div>
                    @endforeach


                    </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1> Create Image section </h1>
                            Create Image
                        </div>
                        <div class="panel-body">

                            <form action="{{route('admin.createImage')}}" method="post" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group has-success">
                                    <label class="control-label" for="success">Image Path</label>
                                    <input type="file" class="form-control" id="success" name="image"/>
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-danger">Save </button>
                            </form>


                        </div>
                        @foreach($userInfo->images as $images)
                            <div class="col-md-6 col-sm-6 col-xs-12" style="width: 300px">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h1> Update image section </h1>
                                        Update Image #{{ $images->id }}
                                        <form action="{{route('admin.deleteImage')}}" method="post" role="form">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{$images->id}}">
                                            <input type="hidden" name="path" value="{{$images->image_full_path}}">
                                            <button type="submit" class="btn btn-danger">
                                                delete
                                            </button>
                                        </form>
                                    </div>
                                    <div class="panel-body">

                                        <form action="{{route('admin.updateImage')}}" method="post" role="form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$images->id}}">

                                            <img style="width: 100px; height: 100px;" src="{{ asset('storage/assets/images/'.$images->image_path) }}" alt={{ $images->image_name}}>
                                            <div class="form-group has-success">
                                                <label class="control-label" for="success">Image</label>
                                                <input type="file" class="form-control" id="success" name="image"/>
                                                @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <button type="submit" class="btn btn-danger">Update</button>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        @endforeach
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
    <script src="{{ asset("asset/js/jquery-1.10.2.js") }}"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="{{ asset("asset/js/bootstrap.js") }}"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="{{ asset("asset/js/custom.js") }}"></script>
</body>
</html>
