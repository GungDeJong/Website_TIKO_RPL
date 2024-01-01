@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Konser</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Konser</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.konser.create') }}" class="btn btn-sm btn-primary mb-3 btnAdd"><i
                                    class="fas fa-plus"></i> Tambah Data</a>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Gambar</th>
                                            <th>Nama Konser</th>
                                            <th>Lokasi</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_konser as $konser)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ $konser->gambar() }}" class="img-fluid"
                                                        style="max-height:70px"></img>
                                                </td>
                                                <td>{{ $konser->nama }}</td>
                                                <td>{{ $konser->lokasi }}</td>
                                                <td>{{ $konser->tanggal_mulai_format() }}</td>
                                                <td>{{ $konser->tanggal_selesai_format() }}</td>
                                                <td>
                                                    {!! $konser->status() !!}
                                                </td>
                                                <td>
                                                    <a href='{{ route('admin.konser.edit', $konser->uuid) }}'
                                                        class='btn btn-sm btn-info btnEdit mx-1'><i
                                                            class='fas fa fa-edit'></i> Edit</a>
                                                    <form action="" method="post" class="d-inline" id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button
                                                            data-action="{{ route('admin.konser.destroy', $konser->id) }}"
                                                            class="btn btn-sm btn-danger btnDelete"><i
                                                                class="fas fa-trash"></i>
                                                            Hapus</button>
                                                        <a href='{{ route('admin.artis-konser.index', [
                                                            'uuid_konser' => $konser->uuid,
                                                        ]) }}'
                                                            class='btn btn-sm btn-success mx-1'> <i
                                                                class='fas fa fa-star'></i> Artis</a>
                                                        <a href='{{ route('admin.tiket-konser.index', [
                                                            'uuid_konser' => $konser->uuid,
                                                        ]) }}'
                                                            class='btn btn-sm btn-primary mx-1'> <i
                                                                class='fas fa fa-ticket-alt'></i> Tiket</a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@push('scripts')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(function() {
            $('#dTable').DataTable();
        })
    </script>
    @include('admin.layouts.partials.sweetalert')
@endpush
