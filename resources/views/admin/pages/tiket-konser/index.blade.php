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
                                        <a href="{{ route('admin.konser.index') }}" class="btn btn-warning">Kembali</a>
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
                                Tiket Konser
                            </h6>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.tiket-konser.create', [
                                'uuid_konser' => $konser->uuid,
                            ]) }}"
                                class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tipe</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Sisa</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tipe }}</td>
                                                <td>{{ number_format($item->harga, 0, 3, '.') }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                                <td>{{ $item->sisa }}</td>
                                                <td>
                                                    <a href="{{ route('admin.tiket-konser.edit', $item->id) }}"
                                                        class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> Edit</a>
                                                    <form action="" method="post" class="d-inline" id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button
                                                            data-action="{{ route('admin.tiket-konser.destroy', $item->id) }}"
                                                            class="btn btn-sm btn-danger btnDelete"><i
                                                                class="fas fa-trash"></i>
                                                            Hapus</button>
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
            $('body').on('click', '.btnDelete', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let action = $(this).data('action');
                        $('#formDelete').attr('action', action);
                        $('#formDelete').submit();
                    }
                })
            })
        })
    </script>
    @include('admin.layouts.partials.sweetalert')
@endpush
