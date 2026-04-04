@extends('layouts.web')

@section('content')
    <title>Mentra | Home</title>

    {{-- carousel start --}}
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="rotating-text">
            Stay Focus
        </div>
        <div class="carousel-inner wow fadeInDown">
            <div class="carousel-item active">
                <img src="{{ asset('img/slider1.jpg') }}" class="d-block w-100" alt="..." style="height: 600px">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/slider4.jpg') }}" class="d-block w-100" alt="..." style="height: 600px">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/slider2.jpg') }}" class="d-block w-100" alt="..." style="height: 600px">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/slider5.jpg') }}" class="d-block w-100" alt="..." style="height: 600px">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/slider3.jpg') }}" class="d-block w-100" alt="..." style="height: 600px">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/slider6.jpg') }}" class="d-block w-100" alt="..." style="height: 600px">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>
    {{-- carousel end --}}



    {{-- About Us Section --}}
    <section class="about py-4">
        <div class="rotating-text1 ">
            About Mentra
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-5 about-side wow fadeInDown">
                    <section id="about" class="py-3 mt-2">
                        <img src="{{ asset('img/about.jpg') }}" class="d-block w-100" alt="...">
                    </section>
                </div>
                <div class="col-md-6 mt-5">
                    <section class="video-content py-5 mt-3">
                        <h1 class="video-maintxt  wow bounceInLeft">Focus Your Mind, Master Your Study</h1>
                        <br>
                        <p class="video-subtxt  wow bounceInRight">Welcome to Mentra</p>
                        <div class="container about-div mt-5 ">
                            <p class=" wow fadeInDown">At Mentra, we help you achieve clarity, productivity, and balance.
                                Designed to simplify
                                your daily tasks and keep you on track, our platform empowers you to focus on what matters
                                most. Whether you're managing work, studies, or personal goals, Mentra is your companion
                                for staying organized and mindful.
                                <br><br>
                                <span class="wow backInDown"> Stay focused. Stay zen.</span>
                            </p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>



    <section id="stats" class="countup-section">
        <div class="row">
            <div class="col-md-4 offset-md-2">
                <div class="counter-box">
                    <h2 class="count-number" id="studentsCount">0</h2>
                    <p>Students Using</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="counter-box">
                    <h2 class="count-number" id="featuresCount">0</h2>
                    <p>Features Available</p>
                </div>
            </div>
        </div>
    </section>


    <div class="container mt-5 pt-4">
        <div class="rotating-text2 ">
            Features
        </div>
        <div class="cards-feature">
            <h3 class="wow backInDown">How We Help You</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card1c wow fadeInLeft">
                        <h4>Task Management</h4>
                        <p>Create and manage a personalized to-do list to organize your tasks better. Set deadlines and
                            prioritize tasks for maximum productivity.</p>
                        <a href="{{ route('todolist.index') }}" class="button">Try it now</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card2c wow fadeInRight">
                        <h4>Study Time Analysis</h4>
                        <p>Track and visualize your study hours. View monthly progress reports to help identify trends
                            in your
                            study habits and improve efficiency.</p>
                        <a href="{{ route('study_progress.index') }}" class="button">Try it now</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card3c wow fadeInLeft">
                        <h4>Study Articles</h4>
                        <p>Access a wide variety of educational articles to enhance your learning. From tips on time
                            management
                            to subject-specific resources, you'll find valuable content to help you succeed.</p>
                        <a href="{{ route('articals.index') }}" class="button">Try it now</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card4c wow fadeInRight">
                        <h4>Start Study</h4>
                        <p>Start your study sessions with a single click. This feature helps you begin focused study
                            time
                            quickly and track your progress as you go.</p>
                        <a href="{{ route('studyinfo.index') }}" class="button">Try it now</a>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-6">
                    <div class="card card5c wow fadeInLeft">
                        <h4>Set Reminders</h4>
                        <p>Set reminders for upcoming study sessions, deadlines, or breaks to stay on track and never
                            miss an
                            important task again.</p>
                        <a href="{{ route('reminders.index') }}" class="button">Try it now</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card6c wow fadeInRight">
                        <h4>Study Community</h4>
                        <p>Not sure what to ask? That’s okay! Just type your study question, confusion, or anything you're
                            stuck with — and our amazing community of learners will help you out.</p>
                        <a href="{{ route('community') }}" class="button">Try it now</a>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-6">
                    <div class="card card5c wow fadeInRight">
                        <h4>Earn Badges</h4>
                        <p>Unlock achievement badges as you complete your study hours! Stay motivated by tracking your
                            progress and earning rewards for your dedication. Every milestone brings a new badge. !</p>
                        <a href="{{ route('study_progress.index') }}" class="button">Try it now</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card2c wow fadeInRight">
                        <h4>Get Rate Before Watching</h4>
                        <p>Receive ratings and reviews on articles, videos, and resources before diving in. Make sure
                            your time
                            is well spent by studying high-quality content.</p>
                        <a href="{{ route('youtube_video') }}" class="button">Try it now</a>
                    </div>
                </div>
            </div>

            <div class="row">
                
               
            </div>
        </div>
    </div>










    {{-- Testimonials Section --}}
    {{-- bg-light --}}
    <section class="testimonials  mt-5 pt-5 mb-5">
        <div class="rotating-text3">
            Testimonial
        </div>
        <div class="container text-center">
            <h2 class="testimonials-title wow backInDown">What Our Users Say</h2>
            <div class="container-fluid slider-column wow fadeInUpBig">
                <div class="swiper swiper-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide img-full">
                            <div class="content">
                                <a href="#" target="_blank">
                                    <div class="content-overlay"></div>
                                    <img class="content-image" src="{{ asset('img/testmonial.jpg') }}" alt="">
                                    <a href="#">

                                    </a>
                                </a>
                            </div>
                            <div class="c-detail">
                                <a href="#">
                                    <h3 class="">
                                        <blockquote>
                                            <p>"I've never been this productive before. Mentra keeps me on track every
                                                day!"</p>
                                            <cite>- Sarah Williams</cite>
                                        </blockquote>
                                    </h3>
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide img-full-1">
                            <div class="content ">
                                <a href="#" target="_blank">
                                    <div class="content-overlay"></div>
                                    <img class="content-image" src="{{ asset('img/testmonial2.jpg') }}" alt="">

                                </a>
                            </div>
                            <div class="c-detail">
                                <a href="#">
                                    <h3 class="">
                                        <blockquote>
                                            <p>"Mentra keeps me motivated and on track!"</p>
                                            <cite>- Alex Carter</cite>
                                        </blockquote>
                                    </h3>

                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide img-full">
                            <div class="content ">
                                <a href="#" target="_blank">
                                    <div class="content-overlay"></div>
                                    <img class="content-image" src="{{ asset('img/testmonial3.jpg') }}" alt="">

                                </a>
                            </div>
                            <div class="c-detail">
                                <a href="#">
                                    <h3 class="">
                                        <blockquote>
                                            <p>"My productivity has never been better!"</p>
                                            <cite>- Emily Johnson</cite>
                                        </blockquote>
                                    </h3>
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide img-full-1">
                            <div class="content ">
                                <a href="#" target="_blank">
                                    <div class="content-overlay"></div>
                                    <img class="content-image" src="{{ asset('img/testmonial4.jpg') }}" alt="">

                                </a>
                            </div>
                            <div class="c-detail">
                                <a href="#">
                                    <h3 class="">
                                        <blockquote>
                                            <p>"A game-changer for my daily routine!"</p>
                                            <cite>- Davi Smithni</cite>
                                        </blockquote>
                                    </h3>
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide img-full">
                            <div class="content ">
                                <a href="#" target="_blank">
                                    <div class="content-overlay"></div>
                                    <img class="content-image" src="{{ asset('img/testmonial5.jpg') }}" alt="">

                                </a>
                            </div>
                            <div class="c-detail">
                                <a href="#">
                                    <h3 class="">
                                        <blockquote>
                                            <p>"Staying focused has never been this easy!"</p>
                                            <cite>- Jessica Brown</cite>
                                        </blockquote>
                                    </h3>
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide img-full-1">
                            <div class="content ">
                                <a href="#" target="_blank">
                                    <div class="content-overlay"></div>
                                    <img class="content-image" src="{{ asset('img/testmonial.jpg') }}" alt="">

                                </a>
                            </div>
                            <div class="c-detail">
                                <a href="#">
                                    <h3 class="">
                                        <blockquote>
                                            <p>"Mentra helps me achieve my goals effortlessly!"</p>
                                            <cite>- Marky Davis</cite>
                                        </blockquote>
                                    </h3>
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide img-full">
                            <div class="content ">
                                <a href="#" target="_blank">
                                    <div class="content-overlay"></div>
                                    <img class="content-image" src="{{ asset('img/testmonial6.jpg') }}" alt="">

                                </a>
                            </div>
                            <div class="c-detail">
                                <a href="#">
                                    <h3 class="">
                                        <blockquote>
                                            <p>"Mentra helps me eliminate distractions and keep my priorities in line.
                                                It’s a must-have!"</p>
                                            <cite>- Jason Lee</cite>
                                        </blockquote>
                                    </h3>
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide img-full-1">
                            <div class="content ">
                                <a href="#" target="_blank">
                                    <div class="content-overlay"></div>
                                    <img class="content-image" src="{{ asset('img/testmonial7.jpg') }}" alt="">

                                </a>
                            </div>
                            <div class="c-detail">
                                <a href="#">
                                    <h3 class="">
                                        <blockquote>
                                            <p>"Mentra has transformed my daily routine. I'm more productive than ever!"
                                            </p>
                                            <cite>- Michael Brown</cite>
                                        </blockquote>
                                    </h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <span class="swiper-pagination "></span>

                </div>


            </div>

        </div>
    </section>


    {{-- feedback Section --}}
    <section>
        <div class="container mt-5">
            <h2 class="testimonials-title wow backInDown">Send Us Your Feedback</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="col-md-5 wow backInDown" style="margin: 0 auto;display: block;">
                <form method="POST" action="{{ route('feedback.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name">Your Name</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="email">Your Email</label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="message">Your Message</label>
                        <textarea name="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success" title="Submit Your Feedback">Submit Feedback</button>
                </form>
            </div>
        </div>
    </section>



    
@endsection
