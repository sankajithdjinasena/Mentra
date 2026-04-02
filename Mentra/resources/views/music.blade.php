@extends('layouts.web')

@section('content')
    <title>FocusZen | Music</title>
    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    <section class="container sec">


        <div class="row align-items-center">

            <div class="col-md-5 focus-timer-box">
                <h2 class="mb-4">Start the clock. Play the beat. Focus mode ON.</h2>
                <div class="content-wrapper wow fadeInDown">
                    <div class="clock-section mb-4">
                        <div id="time">
                            <span class="digit" id="hr">00</span>
                            <span class="txt">Hr</span>
                            <span class="digit" id="min">00</span>
                            <span class="txt">Min</span>
                            <span class="digit" id="sec">00</span>
                            <span class="txt">Sec</span>
                            <span class="digit" id="count">00</span>
                        </div>
                        <div id="buttons">
                            <button class="btn" id="start">Start</button>
                            <button class="btn" id="stop">Stop</button>
                            <button class="btn" id="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-7 text-center">
                <h2 class="mb-3">Focus Music for Studying</h2>
                <iframe style="border-radius: 20px;" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX4sWSpwq3LiO"
                    width="100%" height="500" frameBorder="0" allowfullscreen=""
                    allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture">
                </iframe>
            </div>
        </div>

    </section>
@endsection
