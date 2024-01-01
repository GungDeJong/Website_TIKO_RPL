@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Tiket</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.transaksi.index') }}">Data Tiket</a></div>
                <div class="breadcrumb-item">Edit Tiket</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.tiket.update', $item->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <div class='form-group mb-3'>
                                    <label for='kode' class='mb-2'>Kode</label>
                                    <input type='text' name='kode'
                                        class='form-control @error('kode') is-invalid @enderror'
                                        value='{{ $item->kode ?? old('kode') }}' disabled>
                                    @error('kode')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='jenis' class='mb-2'>Kategori Tiket</label>
                                    <input type='text' name='jenis'
                                        class='form-control @error('jenis') is-invalid @enderror'
                                        value='{{ $item->transaksi->tiket->tipe ?? old('jenis') }}' disabled>
                                    @error('jenis')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='konser' class='mb-2'>Konser</label>
                                    <input type='text' name='konser'
                                        class='form-control @error('konser') is-invalid @enderror'
                                        value='{{ $item->transaksi->konser->nama ?? old('konser') }}' disabled>
                                    @error('konser')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='nama' class='mb-2'>Nama</label>
                                    <input type='text' name='nama'
                                        class='form-control @error('nama') is-invalid @enderror'
                                        value='{{ $item->nama ?? old('nama') }}' disabled>
                                    @error('nama')
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
                                        @foreach ($data_status as $status)
                                            <option @selected($status->nilai == old('status')) value='{{ $status->nilai }}'>
                                                {{ $status->keterangan }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group float-right">
                                    <button class="btn btn-primary">Update</button>
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
