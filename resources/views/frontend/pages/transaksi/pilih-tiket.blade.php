@extends('frontend.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets/frontend/') }}/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-3 bread">Transaksi</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a
                                href="{{ route('posts.index') }}">Transaksi <i class="ion-ios-arrow-forward"></i></a></span>
                        <span>{{ $item->title }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <img src="{{ $item->gambarKategoriTiket() }}" class="img-fluid mb-4" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-5">Form Pemesanan</h2>
                </div>
            </div>
            <form action="{{ route('transaksi.checkout') }}" method="post">
                @csrf
                <input type="text" name="konser_id" hidden value="{{ $item->id }}">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body row">
                                <div class="col-md-5 ftco-animate">
                                    @csrf
                                    <div class='form-group mb-3'>
                                        <label class='mb-2' for='konser_tiket_id'>Tiket</label>
                                        <br>
                                        @foreach ($item->tiket as $tiket)
                                            <div class='form-check form-check-inline'>
                                                <input class='form-check-input' type='radio' name='konser_tiket_id'
                                                    @if (old('konser_tiket_id') === '{{ $tiket->id }}') selected @endif
                                                    id='{{ $tiket->id }}' value='{{ $tiket->id }}'>
                                                <label class='form-check-label'
                                                    for='{{ $tiket->id }}'>{{ $tiket->tipe . ' | ' . formatRupiah($tiket->harga) }}</label>
                                            </div>
                                        @endforeach
                                        @error('konser_tiket_id')
                                            <div class='invalid-feedback d-inline'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group mb-3'>
                                        <label for='jumlah_tiket' class='mb-2'>Jumlah Tiket</label>
                                        <input type='number' name='jumlah_tiket'
                                            class='form-control @error('jumlah_tiket') is-invalid @enderror'
                                            value='{{ old('jumlah_tiket') }}' id="jumlah_tiket">
                                        @error('jumlah_tiket')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group'>
                                        <label for='metode_pembayaran_id'>Metode Pembayaran</label>
                                        <select name='metode_pembayaran_id' id='metode_pembayaran_id'
                                            class='form-control @error('metode_pembayaran_id') is-invalid @enderror'>
                                            <option value='' selected disabled>Pilih Metode Pembayaran</option>
                                            @foreach ($data_metode_pembayaran as $metode_pembayaran)
                                                <option @selected($metode_pembayaran->id == old('metode_pembayaran_id')) value='{{ $metode_pembayaran->id }}'>
                                                    {{ $metode_pembayaran->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('metode_pembayaran_id')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-4">
                                        <button class="btn btn-block btn-lg btn-primary">Pesan Sekarang</button>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="list_tiket">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </section> <!-- .section -->
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#jumlah_tiket').on('input', function() {
                let jumlah = $(this).val();
                $('.list_tiket').empty();
                for (let i = 1; i <= jumlah; i++) {
                    $('.list_tiket').append(`
            <div>
                <span>Tiket ${i}</span>
                <div class='form-group mb-3'>
                    <label for='nama' class='mb-2'>Nama</label>
                    <input type='text' name='nama[]' class='form-control' value=''>
                </div>
            </div>
        `);
                }
                console.log(jumlah);
            })
        })
    </script>
@endpush
