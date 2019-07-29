@extends('layout')
@section('heading')
@endsection
@section('content')
<div class="col-md-5">
 <div class="panel">
  <div class="panel-heading">
    <span class="panel-title"><i class="panel-title-icon fa fa-flask"></i>Data Surat</span>
  </div>
  <div class="panel-body">
    <p align="center">Upload Dan Lihat Surat Anda</p>
    <a type="button" align="center" class="btn btn-primary btn-rounded" href="/admin/arsip">Data Surat</a>
  </div>
</div>
</div>
</div>
<div class="row panels-example">
  <div class="col-md-5">
   <div class="panel">
    <div class="panel-heading">
      <span class="panel-title"><i class="panel-title-icon fa fa-flask"></i>Data Pegawai</span>
    </div>
    <div class="panel-body">
     <p align="center">Edit Dan Lihat Data Pegawai
     </p>
    <a type="button" align="center" class="btn btn-primary btn-rounded" href="/admin/list/pegawai">Data Pegawai</a>
   </div>
 </div>
</div>
</div>
</div>
@endsection