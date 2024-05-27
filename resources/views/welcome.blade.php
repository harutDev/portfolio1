@php use App\Models\Educations;use App\Models\User; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>The Card HTML5 Template by tooplate.com</title>
    <!--
Template 2109 The Card
http://www.tooplate.com/view/2109-the-card
-->
    <!-- load CSS -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600"
    />
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}"/>
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="{{ asset('asset/slick/slick.css') }}"/>
    <link rel="stylesheet" href="{{ asset('asset/slick/slick-theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('asset/css/magnific-popup.css') }}"/>
    <link rel="stylesheet" href="{{ asset('asset/css/tooplate-style.css') }}"/>
    <style>

        .custom-figure {
            width: 200px;
            height: 200px;
            overflow: hidden;
            margin: 10px;
            position: relative;
        }

        .custom-figure img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .custom-figure figcaption {
            position: absolute;
            bottom: 0;
            width: 100%;
            color: white;
            text-align: center;
            padding: 10px;
        }
        .wrapper{
            margin:2px 0;
        }
        a.first:after{
            left:0;
        }
        a.before:hover:before,a.after:hover:after{
            width:100%;
        }
        a,a:visited,a:hover,a:active{
            -webkit-backface-visibility:hidden;
            backface-visibility:hidden;
            position:relative;
            transition:0.5s color ease;
            text-decoration:none;
            color:#81b3d2;
            font-size:1.8em;
        }
        a:hover{
            color:#d73444;
        }
        a.before:before,a.after:after{
            content: "";
            transition:0.5s all ease;
            -webkit-backface-visibility:hidden;
            backface-visibility:hidden;
            position:absolute;
        }
        a.before:before{
            top:-0.25em;
        }
        a.after:after{
            bottom:-0.25em;
        }
        a.before:before,a.after:after{
            height:5px;
            height:0.35rem;
            width:0;
            background:#d73444;
        }
        a.first:after{
            left:0;
        }

    </style>
    <!-- Templatemo style -->
</head>

<body>
<!-- Loader -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

