@extends('layout')
@section('heading')
    <h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Admin/ </span>Data Jenis Surat</h1></h1>
@endsection
@section('content')
 <div class="panel-body">
        <form class="form-horizontal" method="post">
          <div class="form-group">
            <label for="form-inline-input-1" class="col-md-3 control-label">Kode Jenis Surat</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="grid-input-1" name="kode" placeholder="Kode Jenis Surat" value="{{ isset($inputdata->idjenis)? $inputdata->idjenis : '' }}">
            </div>
          </div>
          <div class="form-group">
            <label for="form-inline-input-1" class="col-md-3 control-label">Nama Jenis Surat</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="grid-input-1" name="nama" placeholder="Nama Jenis" value="{{ isset($inputdata->nama)? $inputdata->nama : '' }}">
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