@extends('frontend.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets/frontend/') }}/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-3 bread">Pengembalian Dana</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a
                                href="{{ route('posts.index') }}">Pengembalian Dana</a></span>
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
                        <h3> Pengembalian Dana</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('pengembalian-dana.create') }}" class="btn btn-primary mb-3">Ajukan Pengembalian
                        Dana</a>
                    <div class="table-responsive">
                        <table class="table nowrap table-hover table-bordered" id="dTable">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kode Tiket</th>
                                    <th class="text-center">Tipe Tiket</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Konser</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Bank</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->tiket->kode }}</td>
                                        <td>{{ $item->tiket->transaksi->tiket->tipe }}</td>
                                        <td>{{ $item->tiket->nama }}</td>
                                        <td>{{ $item->tiket->transaksi->konser->nama }}</td>
                                        <td>{{ formatRupiah($item->tiket->transaksi->tiket->harga) }}</td>
                                        <td>
                                            {{ $item->nama_bank . ' - ' . $item->nomor_rekening . ' (' . $item->pemilik . ')' }}
                                        </td>
                                        <td>{!! $item->status() !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