<div class="tm-main-container">
    <div class="tm-top-container">
        <!-- Menu -->
        <nav id="tmNav" class="tm-nav">
            <a class="tm-navbar-menu" href="#">Menu</a>
            <ul class="tm-nav-links">
                <li class="tm-nav-item active">
                    <a href="#" data-linkid="0" data-align="right" class="tm-nav-link">Intro</a>
                </li>
                <li class="tm-nav-item">
                    <a href="#" data-linkid="1" data-align="right" class="tm-nav-link">About</a>
                </li>
                <li class="tm-nav-item">
                    <a
                        href="#"
                        data-linkid="2"
                        data-align="middle"
                        class="tm-nav-link">Work</a>
                </li>
                <li class="tm-nav-item">
                    <a href="#" data-linkid="3" data-align="left" class="tm-nav-link">Contact</a>
                </li>

            </ul>
        </nav>

        <!-- Site header -->
        @if(!is_null($userInfo))
            @php
                $lang = explode(',',$userInfo->languages);
                $phones = explode(',',$userInfo->phone);
            @endphp
            <header class="tm-site-header-box tm-bg-dark">
                <h1 class="tm-site-title">{{$userInfo->name ?? ''}} {{$userInfo->surname ?? ''}}</h1>
                <p class="mb-0 tm-site-subtitle">Address: {{$userInfo->address ?? ''}}</p>
                <p class="mb-0 tm-site-subtitle">Phone:
                    @foreach($phones as $item)
                        {{$item}}
                    @endforeach
                </p>
                <p class="mb-0 tm-site-subtitle">Email: {{$userInfo->email ?? ''}}</p>
                <p class="mb-0 tm-site-subtitle">Age: {{$userInfo->age ?? ''}}</p>
                <p class="mb-0 tm-site-subtitle">Gender: {{$userInfo->gender ?? ''}}</p>
                <p class="mb-0 tm-site-subtitle">Languages:
                    @foreach($lang as $item)
                        {{$item}}
                    @endforeach
                </p>
                <p class="mb-0 tm-site-subtitle">Education:
                    @foreach($userInfo->educations as $item)
                        {{ $item->name}}
                    @endforeach
                </p>
                @if(session('message'))
                    <div class="{{session('message') === 'Mail sent' ? 'alert alert-success' : 'alert alert-danger'}}">
                        {{ session('message') }}
                    </div>
                @endif
            </header>
        @endif
    </div>
    <!-- tm-top-container -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Site content -->
                <div class="tm-content">
                    <!-- Section 0 Introduction -->
                    <section class="tm-section tm-section-0">
                        <h2 class="tm-section-title mb-3 font-weight-bold" style="color: black">
                            My Projects
                        </h2>
                        <div class="tm-textbox tm-bg-dark">
                            @foreach($userInfo->posts as $item)
                                <p class="mb-0 tm-site-subtitle">
                                    @if(!is_null($item->additionalLinks))
                                        <div class="wrapper">
                                            <a class="first after" href="{{$item->additionalLinks->name}}">{{$item->links}}</a>
                                        </div>
                                    @endif
                                </p>
                            @endforeach

                        </div>
                        <a href="#" id="tm_about_link" data-linkid="1" class="tm-link">Next</a>
                    </section>

                    <!-- Section 1 About Me -->
                    <section class="tm-section tm-section-1">
                        <div class="tm-textbox tm-textbox-2 tm-bg-dark">
                            <h2 class="tm-text-blue mb-4">About Me</h2>
                            <p class="mb-4">
                                {{$userInfo->informations[0]->about_me ?? ''}}
                            </p>

                            <a
                                href="#"
                                id="tm_work_link"
                                data-linkid="2"
                                class="tm-link m-0"
                            >Next</a
                            >
                        </div>
                    </section>

                    <!-- Section 2 Work (Gallery) -->
                    @if(!is_null($userInfo))
                        <section class="tm-section tm-section-2 mx-auto">
                            <div class="grid tm-gallery">

                                @if(count($userInfo->posts) === 0)
                                    @for($i = 1; $i < 10; ++$i)
                                        <figure  class="effect-goliath tm-gallery-item custom-figure"  >
                                            <img  src="{{asset('asset/img/0'.$i)}}.jpg"
                                                 alt="">
                                            <figcaption style="width: 150px; height: 150px ">
                                                <h2>
                                                    <span>image_{{$i}}</span>
                                                </h2>
                                                <p>image_{{$i}}</p>
                                                <a href="{{asset('asset/img/0'.$i)}}.jpg">View more</a>

                                            </figcaption>
                                        </figure>
                                    @endfor
                                @else
                                    @foreach($userInfo->posts as $item)
                                        <figure class="effect-goliath tm-gallery-item custom-figure">
                                            <img src="{{ asset('storage/assets/images/'.$item->image_pate) }}"
                                                 alt={{ $item->image_name}}>
                                            <figcaption>
                                                <h2>
                                                    <span>{{$item->iamge_name}}</span>
                                                </h2>
                                                <p>{{$item->links}}</p>
                                                <a href="{{ asset('storage/assets/images/'.$item->image_pate) }}">View more</a>

                                            </figcaption>
                                        </figure>
                                    @endforeach
                                @endif
                            </div>
                        </section>
                    @endif

                    <!-- Section 3 Contact -->
                    <section class="tm-section tm-section-3 tm-section-left">
                        <form action="{{route("send")}}" class="tm-contact-form" method="post">
                            @csrf
                            <input type="hidden" name="visitor_id" value="{{$ip}}">
                            <div class="form-group mb-4">
                                <input
                                    type="text"
                                    id="contact_name"
                                    name="contact_name"
                                    class="form-control"
                                    placeholder="Name"
                                    required
                                />
                            </div>
                            <div class="form-group mb-4">
                                <input
                                    type="email"
                                    id="contact_email"
                                    name="contact_email"
                                    class="form-control"
                                    placeholder="Email"
                                    required
                                />
                            </div>
                            <div class="form-group mb-4">
                    <textarea
                        rows="4"
                        id="contact_message"
                        name="contact_message"
                        class="form-control"
                        placeholder="Message"
                        required
                    ></textarea>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn tm-send-btn tm-fl-right">
                                    Send
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="tm-bottom-container">


    </div>
</div>

