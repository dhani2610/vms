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
            color: black;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

    <div class="main-content-inner">
        <div class="row">
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title text-center">Pengadaan</h4>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="judul">Judul</label>
                                        <input type="text" class="form-control" id="judul"
                                            value="{{ $pengadaan->judul }}" name="judul" required readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="judul">Fungsi</label>
                                        <select name="fungsi" class="form-control" id="" disabled>
                                            <option value="" disabled selected>Pilih Fungsi</option>
                                            @foreach ($fungsis as $f)
                                                <option value="{{ $f->id }}" {{ $pengadaan->id_fungsi == $f->id ? 'selected' : '' }} >{{ $f->fungsi }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group col-md-12">
                                                <label class="mt-2" for="dari_tanggal">Dari Tanggal</label>
                                                <input type="date" class="form-control" id="dari_tanggal"
                                                    value="{{ $pengadaan->dari_tanggal }}" name="dari_tanggal" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group col-md-12">
                                                <label class="mt-2" for="sampai_tanggal">Sampai Tanggal</label>
                                                <input type="date" class="form-control" id="sampai_tanggal"
                                                    value="{{ $pengadaan->sampai_tanggal }}" name="sampai_tanggal" required readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="judul">Status Pengadaan</label>
                                        <select name="status" class="form-control" required id="" disabled>
                                            <option value="1" {{ $pengadaan->status == 1 ? 'selected' : '' }}>Pengumuman</option>
                                            <option value="2" {{ $pengadaan->status == 2 ? 'selected' : '' }}>Annwijzing</option>
                                            <option value="3" {{ $pengadaan->status == 3 ? 'selected' : '' }}>Penawaran Harga</option>
                                            <option value="4" {{ $pengadaan->status == 4 ? 'selected' : '' }}>Klarifikasi Teknis</option>
                                            <option value="5" {{ $pengadaan->status == 5 ? 'selected' : '' }}>Negosiasi</option>
                                            <option value="6" {{ $pengadaan->status == 6 ? 'selected' : '' }}>Pengumuman Pemenang</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="upload_foto">File : </label>
                                        @if ($pengadaan->file != null)
                                            <a href="{{ asset('documents/' . $pengadaan->file) }}"
                                                target="_blank" class="btn btn-success">Download</a>
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-5">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        {!! $pengadaan->deskripsi !!}
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h4 class="header-title text-center">Vendor</h4>
                            <hr>

                            <div class="table-responsive">
                                @include('backend.layouts.partials.messages')
                                <table id="dataTable" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Akun</th>
                                            <th>Email Akun</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Email Perusahaan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($vendors as $vendor)
                                       <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $vendor->name }}</td>
                                            <td>{{ $vendor->email }}</td>
                                            <td>{{ $vendor->company_name }}</td>
                                            <td>{{ $vendor->company_email }}</td>
                                            @php
                                                $dataJoin = \App\Models\VendorPengadaan::where('id_vendor',$vendor->id)->where('id_pengadaan',$pengadaan->id)->first();
                                            @endphp
                                            <td>
                                                @if ($dataJoin->status == 1)
                                                    <span class="badge bg-warning mr-1">Pending</span>
                                                @elseif ($dataJoin->status == 2)
                                                    <span class="badge bg-primary mr-1">Approve</span>
                                                @elseif ($dataJoin->status == 3)
                                                    <span class="badge bg-danger mr-1">Not Approve</span>
                                                @elseif ($dataJoin->status == 4)
                                                    <span class="badge bg-success mr-1">Pemenang</span>
                                                @endif
                                            </td>
                                            <td>
                                                    <a class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $vendor->id }}" href="#">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
        
                                                   
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modalEdit{{ $vendor->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Data Registrasi Vendor</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                              
                                                                    <div class="container">
                                                                        <form action="{{ route('pengadaan.update-verifikasi-pengadaan', $dataJoin->id) }}" method="POST">
                                                                            @csrf
                                                                            <div class="row mb-2">
                                                                                <div class="col-lg-12">
                                                                                    <label for="name">Status Vendor Pengadaan</label>
                                                                                    <select name="status" class="form-control" id="">
                                                                                        <option value="1" {{ $dataJoin->status == '1' ? 'selected' : '' }} >Pending</option>
                                                                                        <option value="2" {{ $dataJoin->status == '2' ? 'selected' : '' }} >Approve</option>
                                                                                        <option value="3" {{ $dataJoin->status == '3' ? 'selected' : '' }} >Not Approve</option>
                                                                                        <option value="4" {{ $dataJoin->status == '4' ? 'selected' : '' }} >Pemenang</option>
                                                                                    </select>
                                                                                    <button class="btn btn-primary mt-2" style="float: right" type="submit">Update</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
        
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <h5>1. Informasi Perusahaan</h5>
                                                                                <div class="mb-3">
                                                                                    <label for="region" class="form-label">Domestik/Foreign
                                                                                        Vendor*</label>
                                                                                    <select class="form-select" id="region" name="region" required disabled>
                                                                                        <option selected>Please Select Region</option>
                                                                                        <option value="domestik" {{ $vendor->region == 'domestik' ? 'selected' : '' }}>Domestik</option>
                                                                                        <option value="foreign" {{ $vendor->region == 'foreign' ? 'selected' : '' }}>Foreign</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="entityType" class="form-label">Entitas Perusahaan*</label>
                                                                                    <select class="form-select" id="entityType" name="entity_type" required disabled>
                                                                                        <option selected>Select Type</option>
                                                                                        <option value="PT" {{ $vendor->entity_type == 'PT' ? 'selected' : '' }}>PT</option>
                                                                                        <option value="CV" {{ $vendor->entity_type == 'CV' ? 'selected' : '' }}>CV</option>
                                                                                        <option value="Yayasan" {{ $vendor->entity_type == 'Yayasan' ? 'selected' : '' }}>Yayasan</option>
                                                                                        <option value="Koperasi" {{ $vendor->entity_type == 'Koperasi' ? 'selected' : '' }}>Koperasi</option>
                                                                                        <option value="UD" {{ $vendor->entity_type == 'UD' ? 'selected' : '' }}>UD</option>
                                                                                        <option value="Lainnya" {{ $vendor->entity_type == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="companyName" class="form-label">Nama Lengkap
                                                                                        Perusahaan*</label>
                                                                                    <input readonly type="text" class="form-control" id="companyName"
                                                                                        value="{{ $vendor->company_name }}" name="company_name" placeholder="ex: Elnusa" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="companyName" class="form-label">Informasi Barang/Jasa*</label>
                                                                                    <textarea name="info_barang_jasa" class="form-control" id="" required readonly>{{ $vendor->info_barang_jasa }}</textarea>
                                                                                </div>
                                    
                                                                            </div>
                                    
                                                                            <!-- Informasi Kontak Perusahaan -->
                                                                            <div class="col-md-4">
                                                                                <h5>2. Informasi Kontak Perusahaan</h5>
                                                                                <div class="mb-3">
                                                                                    <label for="phone" class="form-label">Nomor Telp. Kantor*</label>
                                                                                    <input readonly type="text" class="form-control" id="phone"
                                                                                        value="{{ $vendor->office_phone }}" name="office_phone" placeholder="ex: 021XXXXXXX" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="email" class="form-label">Email Perusahaan*</label>
                                                                                    <input readonly type="email" class="form-control" id="email"
                                                                                        value="{{ $vendor->company_email }}" name="company_email" placeholder="ex: user@company.com" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="fax" class="form-label">Nomor Fax</label>
                                                                                    <input readonly type="text" class="form-control" id="fax" value="{{ $vendor->fax }}" name="fax"
                                                                                        placeholder="ex: 123123">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="domisili" class="form-label">Alamat, sesuai SKDP
                                                                                        (Domisili)*</label>
                                                                                    <textarea readonly name="domicile_address" class="form-control" id="" required>{{ $vendor->domicile_address }}</textarea>
                                    
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="operasional" class="form-label">Alamat
                                                                                        Operasional*</label>
                                                                                    <textarea readonly name="operational_address" class="form-control" id="" required>{{ $vendor->operational_address }}</textarea>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="npwp_company" class="form-label">NPWP Perusahaan*</label>
                                                                                    <input readonly type="text" class="form-control" id="npwp_company"
                                                                                        value="{{ $vendor->npwp_company }}" name="npwp_company" placeholder="ex: 123123" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="akta_pendiri_perusahaan" class="form-label">Akta Pendirian
                                                                                        Perusahaan*</label>
                                                                                    <input readonly type="text" class="form-control"
                                                                                        id="akta_pendiri_perusahaan" value="{{ $vendor->akta_pendiri_perusahaan }}" name="akta_pendiri_perusahaan"
                                                                                        placeholder="ex: 123123" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="nib" class="form-label">NIB Perusahaan*</label>
                                                                                    <input readonly type="text" class="form-control" id="nib"
                                                                                        value="{{ $vendor->nib }}" name="nib" placeholder="ex: 123123" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="postalCode" class="form-label">Kode Pos
                                                                                        (Domisili)*</label>
                                                                                    <input readonly type="text" class="form-control" id="postalCode"
                                                                                        value="{{ $vendor->postal_code }}" name="postal_code" placeholder="ex: 12560" required>
                                                                                </div>
                                                                            </div>
                                    
                                                                            <!-- Informasi PIC -->
                                                                            <div class="col-md-4">
                                                                                <h5>3. Informasi Contact Person</h5>
                                                                                <div class="mb-3">
                                                                                    <label for="picName" class="form-label">Nama*</label>
                                                                                    <input readonly type="text" class="form-control" id="picName"
                                                                                        value="{{ $vendor->pic_name }}" name="pic_name" placeholder="ex: Rezeki Ahmad A." required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="picPosition" class="form-label">Jabatan*</label>
                                                                                    <input readonly type="text" class="form-control" id="picPosition"
                                                                                        value="{{ $vendor->pic_position }}" name="pic_position" placeholder="ex: Manager" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="picPhone" class="form-label">Nomor Handphone*</label>
                                                                                    <input readonly type="text" class="form-control" id="picPhone"
                                                                                        value="{{ $vendor->pic_phone }}" name="pic_phone" placeholder="ex: 085XXXXXXXX" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="picEmail" class="form-label">Email*</label>
                                                                                    <input readonly type="email" class="form-control" id="picEmail"
                                                                                        value="{{ $vendor->pic_email }}" name="pic_email" placeholder="ex: user@company.com" required>
                                                                                </div>
                                    
                                                                                <h5>4. Login Information</h5>
                                    
                                                                                <div class="mb-3">
                                                                                    <label for="picEmail" class="form-label">Email*</label>
                                                                                    <input readonly type="email" class="form-control" id="picEmail"
                                                                                        value="{{ $vendor->email }}" name="email" placeholder="ex: user@company.com" required>
                                                                                </div>
                                    
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                            
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                            </td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>


                            <button class="btn btn-primary mt-4" type="submit" style="float: right">Simpan Data</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

    <script>
        // Initialize Dropify
        $('.dropify').dropify();

        // Add new Dropify input
        $('#add-row').on('click', function() {
            const newRow = `
                <div class="dropify-row mb-2">
                    <button type="button" class="btn btn-danger btn-sm remove-row" style="float: right">-</button>
                   
                </div>
            `;
            $('#dropify-wrapper').append(newRow);

            // Reinitialize only new Dropify elements
            $('#dropify-wrapper .dropify').each(function() {
                if (!$(this).hasClass('dropify-initialized')) {
                    $(this).dropify();
                }
            });
        });


        // Remove Dropify input
        $('#dropify-wrapper').on('click', '.remove-row', function() {
            $(this).closest('.dropify-row').remove();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- jQuery (Wajib sebelum Bootstrap JS) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap 4 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <!-- Add JavaScript here -->

    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <script>
        function initializeSelect2() {
            $('.js-example-basic-single').select2();
        }
        $(function() {
            $('[data-toggle="tooltip"]').tooltip(); // Inisialisasi tooltip secara manual
        });
        $('.summernote').summernote({
            placeholder: 'Deskripsi Pengadaan',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                //['fontname', ['fontname']],
                // ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                //['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ],
        });
    </script>
@endsection
