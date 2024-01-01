@extends('frontend.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets/frontend/') }}/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-3 bread">Pengajuan</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a
                                href="{{ route('posts.index') }}">Pengembalian Dana <i
                                    class="ion-ios-arrow-forward"></i></a></span>
                        <span>Pengajuan</span>
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
                        <h3>Pengajuan Pengembalian Dana</h3>
                    </div>

                    <form action="{{ route('pengembalian-dana.store') }}" method="post">
                        @csrf
                        <div class='form-group'>
                            <label for='tiket_id'>Tiket</label>
                            <select name='tiket_id' id='tiket_id'
                                class='form-control @error('tiket_id') is-invalid @enderror'>
                                <option value='' selected disabled>Pilih Tiket</option>
                                @foreach ($data_tiket as $tiket)
                                    <option @selected($tiket->id == old('tiket_id')) value='{{ $tiket->id }}'>
                                        {{ $tiket->kode . ' - ' . $tiket->nama . ' | ' . $tiket->transaksi->konser->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tiket_id')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='nama_bank' class='mb-2'>Nama Bank</label>
                            <input type='text' name='nama_bank'
                                class='form-control @error('nama_bank') is-invalid @enderror'
                                value='{{ old('nama_bank') }}'>
                            @error('nama_bank')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='nomor_rekening' class='mb-2'>Nomor Rekening</label>
                            <input type='number' name='nomor_rekening'
                                class='form-control @error('nomor_rekening') is-invalid @enderror'
                                value='{{ old('nomor_rekening') }}'>
                            @error('nomor_rekening')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='pemilik' class='mb-2'>Pemilik</label>
                            <input type='text' name='pemilik' class='form-control @error('pemilik') is-invalid @enderror'
                                value='{{ old('pemilik') }}'>
                            @error('pemilik')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button class="btn btn-primary">Ajukan Pengembalian Dana</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

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
