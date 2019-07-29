@extends('adminunitlayout')
@section('heading')
<h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Admin/ </span>Data Pegawai</h1></h1>
@endsection
@section('content')
<div class="panel-body">
@if (session('ganda'))
<div class="alert alert-danger">{{ session('ganda') }}</div>
@endif
 @if ($errors->any())
 <div class="alert alert-danger alert-dark">
  <button class="close" type="button" data-dismiss="alert">×</button>
  <h4 class="alert-heading">Error</h4>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="form-inline-input-1" class="col-md-3 control-label">NIP Pegawai</label>
    <div class="col-md-9">
      <input type="text" disabled class="form-control" id="grid-input-1" name="nim" placeholder="Nomor Induk Pegawai" value="{{ isset($inputdata->nip)? $inputdata->nip : '' }}">
    </div>
  </div>
  <div class="form-group">
    <label for="form-inline-input-1" class="col-md-3 control-label">Nama Pegawai</label>
    <div class="col-md-9">
      <input type="text" class="form-control" id="grid-input-1" name="nama" placeholder="Nama Pegawai" value="{{ isset($inputdata->nama)? $inputdata->nama : '' }}">
    </div>
  </div>

  <div class="form-group">
   <label for="jk" class="col-md-3 control-label">Jenis Kelamin</label>
   <div class="col-md-3">
     <input type="text" class="form-control" name="jk" id="jk" value="{{ isset($inputdata->jk) ? $inputdata->jk : '' }}">
   </div>
 </div>
 <div class="form-group">
  <label for="sekretariat" class="col-md-3 control-label">Jabatan</label>
  <div class="col-md-9">
    <input type="text" disabled class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="{{ isset($inputdata->jabatan) ? $inputdata->jabatan: '' }}">
  </div>
</div>
<div class="form-group">
  <label for="form-inline-input-1" class="col-md-3 control-label">Alamat</label>
  <div class="col-md-9">
    <input type="text" class="form-control" id="grid-input-1" name="alamat" placeholder="Alamat" value="{{ isset($inputdata->alamat)? $inputdata->alamat : '' }}">
  </div>
</div>
<div class="form-group">
  <label for="form-inline-input-1" class="col-md-3 control-label">Nomor HP</label>
  <div class="col-md-9">
    <input type="text" class="form-control" id="grid-input-1" name="telepon" placeholder="Nomor HP" value="{{ isset($inputdata->telepon)? $inputdata->telepon : '' }}">
  </div>
</div>
<div class="form-group">
  <label for="form-inline-input-1" class="col-md-3 control-label">E-Mail</label>
  <div class="col-md-9">
    <input type="text" class="form-control" id="grid-input-1" name="email" placeholder="E-Mail" value="{{ isset($inputdata->email)? $inputdata->email : '' }}">
  </div>
</div>
<div class="form-group">
 <label for="jk" class="col-md-3 control-label">Hak User</label>
 <div class="col-md-3">
   <input type="text" disabled class="form-control" name="status" id="status" value="{{ isset($inputdata->status) ? $inputdata->status : '' }}">
 </div>
</div>
<div class="form-group">
 <label for="jk" class="col-md-3 control-label">Unit</label>
 <div class="col-md-3">
   <input type="text" disabled class="form-control" name="status" id="status" value="{{ isset($inputdata->unit) ? $inputdata->unit : '' }}">
 </div>
</div>
<div class="form-group">
  <label for="form-inline-input-1" class="col-md-3 control-label">Password</label>
  <div class="col-md-9">
    <input type="password" class="form-control" id="grid-input-1" name="password" placeholder="Password" value="{{ isset($inputdata->password)? $inputdata->password : '' }}">
  </div>
</div>
<div class="form-group">
  <div class="col-md-offset-3 col-md-9">
    <button type="submit" class="btn">Simpan</button>
  </div>
</div>
</form>
</div>
@endsection
@section('js')
<script type="text/javascript">
 $(function() {

  $('#jk').select2({
    placeholder: 'Select Jenis Kelamin',
    data: [{"id":"P", "text" : "Perempuan"},{"id":"L", "text" : "Laki-Laki"}]
  });

  $('#status').select2({
    placeholder: 'Select Status',
    data: [{"id":"User", "text" : "User"},{"id":"Admin", "text" : "Admin"}, {"id":"AdminUnit", "text" : "Admin Unit"}]
  });
});
</script>
@endsection