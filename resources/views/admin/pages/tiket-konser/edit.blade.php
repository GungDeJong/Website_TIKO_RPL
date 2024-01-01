@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Tiket Konser</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Tiket Konser</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">
                                Detail Konser
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr class="py-0">
                                    <th class="ml-0 pl-0">Nama Konser</th>
                                    <td class="ml-0 pl-0">{{ $konser->nama }}</td>
                                </tr>
                                <tr class="py-0">
                                    <th class="ml-0 pl-0">Tanggal Mulai</th>
                                    <td class="ml-0 pl-0">{{ $konser->tanggal_mulai_format() }}</td>
                                </tr>
                                <tr class="py-0">
                                    <th class="ml-0 pl-0">Tanggal Selesai</th>
                                    <td class="ml-0 pl-0">{{ $konser->tanggal_selesai_format() }}</td>
                                </tr>
                                <tr class="py-0">
                                    <th class="ml-0 pl-0">Aksi</th>
                                    <td class="ml-0 pl-0">
                                        <a href="{{ route('admin.tiket-konser.index', [
                                            'uuid_konser' => $konser->uuid,
                                        ]) }}"
                                            class="btn btn-warning">Kembali</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">
                                Pilih Artis
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('admin.tiket-konser.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <div class='form-group mb-3'>
                                            <label for='tipe' class='mb-2'>Tipe</label>
                                            <input type='text' name='tipe'
                                                class='form-control @error('tipe') is-invalid @enderror'
                                                value='{{ $item->tipe ?? old('tipe') }}'>
                                            @error('tipe')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class='form-group mb-3'>
                                            <label for='harga' class='mb-2'>Harga</label>
                                            <input type='number' name='harga'
                                                class='form-control @error('harga') is-invalid @enderror'
                                                value='{{ $item->harga ?? old('harga') }}'>
                                            @error('harga')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class='form-group mb-3'>
                                            <label for='jumlah' class='mb-2'>Jumlah</label>
                                            <input type='number' name='jumlah'
                                                class='form-control @error('jumlah') is-invalid @enderror'
                                                value='{{ $item->jumlah ?? old('jumlah') }}'>
                                            @error('jumlah')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Update Tiket</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugin/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/plugin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugin/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Artis'
            });
        })
    </script>
@endpush
