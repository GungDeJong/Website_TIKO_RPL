@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Konser</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.konser.index') }}">Data Konser</a></div>
                <div class="breadcrumb-item">Edit Konser</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.konser.update', $item->uuid) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" name="gambar"
                                                class="form-control @error('gambar') is-invalid @enderror">
                                            @error('gambar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="gambar_kategori_tiket">Gambar Kategori Tiket</label>
                                            <input type="file" name="gambar_kategori_tiket"
                                                class="form-control @error('gambar_kategori_tiket') is-invalid @enderror">
                                            @error('gambar_kategori_tiket')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                name="nama" value="{{ $item->nama ?? old('nama') }}" id="nama">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class='form-group mb-3'>
                                            <label for='lokasi' class='mb-2'>Lokasi</label>
                                            <textarea name='lokasi' id='lokasi' cols='30' rows='3'
                                                class='form-control @error('lokasi') is-invalid @enderror'>{{ $item->lokasi ?? old('lokasi') }}</textarea>
                                            @error('lokasi')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class='form-group mb-3'>
                                            <label for='tanggal_mulai' class='mb-2'>Tanggal Mulai</label>
                                            <input type='datetime-local' name='tanggal_mulai'
                                                class='form-control @error('tanggal_mulai') is-invalid @enderror'
                                                value="{{ $item->tanggal_mulai->translatedFormat('Y-m-d H:i:s') }}">
                                            @error('tanggal_mulai')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class='form-group mb-3'>
                                            <label for='tanggal_selesai' class='mb-2'>Tanggal Selesai</label>
                                            <input type='datetime-local' name='tanggal_selesai'
                                                class='form-control @error('tanggal_selesai') is-invalid @enderror'
                                                value="{{ $item->tanggal_mulai->translatedFormat('Y-m-d H:i:s') }}">
                                            @error('tanggal_selesai')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class='form-group'>
                                            <label for='status'>Status</label>
                                            <select name='status' id='status'
                                                class='form-control @error('status') is-invalid @enderror'>
                                                <option value='' selected disabled>Pilih status</option>
                                                <option @selected($item->status == 1) value="1">Aktif</option>
                                                <option @selected($item->status == 0) value="0">Tidak Aktif</option>
                                            </select>
                                            @error('status')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-block btn-primary"><i class="fas fa-save"></i>
                                                Update</button>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" cols="30"
                                                rows="5">{{ $item->deskripsi ?? old('deskripsi') }}</textarea>
                                            @error('deskripsi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                theme: 'bootstrap4'
            });
            var options = {
                filebrowserImageBrowseUrl: '/filemanager',
                filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/filemanager?type=Files',
                filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
            };
            CKEDITOR.replace('deskripsi', options);
        })
    </script>
@endpush
