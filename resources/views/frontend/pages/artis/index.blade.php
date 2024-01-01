@extends('frontend.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets') }}/frontend/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-3 bread">Artist</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Artist <i
                                class="ion-ios-arrow-forward"></i></span></p>
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
                @foreach ($items as $item)
                    <div class="col-md-4 speaker">
                        <img src="{{ $item->foto() }}" class="img-fluid" alt="Colorlib HTML5 Template">
                        <div class="text text-center pt-3">
                            <h3>{{ $item->nama }}</h3>
                            <span class="position">{{ $item->genre }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center mt-5">
                {{ $items->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
    </section>
@endsection
