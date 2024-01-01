@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Pengembalian Dana</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Pengembalian Dana</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Kode Tiket</th>
                                            <th>Harga</th>
                                            <th>Bank</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                                                <td>{{ $item->tiket->kode }}</td>
                                                <td>{{ formatRupiah($item->harga) }}</td>
                                                <td>
                                                    {{ $item->nama_bank . ' - ' . $item->nomor_rekening . '(' . $item->pemilik . ')' }}
                                                </td>
                                                <td>{!! $item->status() !!}</td>
                                                <td>
                                                    <a href="{{ route('admin.pengembalian-dana.edit', $item->id) }}"
                                                        class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                    <form action="javascript:void(0)" method="post" class="d-inline"
                                                        id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button
                                                            @if ($item->status != 1) data-action="{{ route('admin.pengembalian-dana.destroy', $item->id) }}"
                                                          class="btn btn-sm btn-danger btnDelete" @else
                                                          class="btn btn-sm btn-danger disabled" @endif><i
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
        })
    </script>
    @include('admin.layouts.partials.sweetalert')
@endpush
