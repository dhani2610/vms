@extends('backend.layouts-new.app')

@section('content')
    <style>
        .form-check-label {
            text-transform: capitalize;
        }

        .select2 {
            width: 100% !important;
        }


        @import url("https://fonts.googleapis.com/css2?family=Spartan:wght@100&display=swap");

        header {
            width: 100vw;
            height: 150px;
            background-color: #5da5a4;
        }

        header img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        main {
            background-color: #f0fafb;
        }

        .container {
            padding-top: 70px;
            padding-bottom: 70px;
        }

        .job-card {
            display: flex;
            padding: 30px;
            background-color: white;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        @media (max-width: 767px) {
            .job-card {
                display: block;
                padding: 20px;
                margin-bottom: 50px;
            }
        }

        .job-card:hover {
            box-shadow: 0 0 11px rgba(33, 33, 33, 0.2);
        }

        .job-card p {
            font-size: 15px;
            color: #58a9a7;
            font-weight: 500;
            line-height: 1.4;
        }

        @media (max-width: 767px) {
            .job-card__info {
                padding-bottom: 20px;
            }
        }

        .job-card__info a:hover {
            text-decoration: none;
        }

        .job-card__info .img-c {
            height: 88px;
            width: 88px;
            margin-right: 15px;
        }

        @media (max-width: 767px) {
            .job-card__info .img-c {
                height: 60px;
                width: 60px;
                margin: -50px 0 10px 0;
            }
        }

        .job-card__info .img-c img {
            height: 100%;
            width: 100%;
            object-fit: contain;
        }

        .job-card__info p {
            font-weight: 700;
            margin-bottom: 7px;
        }

        .job-card__info .tag-new {
            padding: 7px 10px;
            background-color: #58a9a7;
            color: white;
            border-radius: 20px;
            margin-left: 10px;
            text-transform: uppercase;
            font-size: 11px;
            display: none;
        }

        .job-card__info .tag-featured {
            padding: 7px 10px;
            background-color: black;
            color: white;
            border-radius: 20px;
            margin-left: 10px;
            text-transform: uppercase;
            font-size: 11px;
            display: none;
        }
        .tag-featured {
            padding: 7px 10px;
            background-color: black;
            color: white;
            border-radius: 20px;
            margin-left: 10px;
            text-transform: uppercase;
            font-size: 11px;
            display: none;
        }

        .job-card__info h6 {
            color: #323838;
            font-size: 18px;
            font-weight: 700;
        }

        .job-card__info ul {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .job-card__info ul li {
            font-size: 15px;
            color: #939c9b;
            padding: 0 10px;
            position: relative;
        }

        .job-card__info ul li:before {
            content: "";
            height: 4px;
            width: 4px;
            position: absolute;
            top: 50%;
            background-color: #939c9b;
            border-radius: 50%;
            left: -2px;
            transform: translateY(-50%);
        }

        .job-card__info ul li:first-child {
            padding-left: 0;
        }

        .job-card__info ul li:first-child:before {
            display: none;
        }

        .job-card__info ul li:last-child {
            padding-right: 0;
        }

        .job-card.new .tag-new {
            display: block;
        }

        .job-card.featured {
            border-left: 5px solid #58a9a7;
        }

        .job-card.featured .tag-featured {
            display: block;
        }

        .job-card__tags {
            display: flex;
            flex-wrap: wrap;
            padding-left: 20px;
            list-style-type: none;
        }

        @media (max-width: 767px) {
            .job-card__tags {
                padding-top: 20px;
                padding-left: 0;
                border-top: 1px solid #939c9b;
            }
        }

        .job-card__tags li {
            margin-right: 10px;
            margin-bottom: 0;
            padding: 7px;
            border-radius: 4px;
            color: #58a9a7;
            font-weight: 500;
            background-color: #f1f7f5;
            margin: 5px 10px 5px 0;
            cursor: pointer;
            transition: all ease 0.2s;
        }

        .job-card__tags li:hover {
            background-color: #58a9a7;
            color: white;
        }

        .job-card__tags li:last-child {
            margin-right: 0;
        }

        .filter-tags-c {
            background-color: white;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-radius: 5px;
            margin-top: -105px;
            box-shadow: 0 0 11px rgba(33, 33, 33, 0.2);
        }

        @media (max-width: 767px) {
            .filter-tags-c {
                padding: 20px;
                margin-bottom: 50px;
            }
        }

        .filter-tags-c ul {
            list-style-type: none;
            display: flex;
            flex-wrap: wrap;
            padding: 0;
            margin: 0;
        }

        .filter-tags-c ul li {
            display: flex;
            margin: 5px 15px 5px 0;
            border-radius: 4px;
            overflow: hidden;
        }

        .filter-tags-c ul li p {
            margin-right: 10px;
            margin-bottom: 0;
            padding: 7px;
            background-color: #f1f7f5;
            margin: 0;
            color: #58a9a7;
            font-weight: 500;
        }

        .filter-tags-c ul li span {
            background-color: #58a9a7;
            color: white;
            font-size: 25px;
            line-height: 1.3;
            padding: 0 5px;
            cursor: pointer;
            transition: all ease 0.2s;
        }

        .filter-tags-c ul li span:hover {
            background-color: black;
        }

        .filter-tags-c .clear-tags {
            color: #58a9a7;
            font-weight: 500;
            margin: 0;
            margin-left: 20px;
            border-bottom: 1px solid #58a9a7;
            cursor: pointer;
        }
    </style>
    @php
        $usr = Auth::guard('admin')->user();
        if ($usr != null) {
            $userRole = Auth::guard('admin')->user()->getRoleNames()->first(); // Get the first role name
        }

    @endphp

    <div class="main-content-inner">
        @include('backend.layouts.partials.messages')

        <div class="row">
            <header><img src="https://www.agilus.ai/wp-content/uploads/2022/10/Vendor-Management-Lifecycle.jpg"
                    alt="header" /></header>
            <main>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="filter-tags-c">
                                <ul id="filter-tags-list"></ul>
                                <p class="clear-tags" id="js-clear-tags"> Daftar Pengadaan</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="col-12" id="job-list">
                            @foreach ($pengadaans as $index => $pengadaan)
                                <li class="job-card new">
                                    @php
                                        $tanggalDari = \Carbon\Carbon::parse(
                                            $pengadaan->dari_tanggal,
                                        )->translatedFormat('d F Y');
                                        $tanggalSampai = \Carbon\Carbon::parse(
                                            $pengadaan->sampai_tanggal,
                                        )->translatedFormat('d F Y');

                                        $timeAgo = \Carbon\Carbon::parse($pengadaan->created_at)
                                            ->locale('id')
                                            ->diffForHumans();
                                        $createdAt = \Carbon\Carbon::parse($pengadaan->created_at);

                                        $isNew = $createdAt->diffInDays(now()) <= 1;

                                    @endphp


                                    <div class="job-card__info">
                                        <div class="d-md-flex align-items-center">
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <p>Pengadaan</p>
                                                    @if ($isNew)
                                                        <p class="tag-new">New!</p>
                                                    @endif
                                                    {{-- @if ($pengadaan->type != null)
                                                        <p class="tag-new">{{ $pengadaan->type }}</p>
                                                    @endif
                                                    @if ($pengadaan->category != null)
                                                        <p class="tag-new">{{ $pengadaan->category }}</p>
                                                    @endif --}}
                                                </div>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#tander{{ $pengadaan->id }}">
                                                    <h6>{{ $pengadaan->judul }}</h6>
                                                </a>
                                                <ul>
                                                    <li>{{ $timeAgo }}</li>
                                                    <li>{{ $tanggalDari }} - {{ $tanggalSampai }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                    <ul class="job-card__tags">
                                        @if ($pengadaan->status == 1)
                                            <li class="">Pengumuman</li>
                                        @elseif ($pengadaan->status == 2)
                                            <li class="">Aanwijzing</li>
                                        @elseif ($pengadaan->status == 3)
                                            <li class="">Penawaran Harga</li>
                                        @elseif ($pengadaan->status == 4)
                                            <li class="">Klarifikasi Teknis</li>
                                        @elseif ($pengadaan->status == 5)
                                            <li class="">Negosiasi</li>
                                        @elseif ($pengadaan->status == 6)
                                            <li class="">Pengumuman Pemenang</li>
                                        @else
                                            <li class="">Status Tidak Diketahui</li>
                                        @endif
                                    </ul>
                                </li>

                                <!-- Modal 1 -->
                                <div class="modal fade" id="tander{{ $pengadaan->id }}" tabindex="-1"
                                    aria-labelledby="tanderLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tanderLabel">{{ $pengadaan->judul }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="form-group col-md-12">
                                                            <label class="mt-2" for="judul">
                                                                <b>
                                                                    Judul
                                                                </b>
                                                            </label>
                                                            <br>
                                                            <span>{{ $pengadaan->judul }}</span>
                                                        </div>
                                                        {{-- <div class="form-group col-md-12">
                                                            <label class="mt-2" for="judul">
                                                                <b>
                                                                    Fungsi
                                                                </b>
                                                            </label>
                                                            <br>
                                                            @if ($pengadaan->id_fungsi != null)
                                                            @php
                                                                $fungsi = \App\Models\Fungsi::where('id',$pengadaan->id_fungsi)->first();
                                                            @endphp
                                                            <span>{{ $fungsi->fungsi ?? '-' }}</span>
                                                            @else
                                                            <span>-</span>

                                                            @endif
                                                        </div> --}}

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group col-md-12">
                                                                    <label class="mt-2" for="dari_tanggal">
                                                                        <b>
                                                                            Dari Tanggal
                                                                        </b>
                                                                    </label>
                                                                    <br>
                                                                    <span>{{ \Carbon\Carbon::parse($pengadaan->dari_tanggal)->translatedFormat('d F Y') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group col-md-12">
                                                                    <label class="mt-2" for="dari_tanggal">
                                                                        <b>
                                                                            Sampai Tanggal
                                                                        </b>
                                                                    </label>
                                                                    <br>
                                                                    <span>{{ \Carbon\Carbon::parse($pengadaan->sampai_tanggal)->translatedFormat('d F Y') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label class="mt-2" for="dari_tanggal">
                                                                <b>
                                                                    Status Pengadaan
                                                                </b>
                                                            </label>
                                                            @if ($pengadaan->status == 1)
                                                                <span class="badge bg-info mr-1">Pengumuman</span>
                                                            @elseif ($pengadaan->status == 2)
                                                                <span class="badge bg-primary mr-1">Aanwijzing</span>
                                                            @elseif ($pengadaan->status == 3)
                                                                <span class="badge bg-warning mr-1">Penawaran Harga</span>
                                                            @elseif ($pengadaan->status == 4)
                                                                <span class="badge bg-secondary mr-1">Klarifikasi
                                                                    Teknis</span>
                                                            @elseif ($pengadaan->status == 5)
                                                                <span class="badge bg-success mr-1">Negosiasi</span>
                                                            @elseif ($pengadaan->status == 6)
                                                                <span class="badge bg-danger mr-1">Pengumuman
                                                                    Pemenang</span>
                                                            @else
                                                                <span class="badge bg-dark mr-1">Status Tidak
                                                                    Diketahui</span>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4">
                                                        @php
                                                            $join = \App\Models\VendorPengadaan::where('id_pengadaan',$pengadaan->id)->where('id_vendor',Auth::guard('admin')->user()->id)->first();
                                                        @endphp
                                                        @if ($join == null)
                                                            <div class="form-group col-md-12 mt-2">
                                                                    <a href="{{ route('join.pengadaan',['id' => $pengadaan->id , 'vendor' => Auth::guard('admin')->user()->id ]) }}"
                                                                        class="btn btn-info" >+ Ikuti Pengadaan</a>
                                                            </div>
                                                        <hr>
                                                        @endif

                                                        <div class="form-group col-md-12">
                                                            <label class="mt-2" for="dari_tanggal">
                                                                <b>
                                                                    File Pengadaan
                                                                </b>
                                                            </label>
                                                            @if ($pengadaan->file != null)
                                                                <a href="{{ asset('documents/' . $pengadaan->file) }}"
                                                                    class="btn btn-danger" target="_blank">Download File</a>
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                       
                                                    </div>

                                                </div>


                                                <div class="row mt-3">
                                                    <label class="mt-2" for="upload_foto">
                                                        <b>
                                                            Deskripsi
                                                        </b>
                                                    </label>
                                                    <div class="col-lg-12">
                                                        {{-- <div class="form-row"> --}}

                                                        {!! $pengadaan->deskripsi !!}
                                                        {{-- </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </main>
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
