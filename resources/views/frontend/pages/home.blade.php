@extends('frontend.layouts.app')
@section('content')
    <div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('assets/frontend') }}/images/bg_1.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
                data-scrollax-parent="true">
                <div class="col-xl-10 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                    <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"> Event
                        <br><span>Coldplay 2024</span>
                    </h1>
                    <p class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">22 Desember 2024,
                        Bandung Jawa Barat</p>
                    <div id="timer" class="d-flex mb-3">
                        <div class="time" id="days"></div>
                        <div class="time pl-4" id="hours"></div>
                        <div class="time pl-4" id="minutes"></div>
                        <div class="time pl-4" id="seconds"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section services-section bg-light">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-placeholder"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Venue</h3>
                            <p> Book concert tickets anywhere and anytime</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-world"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Transport</h3>
                            <p>All access to national and international concerts is at TIKO</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-hotel"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Hotel</h3>
                            <p>Cheap and safe ticket purchases can be at TIKO</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-cooking"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Restaurant</h3>
                            <p>With Tiko you can find your favorite artists and concerts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-counter img" id="section-counter">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 d-flex">
                    <div class="img d-flex align-self-stretch"
                        style="background-image:url({{ asset('assets/frontend') }}/images/about.jpg);"></div>
                </div>
                <div class="col-md-6 pl-md-5 py-5">
                    <div class="row justify-content-start pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading">About Us</span>
                            <h2 class="mb-4">{{ $pengaturan->site_name }}</h2>
                            <p>Together with TIKO, we will create a fun and memorable concert experience 
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center py-4 bg-light mb-4">
                                <div class="text">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="flaticon-guest"></span>
                                    </div>
                                    <strong class="number" data-number="30">{{ $total['artis'] }}</strong>
                                    <span>Artis</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center py-4 bg-light mb-4">
                                <div class="text">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="flaticon-handshake"></span>
                                    </div>
                                    <strong class="number" data-number="200">{{ $total['event'] }}</strong>
                                    <span>Event</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center py-4 bg-light mb-4">
                                <div class="text">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="flaticon-idea"></span>
                                    </div>
                                    <strong class="number" data-number="40">{{ $total['berita'] }}</strong>
                                    <span>Berita</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Artist</span>
                    <h2 class="mb-4"><span>Our</span> Artist</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="carousel-testimony owl-carousel">
                        @foreach ($data_artis as $artis)
                            <div class="item">
                                <div class="speaker">
                                    <img src="{{ $artis->foto() }}" class="img-fluid" alt="Colorlib HTML5 Template">
                                    <div class="text text-center py-3">
                                        <h3>{{ $artis->nama }}</h3>
                                        <span class="position">{{ $artis->genre }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Event</span>
                    <h2><span>Recent</span> Event</h2>
                </div>
            </div>
            <div class="container">
                <div class="row d-flex">
                    @foreach ($latest_event as $event)
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="blog-entry justify-content-end w-100">
                                <a href="{{ route('events.show', $event->uuid) }}" class="block-20"
                                    style="background-image: url('{{ $event->gambar() }}');">
                                </a>
                                <div class="text p-4 float-right d-block">
                                    <div class="d-flex align-items-center pt-2 mb-4">
                                        <div class="one">
                                            <span class="day">{{ $event->tanggal_mulai->translatedFormat('d') }}</span>
                                        </div>
                                        <div class="two">
                                            <span class="yr">{{ $event->tanggal_mulai->translatedFormat('Y') }}</span>
                                            <span class="mos">{{ $event->tanggal_mulai->translatedFormat('F') }}</span>
                                        </div>
                                    </div>
                                    <h3 class="heading mt-2"><a
                                            href="{{ route('events.show', $event->uuid) }}">{{ $event->nama }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Our News</span>
                    <h2><span>Recent</span> News</h2>
                </div>
            </div>
            <div class="row d-flex">
                @foreach ($latest_news as $news)
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="blog-entry justify-content-end">
                            <a href="{{ route('posts.show', $news->slug) }}" class="block-20"
                                style="background-image: url('{{ $news->image() }}');">
                            </a>
                            <div class="text p-4 float-right d-block">
                                <div class="d-flex align-items-center pt-2 mb-4">
                                    <div class="one">
                                        <span class="day">{{ $news->created_at->translatedFormat('d') }}</span>
                                    </div>
                                    <div class="two">
                                        <span class="yr">{{ $news->created_at->translatedFormat('Y') }}</span>
                                        <span class="mos">{{ $news->created_at->translatedFormat('F') }}</span>
                                    </div>
                                </div>
                                <h3 class="heading mt-2"><a
                                        href="{{ route('posts.show', $news->slug) }}">{{ $news->title }}
                                </h3>
                                <p>{{ $news->meta_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(function() {
            function makeTimer() {
                var endTime = new Date("21 December 2021 9:56:00 GMT+01:00");
                endTime = Date.parse(endTime) / 1000;

                var now = new Date();
                now = Date.parse(now) / 1000;

                var timeLeft = endTime - now;

                var days = Math.floor(timeLeft / 86400);
                var hours = Math.floor((timeLeft - days * 86400) / 3600);
                var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
                var seconds = Math.floor(
                    timeLeft - days * 86400 - hours * 3600 - minutes * 60
                );

                if (hours < "10") {
                    hours = "0" + hours;
                }
                if (minutes < "10") {
                    minutes = "0" + minutes;
                }
                if (seconds < "10") {
                    seconds = "0" + seconds;
                }

                $("#days").html(days + "<span>Days</span>");
                $("#hours").html(hours + "<span>Hours</span>");
                $("#minutes").html(minutes + "<span>Minutes</span>");
                $("#seconds").html(seconds + "<span>Seconds</span>");
            }
        })
    </script>
@endpush
