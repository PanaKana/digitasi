@extends('layout')
@section('heading')
<h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Admin/ </span>Tambah atau Edit Penerima Surat</h1></h1>
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
			<label for="form-inline-input-1" class="col-md-3 control-label">Nomor Surat</label>
			<div class="col-md-9">
				<input type="text" disabled class="form-control" id="grid-input-1" name="nomor" placeholder="Nomor Surat" value="{{ isset($datasurat1->nomor)? $datasurat1->nomor : '' }}">
			</div>
		</div>
<div class="form-group">
            <label for="validation-select" class="col-sm-3 control-label">Penerima</label>
            <div class="col-sm-9">
              <select class="form-control select2-primary" id="penerima" name="penerima[]" multiple="multiple"></select>
            </div>
          </div>

          <div class="form-group">
            <label for="validation-select" class="col-sm-3 control-label">Unit</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" name="unit" id="unit" value="{{ isset($datasurat->penerima_unit) ? $datasurat->penerima_unit : '' }}">
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
   var data = <?= json_encode($datapegawai); ?>,
   array = [];
   var datap = <?= json_encode($penerimaedit); ?>,
   array = [];
   var datau = <?= json_encode($dataunit); ?>;

   console.log(data);
   
    $.each(datap, function(key, id){
    array.push(id.id)
   });

   $("#penerima").select2({
    data:data,
    placeholder: 'Silahkan Pilih Penerima'
  });

   $("#unit").select2({
    data:datau,
    placeholder: 'Silahkan Pilih Unit'
  });

    $('#penerima').select2().val(array).trigger('change');
    });

</script>
@endsection