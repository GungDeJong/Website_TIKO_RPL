@extends('frontend.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets') }}/frontend/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-3 bread">Berita</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Berita</span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-end mb-3">
                <div class="col-md-5">
                    <form action="{{ route('posts.index') }}" method="get">
                        <div class='form-group mb-3'>
                            <input type='text' name='keyword' class='form-control @error('keyword') is-invalid @enderror'
                                value='{{ request('keyword') }}' placeholder="Cari Event...">
                            @error('keyword')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
            <div class="row d-flex">
                @forelse ($posts as $post)
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="blog-entry justify-content-end">
                            <a href="{{ route('posts.show', $post->slug) }}" class="block-20"
                                style="background-image: url('{{ $post->image() }}');">
                            </a>
                            <div class="text p-4 float-right d-block">
                                <div class="d-flex align-items-center pt-2 mb-4">
                                    <div class="one">
                                        <span class="day">{{ $post->created_at->translatedFormat('d') }}</span>
                                    </div>
                                    <div class="two">
                                        <span class="yr">{{ $post->created_at->translatedFormat('Y') }}</span>
                                        <span class="mos">{{ $post->created_at->translatedFormat('F') }}</span>
                                    </div>
                                </div>
                                <h3 class="heading mt-2"><a
                                        href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}
                                </h3>
                                <p>{{ $post->meta_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <p class="text-center">
                            Berita Tidak Ditemukan!
                        </p>
                    </div>
                @endforelse
            </div>
            <div class="row justify-content-center mt-5">
                {{ $posts->appends(request()->all())->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
        </div>
    </section>
@endsection
