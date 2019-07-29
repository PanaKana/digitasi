@extends('layout')
@section('heading')
<h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Admin/ </span>Upload Surat</h1></h1>
@endsection
@section('content')
<div class="panel-body">
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
	<form class="form-horizontal" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="form-inline-input-1" class="col-md-3 control-label">Nomor Surat</label>
			<div class="col-md-9">
				<input type="text" class="form-control" id="grid-input-1" name="nomor" placeholder="Nomor Surat" value="{{ isset($inputdata->nomor)? $inputdata->nomor : '' }}">
			</div>
		</div>

		<div class="form-group">
			<label for="form-inline-input-1" class="col-md-3 control-label">Tanggal Surat</label>
			<div class="col-md-9">
				<input type="text" class="form-control" id="grid-input-1" name="tanggal" placeholder="Tanggal Surat" value="{{ isset($inputdata->tanggal)? $inputdata->tanggal : '' }}">
			</div>
		</div>

		<div class="form-group">
			<label for="jenis" class="col-md-3 control-label">Jenis Surat</label>
			<div class="col-md-9">
				<input type="text" class="form-control" name="jenis" id="jenis"  value="{{ isset($inputdata->jenis_surat) ? $inputdata->jenis_surat : '' }}">
			</div>
		</div>

		<div class="form-group">
			<label for="grid-input-3" class="col-md-3 control-label" name="file_s">File Surat</label>
			<div class="col-md-9">
				<input type="file" class="form-control-file" name="file" id ="
				file" accept="application/pdf">
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
	$(function (){
      var data = <?= json_encode($jenis); ?>;
      console.log(data);
      $("#jenis").select2({
        data:data,
        placeholder : 'Silahkan Pilih Jenis Surat'
      });
    });
</script>
@endsection