
@extends('backend.layouts-new.app')

@section('title')
Dashboard Page - Admin Panel
@endsection


@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div id="container">
            <center>
              <img src="{{ asset('assets/img/logos/logo-vms.svg') }}" style="max-width: 50%">
            </center>
            @if (Auth::guard('admin')->user()->type == 'vendor' && Auth::guard('admin')->user()->status_verifikasi == 'pending' )
            <center>
              <div class="alert alert-warning text-dark" role="alert">
                Data Anda dalam proses verifikasi oleh admin. Harap tunggu proses verifikasi untuk dapat mengikuti tender online
              </div>
            </center>
            @endif
           
          </div>
        </div>
      </div>
    </div>

    
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



  <script>


$("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
  </script>
  

@endsection
@push('dashboard')