<script src="{{ asset("asset/js/jquery-1.11.0.min.js") }}"></script>
<script src="{{ asset('asset/js/background.cycle.js') }}"></script>
<script src="{{ asset('asset/slick/slick.min.js') }}"></script>
<script src="{{ asset('asset/js/jquery.magnific-popup.min.js') }}"></script>
<script>
    let slickInitDone = false;
    let previousImageId = 0,
        currentImageId = 0;
    let pageAlign = "right";
    let bgCycle;
    let links;
    let eachNavLink;

    window.onload = function () {
        $("body").addClass("loaded");
    };

    function navLinkClick(e) {
        if ($(e.target).hasClass("external")) {
            return;
        }

        e.preventDefault();

        if ($(e.target).data("align")) {
            pageAlign = $(e.target).data("align");
        }

        // Change bg image
        previousImageId = currentImageId;
        currentImageId = $(e.target).data("linkid");
        bgCycle.cycleToNextImage(previousImageId, currentImageId);

        // Change menu item highlight
        $(`.tm-nav-item:eq(${previousImageId})`).removeClass("active");
        $(`.tm-nav-item:eq(${currentImageId})`).addClass("active");

        // Change page content
        $(`.tm-section-${previousImageId}`).fadeOut(function (e) {
            $(`.tm-section-${currentImageId}`).fadeIn();
            // Gallery
            if (currentImageId === 2) {
                setupSlider();
            }
        });

        adjustFooter();
    }

    $(document).ready(function () {

        $(".tm-section").fadeOut(0);
        $(".tm-section-0").fadeIn();

        let imageUrls = @json($userInfo->images->pluck('image_path'));
        console.log(imageUrls[0])
        bgCycle = $("body").backgroundCycle({

            imageUrls: [
               typeof (imageUrls[0])=="undefined" ?  "asset/img/photo-02.jpg" : 'storage/assets/images/'+imageUrls[0],
               typeof (imageUrls[1])=="undefined" ?  "asset/img/photo-03.jpg":'storage/assets/images/'+imageUrls[1],
               typeof (imageUrls[2])=="undefined" ?  "asset/img/photo-04.jpg":'storage/assets/images/'+imageUrls[2],
               typeof (imageUrls[3])=="undefined" ?  "asset/img/photo-05.jpg":'storage/assets/images/'+imageUrls[3],

            ],
            fadeSpeed: 2000,
            duration: -1,
            backgroundSize: SCALING_MODE_COVER
        });

        eachNavLink = $(".tm-nav-link");
        links = $(".tm-nav-links");

        // "Menu" open/close
        if (links.hasClass("open")) {
            links.fadeIn(0);
        } else {
            links.fadeOut(0);
        }

        $("#tm_about_link").on("click", navLinkClick);
        $("#tm_work_link").on("click", navLinkClick);

        // Each menu item click
        eachNavLink.on("click", navLinkClick);

        $(".tm-navbar-menu").click(function (e) {
            if (links.hasClass("open")) {
                links.fadeOut();
            } else {
                links.fadeIn();
            }

            links.toggleClass("open");
        });

        // window resize
        $(window).resize(function () {
            // If current page is Gallery page, set it up
            if (currentImageId === 2) {
                setupSlider();
            }

            // Adjust footer
            adjustFooter();
        });

        adjustFooter();
    }); // DOM is ready

    function adjustFooter() {
        const windowHeight = $(window).height();
        const topHeight = $(".tm-top-container").height();
        const middleHeight = $(".tm-content").height();
        let contentHeight = topHeight + middleHeight;

        if (pageAlign === "left") {
            contentHeight += $(".tm-bottom-container").height();
        }

        if (contentHeight > windowHeight) {
            $(".tm-bottom-container").addClass("tm-static");
        } else {
            $(".tm-bottom-container").removeClass("tm-static");
        }
    }

    function setupSlider() {
        let slidesToShow = 4;
        let slidesToScroll = 2;
        let windowWidth = $(window).width();

        if (windowWidth < 480) {
            slidesToShow = 1;
            slidesToScroll = 1;
        } else if (windowWidth < 768) {
            slidesToShow = 2;
            slidesToScroll = 1;
        } else if (windowWidth < 992) {
            slidesToShow = 3;
            slidesToScroll = 2;
        }

        if (slickInitDone) {
            $(".tm-gallery").slick("unslick");
        }

        slickInitDone = true;

        $(".tm-gallery").slick({
            dots: true,
            customPaging: function (slider, i) {
                var thumb = $(slider.$slides[i]).data();
                return `<a>${i + 1}</a>`;
            },
            infinite: true,
            prevArrow: false,
            nextArrow: false,
            slidesToShow: slidesToShow,
            slidesToScroll: slidesToScroll
        });

        // Open big image when a gallery image is clicked.
        $(".slick-list").magnificPopup({
            delegate: "a",
            type: "image",
            gallery: {
                enabled: true
            }
        });
    }
</script>
</body>
</html>



