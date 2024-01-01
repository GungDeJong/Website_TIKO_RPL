@extends('frontend.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets/frontend/') }}/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-3 bread">Berita</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a
                                href="{{ route('posts.index') }}">Berita <i class="ion-ios-arrow-forward"></i></a></span>
                        <span>{{ $item->title }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 order-md-last ftco-animate">
                    <img src="{{ $item->image() }}" class="img-fluid mb-4" alt="">
                    <h3 class="mb-4">{{ $item->title }}</h3>
                    {!! $item->description !!}
                </div>
            </div>
    </section> <!-- .section -->
@endsection
