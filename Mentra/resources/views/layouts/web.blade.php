<!doctype html>
<html class="no-js" lang="">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('system/images/logo.jpg') }}" type="image/x-icon">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Diphylleia&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Merienda:wght@300..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">


</head>


<body>

    <button onclick="scrollToTop()" id="topBtn" title="Go to top">
        <i class="fa fa-arrow-up"></i>
    </button>

    {{-- navbar wow pulse --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="{{ asset('img/logo-png.png') }}" class="logo-nav"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('/') ? 'active' : '' }}"
                            href="{{ route('/') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('studyinfo.index') ? 'active' : '' }}"
                            href="{{ route('studyinfo.index') }}">Start Study</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('todolist.index') ? 'active' : '' }}"
                            href="{{ route('todolist.index') }}">To do list</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reminders.index') ? 'active' : '' }}"
                            href="{{ route('reminders.index') }}">Reminders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('study_progress.index') ? 'active' : '' }}"
                            href="{{ route('study_progress.index') }}">Study Progress</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('music.index', 'chatbot.index', 'youtube_video', 'sleepredict', 'articals.index') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ request()->routeIs('community') ? 'active' : '' }}"
                                    href="{{ route('community') }}">Study community</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('music.index') ? 'active' : '' }}"
                                    href="{{ route('music.index') }}">FocusZen Music</a></li>
                            {{-- <li><a class="dropdown-item {{ request()->routeIs('chatbot.index') ? 'active' : '' }}"
                                    href="{{ route('chatbot.index') }}">Chatbot</a></li> --}}
                            <li><a class="dropdown-item {{ request()->routeIs('youtube_video') ? 'active' : '' }}"
                                    href="{{ route('youtube_video') }}">YouTube Video Analyzer</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('sleepredict') ? 'active' : '' }}"
                                    href="{{ route('sleepredict') }}">Sleep Predictor</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('articals.index') ? 'active' : '' }}"
                                    href="{{ route('articals.index') }}">Study Article</a></li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('topfocuzers.index') ? 'active' : '' }}"
                                    href="{{ route('topfocuzers.index') }}">Top Focuzers</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('challenges.index') ? 'active' : '' }}"
                                    href="{{ route('userchallenges.index') }}">Study Challenges</a>
                            </li>

                        </ul>
                    </li>

                </ul>
                <ul class="d-flex navbar-nav right-ul" role="search">
                    <li class="nav-item">
                        @guest
                            <a class="nav-link " href="{{ route('login') }}" title="Login to your FocusZen account">Login</a>
                        <li class="nav-item">
                            <a class="nav-link reg-btn" href="{{ route('register') }}" title="Create a new FocusZen account">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link reg-btn" href="{{ route('register') }}">{{ Auth::user()->name }}</a>
                        </li>
                        <a class="nav-link" style="font-weight: 800;font-size: 19px;color: black;" title="Logout From your FocusZen account"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    {{-- navbar end --}}




    <div class="container">
        @yield('content')
    </div>




    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger intent="WELCOME" chat-title="FocusZen" agent-id="6970697c-c0ef-4a7e-9345-54ad879609e3"
        language-code="en"></df-messenger>


    {{-- Footer --}}
    <footer class="footer text-center text-light">
        <div class="container mt-5">

            <div class="row pb-5 pt-5">
                <div class="col-md-3">
                    <img src="{{ asset('img/logo-footer.jpg') }}" alt="FocusZen Logo" class="img-fluid">
                    <h5 class="font-family-custom">Follow Us</h5>
                    <div class="d-flex justify-content-center">
                        <a href="https://facebook.com" class="text-light me-3"><i class="fa fa-facebook-official"
                                aria-hidden="true"></i></a>
                        <a href="https://twitter.com" class="text-light me-3"><i class="fa fa-twitter-square"
                                aria-hidden="true"></i></a>
                        <a href="https://instagram.com" class="text-light me-3"><i class="fa fa-instagram"
                                aria-hidden="true"></i></a>
                        <a href="https://linkedin.com" class="text-light"><i class="fa fa-linkedin-square"
                                aria-hidden="true"></i></a>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="font-family-custom">Quick Links</h5>
                    <ul class="list-unstyled footer_links">
                        <li><a href="{{ route('/') }}" class="text-light">Home</a></li>
                        <li><a href="{{ route('reminders.index') }}" class="text-light">Reminders</a></li>
                        <li><a href="{{ route('studyinfo.index') }}" class="text-light">Start Study</a></li>
                        <li><a href="{{ route('study_progress.index') }}" class="text-light">Study Progress</a></li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h5 class="font-family-custom">Contact</h5>
                    <ul class="list-unstyled footer_contact">
                        <li><a href="mailto:contact@focuszen.com" class="text-light">contact@focuszen.com</a></li>
                        <li><a href="tel:+1234567890" class="text-light">+94 765536428</a></li>
                        <li>Kurunegala, Giriulla/Bopitiya</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row mt-1">
                <div class="col all-right">
                    <p class="font-family-custom">&copy; 2024 FocusZen. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>


</body>


<!-- js -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<!-- Add SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.7/countUp.umd.js"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script src="{{ asset('js/myjs.js') }}"></script>





<script>
    new WOW().init();
</script>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        function startCount(id, target) {
            let count = 0;
            const speed = 50;
            const counter = document.getElementById(id);

            function updateCount() {
                if (count < target) {
                    count += Math.ceil(target / 100);
                    counter.textContent = count.toLocaleString();
                    setTimeout(updateCount, speed);
                } else {
                    counter.textContent = target.toLocaleString();
                }
            }

            function handleIntersection(entries) {
                if (entries[0].isIntersecting) {
                    updateCount();
                    observer.disconnect();
                }
            }

            const observer = new IntersectionObserver(handleIntersection, {
                threshold: 0.5
            });
            observer.observe(counter);
        }

        startCount("studentsCount", 50);
        startCount("featuresCount", 9);
    });
</script>



<script>
    window.onscroll = function() {
        var btn = document.getElementById("topBtn");
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    };

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navbar = document.querySelector(".navbar");
        const originalMargin = 350;

        window.addEventListener("scroll", function() {
            if (window.scrollY > originalMargin) {
                navbar.classList.add("fixed-top");
            } else {
                navbar.classList.remove("fixed-top");
            }
        });
    });
</script>


{{-- <script>
    const hourHand = document.querySelector('.hour-hand');
    const minuteHand = document.querySelector('.minute-hand');
    const secondHand = document.querySelector('.second-hand');

    function setDate() {
        const now = new Date();

        const seconds = now.getSeconds();
        const secondsDegrees = ((seconds / 60) * 360) + 90;
        secondHand.style.transform = `rotate(${secondsDegrees}deg)`;

        const minutes = now.getMinutes();
        const minutesDegrees = ((minutes / 60) * 360) + ((seconds / 60) * 6) + 90;
        minuteHand.style.transform = `rotate(${minutesDegrees}deg)`;

        const hours = now.getHours();
        const hoursDegrees = ((hours / 12) * 360) + ((minutes / 60) * 30) + 90;
        hourHand.style.transform = `rotate(${hoursDegrees}deg)`;
    }

    setInterval(setDate, 1000);

    setDate();
</script> --}}




</html>
