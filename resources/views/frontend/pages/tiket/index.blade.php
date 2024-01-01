@extends('frontend.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets/frontend/') }}/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-3 bread">Tiket</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a
                                href="{{ route('posts.index') }}">Tiket></a>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h3> Tiket</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table nowrap table-hover table-bordered" id="dTable">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kode</th>
                                    <th class="text-center">Konser</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>
                                            <span>
                                                <span>Nama : </span>
                                                {{ $item->transaksi->konser->nama }}
                                            </span>
                                            <br>
                                            <span>
                                                <span>Lokasi : </span>
                                                {{ $item->transaksi->konser->lokasi }}
                                            </span>
                                            <br>
                                            <span>
                                                <span>Tanggal : </span>
                                                <span>
                                                    {{ $item->transaksi->konser->tanggal_mulai->translatedFormat('d-m-Y') . ' s.d ' . $item->transaksi->konser->tanggal_selesai->translatedFormat('d-m-Y') }}</span>
                                            </span>
                                        </td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{!! $item->status() !!}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <a href="javascript:void(0)" class="btn btn-success btnLihat"
                                                    data-toggle="modal"
                                                    data-target="#modalTiket{{ $item->kode }}">Lihat</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($item->status == 1)
                                        <div class="modal fade" id="modalTiket{{ $item->kode }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTiket">Tiket</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body  px-5">
                                                        <div class="row">
                                                            <div class="col-md-12 border">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <h4>E-Ticket</h4>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <h5 class="text-right">Ticket Code :
                                                                            {{ $item->kode }}
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-8">
                                                                        <div>
                                                                            <span>Event Name</span>
                                                                            <h6>{{ $item->transaksi->konser->nama }}</h6>
                                                                        </div>
                                                                        <div>
                                                                            <span>Name</span>
                                                                            <h6>{{ $item->nama }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="text-right">
                                                                            {{ $item->gambarbarcode() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-4">
                                                                        <span class="small">Event Time : <span
                                                                                class="font-weight-bold">{{ $item->transaksi->konser->tanggal_mulai->translatedFormat('d, F Y') }}</span></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <span class="small">Event Location : <span
                                                                                class="font-weight-bold">{{ $item->transaksi->konser->lokasi }}</span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
