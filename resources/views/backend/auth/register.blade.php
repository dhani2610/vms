<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


    <title>
        Dashboard - Login
    </title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logos/logo-simply.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>


    <style>
        .authentication-wrapper.authentication-basic .authentication-inner {
            max-width: auto !important;
        }
    </style>

</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">

                        @include('backend.layouts.partials.messages')

                        <form method="POST" action="{{ route('admin-register-store') }}">
                            @csrf

                            <div class="container mt-5">
                                <form>
                                    <h3 class="mb-4">Formulir Registrasi</h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5>1. Informasi Perusahaan</h5>
                                            <div class="mb-3">
                                                <label for="region" class="form-label">Domestik/Foreign
                                                    Vendor*</label>
                                                <select class="form-select" id="region" name="region" required>
                                                    <option selected>Please Select Region</option>
                                                    <option value="domestik">Domestik</option>
                                                    <option value="foreign">Foreign</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="entityType" class="form-label">Entitas Perusahaan*</label>
                                                <select class="form-select" id="entityType" name="entity_type" required>
                                                    <option selected>Select Type</option>
                                                    <option value="PT">PT</option>
                                                    <option value="CV">CV</option>
                                                    <option value="Yayasan">Yayasan</option>
                                                    <option value="Koperasi">Koperasi</option>
                                                    <option value="UD">UD</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="companyName" class="form-label">Nama Lengkap
                                                    Perusahaan*</label>
                                                <input type="text" class="form-control" id="companyName"
                                                    name="company_name" placeholder="ex: Elnusa" required>
                                            </div>

                                        </div>

                                        <!-- Informasi Kontak Perusahaan -->
                                        <div class="col-md-4">
                                            <h5>2. Informasi Kontak Perusahaan</h5>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Nomor Telp. Kantor*</label>
                                                <input type="text" class="form-control" id="phone"
                                                    name="office_phone" placeholder="ex: 021XXXXXXX" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Perusahaan*</label>
                                                <input type="email" class="form-control" id="email"
                                                    name="company_email" placeholder="ex: user@company.com" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="fax" class="form-label">Nomor Fax</label>
                                                <input type="text" class="form-control" id="fax" name="fax"
                                                    placeholder="ex: 123123">
                                            </div>
                                            <div class="mb-3">
                                                <label for="domisili" class="form-label">Alamat, sesuai SKDP
                                                    (Domisili)*</label>
                                                <textarea name="domicile_address" class="form-control" id="" required></textarea>

                                            </div>
                                            <div class="mb-3">
                                                <label for="operasional" class="form-label">Alamat
                                                    Operasional*</label>
                                                <textarea name="operational_address" class="form-control" id="" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="npwp_company" class="form-label">NPWP Perusahaan*</label>
                                                <input type="text" class="form-control" id="npwp_company"
                                                    name="npwp_company" placeholder="ex: 123123" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="akta_pendiri_perusahaan" class="form-label">Akta Pendirian
                                                    Perusahaan*</label>
                                                <input type="text" class="form-control"
                                                    id="akta_pendiri_perusahaan" name="akta_pendiri_perusahaan"
                                                    placeholder="ex: 123123" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nib" class="form-label">NIB Perusahaan*</label>
                                                <input type="text" class="form-control" id="nib"
                                                    name="nib" placeholder="ex: 123123" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="postalCode" class="form-label">Kode Pos
                                                    (Domisili)*</label>
                                                <input type="text" class="form-control" id="postalCode"
                                                    name="postal_code" placeholder="ex: 12560" required>
                                            </div>
                                        </div>

                                        <!-- Informasi PIC -->
                                        <div class="col-md-4">
                                            <h5>3. Informasi Contact Person</h5>
                                            <div class="mb-3">
                                                <label for="picName" class="form-label">Nama*</label>
                                                <input type="text" class="form-control" id="picName"
                                                    name="pic_name" placeholder="ex: Rezeki Ahmad A." required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="picPosition" class="form-label">Jabatan*</label>
                                                <input type="text" class="form-control" id="picPosition"
                                                    name="pic_position" placeholder="ex: Manager" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="picPhone" class="form-label">Nomor Handphone*</label>
                                                <input type="text" class="form-control" id="picPhone"
                                                    name="pic_phone" placeholder="ex: 085XXXXXXXX" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="picEmail" class="form-label">Email*</label>
                                                <input type="email" class="form-control" id="picEmail"
                                                    name="pic_email" placeholder="ex: user@company.com" required>
                                            </div>

                                            <h5>4. Login Information</h5>

                                            <div class="mb-3">
                                                <label for="picEmail" class="form-label">Email*</label>
                                                <input type="email" class="form-control" id="picEmail"
                                                    name="email" placeholder="ex: user@company.com" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password*</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="" required>
                                            </div>

                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="agreement1"
                                                    name="integrity_agreement" required>
                                                <label class="form-check-label" for="agreement1">
                                                    Saya sudah membaca, memahami, dan menyetujui
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#pdfModal1">Pakta Integritas</a>
                                                </label>
                                            </div>

                                            <!-- Checkbox 2 -->
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="agreement2"
                                                    name="avl_statement" required>
                                                <label class="form-check-label" for="agreement2">
                                                    Saya sudah membaca, memahami, dan menyetujui
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#pdfModal2">Surat Pernyataan AVL</a>
                                                </label>
                                            </div>

                                            <!-- Checkbox 3 -->
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="agreement3"
                                                    name="gtc_agreement" required>
                                                <label class="form-check-label" for="agreement3">
                                                    Saya sudah membaca dan menyetujui
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#pdfModal3">GTC</a>
                                                </label>
                                            </div>


                                        </div>
                                    </div>
                            </div>

                            <!-- Button Actions -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ url('admin/login') }}" type="button" class="btn btn-secondary">Login</a>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </form>
                    </div>

                    </form>

                </div>
            </div>

            <!-- /Register -->


            <!-- Modal 1 -->
            <div class="modal fade" id="pdfModal1" tabindex="-1" aria-labelledby="pdfModal1Label"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModal1Label">Pakta
                                Integritas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="https://1drv.ms/b/c/191aa2b64b70a20f/IQSkYIUsoQWXSLXEac55HhRRAbTd4C9zLq12Ij1-ccV4IMw" width="100%"
                                height="600px"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 2 -->
            <div class="modal fade" id="pdfModal2" tabindex="-1" aria-labelledby="pdfModal2Label"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModal2Label">Surat
                                Pernyataan AVL</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="https://1drv.ms/b/c/191aa2b64b70a20f/IQSkYIUsoQWXSLXEac55HhRRAbTd4C9zLq12Ij1-ccV4IMw" width="100%"
                                height="600px"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 3 -->
            <div class="modal fade" id="pdfModal3" tabindex="-1" aria-labelledby="pdfModal3Label"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModal3Label">GTC</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="https://1drv.ms/b/c/191aa2b64b70a20f/IQSkYIUsoQWXSLXEac55HhRRAbTd4C9zLq12Ij1-ccV4IMw" width="100%"
                                height="600px"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
