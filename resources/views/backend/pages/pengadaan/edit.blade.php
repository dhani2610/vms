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
            <form action="{{ route('pengadaan.update', $pengadaan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title text-center">Edit Pengadaan</h4>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="judul">Judul</label>
                                        <input type="text" class="form-control" id="judul"
                                            value="{{ $pengadaan->judul }}" name="judul" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="judul">Fungsi</label>
                                        <select name="fungsi" class="form-control" id="">
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
                                                    value="{{ $pengadaan->dari_tanggal }}" name="dari_tanggal" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group col-md-12">
                                                <label class="mt-2" for="sampai_tanggal">Sampai Tanggal</label>
                                                <input type="date" class="form-control" id="sampai_tanggal"
                                                    value="{{ $pengadaan->sampai_tanggal }}" name="sampai_tanggal" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="judul">Status Pengadaan</label>
                                        <select name="status" class="form-control" required id="">
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
                                        <label class="mt-2" for="upload_foto">Upload File</label>
                                        <input type="file" class="form-control dropify" id="upload"
                                            accept="application/pdf" name="upload"
                                            data-default-file="{{ asset('documents/' . $pengadaan->file) }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="type">Type</label><br>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="type_general" {{ $pengadaan->type == 'General Procurement' ? 'checked' : '' }} value="General Procurement">
                                            <label class="form-check-label" for="type_general">General Procurement</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="type_aircraft" {{ $pengadaan->type == 'Aircraft Procurement' ? 'checked' : '' }}  value="Aircraft Procurement">
                                            <label class="form-check-label" for="type_aircraft">Aircraft Procurement</label>
                                        </div>
                                    </div>
                                       
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="category">Category</label><br>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="category" id="category_barang" {{ $pengadaan->category == 'Barang' ? 'checked' : '' }} value="Barang">
                                            <label class="form-check-label" for="category_barang">Barang</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="category" id="category_jasa" {{ $pengadaan->category == 'Jasa' ? 'checked' : '' }} value="Jasa">
                                            <label class="form-check-label" for="category_jasa">Jasa</label>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row mt-5">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12 col-sm-12">
                                            <textarea name="deskripsi" required class="summernote form-control" id="" cols="100" rows="130">{{ $pengadaan->deskripsi }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-primary mt-4" type="submit" style="float: right">Simpan Data</button>
                        </div>
                    </div>
                </div>
            </form>
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
                    <select class="form-control" name="vendor[]" id="user" required>
                        <option value="" disabled selected>Pilih Vendor</option>
                        @foreach ($vendor as $v)
                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                        @endforeach
                    </select>
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
