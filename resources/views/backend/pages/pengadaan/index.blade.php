@extends('backend.layouts-new.app')

@section('content')
    <style>
        .form-check-label {
            text-transform: capitalize;
        }

        .select2 {
            width: 100% !important;
        }

        label {
            float: left;
        }
    </style>
    @php
        $usr = Auth::guard('admin')->user();
        if ($usr != null) {
            $userRole = Auth::guard('admin')->user()->getRoleNames()->first(); // Get the first role name
        }

    @endphp

    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left">Data Pengadaan</h4>
                        <p class="float-right mb-2">
                            <a href="{{ route('pengadaan.create') }}" style="float: right"
                                class="btn btn-primary text-white mb-3">
                                Tambah Data
                            </a>
                        </p>
                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            @include('backend.layouts.partials.messages')
                            <table id="dataTable" class="table text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>NO</th>
                                        <th>Judul</th>
                                        <th>Dari Tanggal</th>
                                        <th>Sampai Tanggal</th>
                                        <th>File</th>
                                        <th>Status</th>
                                        <th>Total Vendor</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengadaans as $index => $pengadaan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pengadaan->judul }}</td>
                                            <td>{{ $pengadaan->dari_tanggal }}</td>
                                            <td>{{ $pengadaan->sampai_tanggal }}</td>
                                            <td>
                                                @if ($pengadaan->file != null)
                                                    <a href="{{ asset('documents/' . $pengadaan->file) }}"
                                                        target="_blank">Download</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($pengadaan->status == 1)
                                                    <span class="badge bg-info mr-1">Pengumuman</span>
                                                @elseif ($pengadaan->status == 2)
                                                    <span class="badge bg-primary mr-1">Aanwijzing</span>
                                                @elseif ($pengadaan->status == 3)
                                                    <span class="badge bg-warning mr-1">Penawaran Harga</span>
                                                @elseif ($pengadaan->status == 4)
                                                    <span class="badge bg-secondary mr-1">Klarifikasi Teknis</span>
                                                @elseif ($pengadaan->status == 5)
                                                    <span class="badge bg-primary mr-1">Negosiasi</span>
                                                @elseif ($pengadaan->status == 6)
                                                    <span class="badge bg-success mr-1">Pengumuman Pemenang</span>
                                                @else
                                                    <span class="badge bg-dark mr-1">Status Tidak Diketahui</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $dataJoin = \App\Models\VendorPengadaan::where('id_pengadaan',$pengadaan->id)->get()->count();
                                                @endphp
                                                {{ $dataJoin }}
                                            </td>

                                            <td>
                                                <a href="{{ route('pengadaan.vendor', $pengadaan->id) }}"
                                                    class="btn btn-info text-white">
                                                    <i class="fa-solid fa-users"></i>
                                                </a>
                                                <a href="{{ route('pengadaan.edit', $pengadaan->id) }}"
                                                    class="btn btn-success text-white">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a onclick="confirmDelete('{{ route('pengadaan.destroy', $pengadaan->id) }}')"
                                                    class="btn btn-danger text-white">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- data table end -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmDelete(deleteUrl) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure you want to delete this data?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        }
    </script>
@endsection
