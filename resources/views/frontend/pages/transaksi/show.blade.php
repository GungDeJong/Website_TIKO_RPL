@extends('frontend.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets/frontend/') }}/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-3 bread">Detail</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a
                                href="{{ route('posts.index') }}">Transaksi <i class="ion-ios-arrow-forward"></i></a></span>
                        <span>{{ $item->kode }}
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
                        <h3> Detail Transaksi</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width:220px">Kode</th>
                            <td>{{ $item->kode }}</td>
                        </tr>
                        <tr>
                            <th style="width:120px">Konser</th>
                            <td>
                                <span>
                                    <span>Nama : </span>
                                    {{ $item->konser->nama }}
                                </span>
                                <br>
                                <span>
                                    <span>Lokasi : </span>
                                    {{ $item->konser->lokasi }}
                                </span>
                                <br>
                                <span>
                                    <span>Tanggal : </span>
                                    <span>
                                        {{ $item->konser->tanggal_mulai->translatedFormat('d-m-Y') . ' s.d ' . $item->konser->tanggal_selesai->translatedFormat('d-m-Y') }}</span>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="width:120px">Tipe Tiket</th>
                            <td>{{ $item->tiket->tipe }}</td>
                        </tr>
                        <tr>
                            <th style="width:120px">Harga Tiket</th>
                            <td>{{ formatRupiah($item->tiket->harga) }}</td>
                        </tr>
                        <tr>
                            <th style="width:120px">Jumlah</th>
                            <td>{{ $item->jumlah }}</td>
                        </tr>
                        <tr>
                            <th style="width:120px">Total Harga</th>
                            <td>{{ formatRupiah($item->jumlah * $item->tiket->harga) }}</td>
                        </tr>
                        <tr>
                            <th style="width:120px">Metode Pembayaran</th>
                            <td>{{ $item->metode_pembayaran->nama . ' - ' . $item->metode_pembayaran->nomor . ' (' . $item->metode_pembayaran->pemilik . ')' }}
                            </td>
                        </tr>
                        <tr>
                            <th style="width:120px">Status</th>
                            <td>{!! $item->status() !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
    </section> <!-- .section -->
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $('#dTable').DataTable();
        })
    </script>
    @include('admin.layouts.partials.sweetalert')
@endpush
