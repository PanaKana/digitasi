@extends('userlayout')
@section('heading')
<h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>User/ </span>Upload Hasil Surat Penugasan</h1></h1>
@endsection
@section('content')
	@if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
				@endif
<div class="panel-body">
	<form class="form-horizontal" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="form-inline-input-1" class="col-md-3 control-label">Nomor Surat Penugasan</label>
			<div class="col-md-9">
				<input disabled type="text" class="form-control" id="grid-input-1" name="nomor" placeholder="Nomor Surat" value="{{str_replace('_','/',Request::segment(4))}}">
			</div>
		</div>

		<div class="form-group">
			<label for="grid-input-3" class="col-md-3 control-label" name="file_s">File Laporan</label>
			<div class="col-md-9">
				<input type="file" class="form-control-file" name="file" id ="
				file">
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
        $('#js').select2({
        placeholder: 'Pilih Jenis Surat',
        data: [{"id":"SP", "text" : "Surat Pemberitahuan"},{"id":"SK", "text" : "Surat Keterangan"}]
      });
    });

</script>
@endsection