@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Artis Konser</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Artis Konser</div>
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
                                        <a href="{{ route('admin.artis-konser.index', [
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
                                    <form
                                        action="{{ route('admin.artis-konser.store', [
                                            'uuid_konser' => $konser->uuid,
                                        ]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="artis_id">Artis <span>(Dapat memilih lebih dari 1
                                                    artis)</span></label>
                                            <select name="artis_id[]" id="artis_id"
                                                class="form-control select2 @error('artis_id') is-invalid @enderror"
                                                multiple>
                                                @foreach ($data_artis as $artis)
                                                    <option value="{{ $artis->id }}">{{ $artis->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('artis_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Tambahkan Artis</button>
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
