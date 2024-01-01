@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.transaksi.index') }}">Data Transaksi</a></div>
                <div class="breadcrumb-item">Edit Transaksi</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.transaksi.update', $item->id) }}" method="post">
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
                                    <label for='user_id' class='mb-2'>Nama Pemesan</label>
                                    <input type='text' name='user_id'
                                        class='form-control @error('user_id') is-invalid @enderror'
                                        value='{{ $item->user->name }}' disabled>
                                    @error('user_id')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='metode_pembayaran' class='mb-2'>Metode Pembayaran</label>
                                    <input type='text' name='metode_pembayaran'
                                        class='form-control @error('metode_pembayaran') is-invalid @enderror'
                                        @if ($item->metode_pembayaran) value='{{ $item->metode_pembayaran->nama . ' - ' . $item->metode_pembayaran->nomor }}' @endif
                                        disabled>
                                    @error('metode_pembayaran')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='harga' class='mb-2'>Harga</label>
                                    <input type='text' name='harga'
                                        class='form-control @error('harga') is-invalid @enderror'
                                        value='{{ formatRupiah($item->tiket->harga) ?? old('harga') }}' disabled>
                                    @error('harga')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='jumlah' class='mb-2'>Jumlah</label>
                                    <input type='text' name='jumlah'
                                        class='form-control @error('jumlah') is-invalid @enderror'
                                        value='{{ $item->jumlah ?? old('jumlah') }}' disabled>
                                    @error('jumlah')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='total' class='mb-2'>Total</label>
                                    <input type='text' name='total'
                                        class='form-control @error('total') is-invalid @enderror'
                                        value='{{ formatRupiah($item->total_harga) }}' disabled>
                                    @error('total')
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
