
@extends('backend.layouts-new.app')

@section('content')

<style>
  .form-check-label {
      text-transform: capitalize;
  }
  .select2{
    width: 100%!important
  }
  label{
    float: left;
  }
</style>

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">Vendor List</h4>
                    <div class="clearfix"></div>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($admins as $admin)
                               <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->company_name }}</td>
                                    <td>{{ $admin->company_email }}</td>
                                    <td>
                                            <a class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $admin->id }}" href="#">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalEdit{{ $admin->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Data Registrasi Vendor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                      
                                                            <div class="container">
                                                                <form action="{{ route('admins.update-verifikasi', $admin->id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="row mb-2">
                                                                        <div class="col-lg-12">
                                                                            <label for="name">Status Verifikasi</label>
                                                                            <select name="status_verifikasi" class="form-control" id="">
                                                                                <option value="pending" {{ $admin->status_verifikasi == 'pending' ? 'selected' : '' }} >Pending</option>
                                                                                <option value="approve" {{ $admin->status_verifikasi == 'approve' ? 'selected' : '' }} >Approve</option>
                                                                                <option value="not approve" {{ $admin->status_verifikasi == 'not approve' ? 'selected' : '' }} >Not Approve</option>
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
                                                                                <option value="domestik" {{ $admin->region == 'domestik' ? 'selected' : '' }}>Domestik</option>
                                                                                <option value="foreign" {{ $admin->region == 'foreign' ? 'selected' : '' }}>Foreign</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="entityType" class="form-label">Entitas Perusahaan*</label>
                                                                            <select class="form-select" id="entityType" name="entity_type" required disabled>
                                                                                <option selected>Select Type</option>
                                                                                <option value="PT" {{ $admin->entity_type == 'PT' ? 'selected' : '' }}>PT</option>
                                                                                <option value="CV" {{ $admin->entity_type == 'CV' ? 'selected' : '' }}>CV</option>
                                                                                <option value="Yayasan" {{ $admin->entity_type == 'Yayasan' ? 'selected' : '' }}>Yayasan</option>
                                                                                <option value="Koperasi" {{ $admin->entity_type == 'Koperasi' ? 'selected' : '' }}>Koperasi</option>
                                                                                <option value="UD" {{ $admin->entity_type == 'UD' ? 'selected' : '' }}>UD</option>
                                                                                <option value="Lainnya" {{ $admin->entity_type == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="companyName" class="form-label">Nama Lengkap
                                                                                Perusahaan*</label>
                                                                            <input readonly type="text" class="form-control" id="companyName"
                                                                                value="{{ $admin->company_name }}" name="company_name" placeholder="ex: Elnusa" required>
                                                                        </div>
                            
                                                                    </div>
                            
                                                                    <!-- Informasi Kontak Perusahaan -->
                                                                    <div class="col-md-4">
                                                                        <h5>2. Informasi Kontak Perusahaan</h5>
                                                                        <div class="mb-3">
                                                                            <label for="phone" class="form-label">Nomor Telp. Kantor*</label>
                                                                            <input readonly type="text" class="form-control" id="phone"
                                                                                value="{{ $admin->office_phone }}" name="office_phone" placeholder="ex: 021XXXXXXX" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="email" class="form-label">Email Perusahaan*</label>
                                                                            <input readonly type="email" class="form-control" id="email"
                                                                                value="{{ $admin->company_email }}" name="company_email" placeholder="ex: user@company.com" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="fax" class="form-label">Nomor Fax</label>
                                                                            <input readonly type="text" class="form-control" id="fax" value="{{ $admin->fax }}" name="fax"
                                                                                placeholder="ex: 123123">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="domisili" class="form-label">Alamat, sesuai SKDP
                                                                                (Domisili)*</label>
                                                                            <textarea readonly name="domicile_address" class="form-control" id="" required>{{ $admin->domicile_address }}</textarea>
                            
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="operasional" class="form-label">Alamat
                                                                                Operasional*</label>
                                                                            <textarea readonly name="operational_address" class="form-control" id="" required>{{ $admin->operational_address }}</textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="npwp_company" class="form-label">NPWP Perusahaan*</label>
                                                                            <input readonly type="text" class="form-control" id="npwp_company"
                                                                                value="{{ $admin->npwp_company }}" name="npwp_company" placeholder="ex: 123123" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="akta_pendiri_perusahaan" class="form-label">Akta Pendirian
                                                                                Perusahaan*</label>
                                                                            <input readonly type="text" class="form-control"
                                                                                id="akta_pendiri_perusahaan" value="{{ $admin->akta_pendiri_perusahaan }}" name="akta_pendiri_perusahaan"
                                                                                placeholder="ex: 123123" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="nib" class="form-label">NIB Perusahaan*</label>
                                                                            <input readonly type="text" class="form-control" id="nib"
                                                                                value="{{ $admin->nib }}" name="nib" placeholder="ex: 123123" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="postalCode" class="form-label">Kode Pos
                                                                                (Domisili)*</label>
                                                                            <input readonly type="text" class="form-control" id="postalCode"
                                                                                value="{{ $admin->postal_code }}" name="postal_code" placeholder="ex: 12560" required>
                                                                        </div>
                                                                    </div>
                            
                                                                    <!-- Informasi PIC -->
                                                                    <div class="col-md-4">
                                                                        <h5>3. Informasi Contact Person</h5>
                                                                        <div class="mb-3">
                                                                            <label for="picName" class="form-label">Nama*</label>
                                                                            <input readonly type="text" class="form-control" id="picName"
                                                                                value="{{ $admin->pic_name }}" name="pic_name" placeholder="ex: Rezeki Ahmad A." required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="picPosition" class="form-label">Jabatan*</label>
                                                                            <input readonly type="text" class="form-control" id="picPosition"
                                                                                value="{{ $admin->pic_position }}" name="pic_position" placeholder="ex: Manager" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="picPhone" class="form-label">Nomor Handphone*</label>
                                                                            <input readonly type="text" class="form-control" id="picPhone"
                                                                                value="{{ $admin->pic_phone }}" name="pic_phone" placeholder="ex: 085XXXXXXXX" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="picEmail" class="form-label">Email*</label>
                                                                            <input readonly type="email" class="form-control" id="picEmail"
                                                                                value="{{ $admin->pic_email }}" name="pic_email" placeholder="ex: user@company.com" required>
                                                                        </div>
                            
                                                                        <h5>4. Login Information</h5>
                            
                                                                        <div class="mb-3">
                                                                            <label for="picEmail" class="form-label">Email*</label>
                                                                            <input readonly type="email" class="form-control" id="picEmail"
                                                                                value="{{ $admin->email }}" name="email" placeholder="ex: user@company.com" required>
                                                                        </div>
                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                    
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        
                                        <a class="btn btn-danger text-white" href="{{ route('admin.admins.destroy', $admin->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin->id }}').submit();">
                                        <i class="fa-solid fa-trash"></i>
                                        </a>
                                        <form id="delete-form-{{ $admin->id }}" action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
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
        <!-- data table end -->
        
    </div>
</div>

@endsection


@section('script')
   
@endsection