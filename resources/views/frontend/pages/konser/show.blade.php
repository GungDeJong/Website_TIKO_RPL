@extends('frontend.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets/frontend/') }}/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-3 bread">Event</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a
                                href="{{ route('posts.index') }}">Event <i class="ion-ios-arrow-forward"></i></a></span>
                        <span>{{ $item->nama }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 ftco-animate">
                    <img src="{{ $item->gambar() }}" class="img-fluid w-100 mb-4" alt="">
                    <h3 class="mb-4">{{ $item->nama }}</h3>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <i class="fas fa-calendar"></i>
                            {{ $item->tanggal_mulai->translatedFormat('d-m-Y') . ' - ' . $item->tanggal_selesai->translatedFormat('d-m-Y') }}
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-calendar"></i>
                            {{ $item->lokasi }}
                        </li>
                    </ul>

                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="deskripsi-tab" data-toggle="tab" data-target="#deskripsi"
                                type="button" role="tab" aria-controls="deskripsi"
                                aria-selected="true">Deskripsi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="informasi-tiket-tab" data-toggle="tab"
                                data-target="#informasi-tiket" type="button" role="tab" aria-controls="informasi-tiket"
                                aria-selected="false">Informasi Tiket</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="deskripsi" role="tabpanel"
                            aria-labelledby="deskripsi-tab">
                            {!! $item->deskripsi !!}
                        </div>
                        <div class="tab-pane fade" id="informasi-tiket" role="tabpanel"
                            aria-labelledby="informasi-tiket-tab">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="{{ $item->gambarKategoriTiket() }}" class="img-fluid" alt="">
                                </div>
                                <div class="col-md">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Kategori</th>
                                                    <th class="text-center">Harga</th>
                                                    <th class="text-center">Sisa</th>
                                                </tr>
                                                @foreach ($item->tiket as $tiket)
                                                    <tr>
                                                        <td>{{ $tiket->tipe }}</td>
                                                        <td class="text-right">{{ formatRupiah($tiket->harga) }}</td>
                                                        <td class="text-right">{{ $tiket->sisa }}</td>
                                                    </tr>
                                                @endforeach
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <a href="{{ route('transaksi.pilih-tiket', $item->uuid) }}"
                                            class="btn btn-lg btn-danger">Buy
                                            Tiket</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section> <!-- .section -->
@endsection
