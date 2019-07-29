@extends('adminunitlayout')
@section('heading')
@endsection
@section('content')
<div class="panel">
  <div class="panel-title">Surat Unit Untuk Bulan Ini</div>
  <div class="panel-body">
    <table class="table table-striped table-bordered" id="datatables">
    <thead>
      <tr>
        <th>Nomor Surat</th>
        <th>Tanggal Surat</th>
        <th>Jenis Surat</th>
        <th>Penerima</th>
        <th>Unit</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
       @foreach($listsuratunit as $nomor => $data)
      <tr>
        <th>{{$data->no_surat}}</th>  
        <th>{{$data->tanggal}}</th>
        <th>{{$data->nama}}</th>
        <th>{{$data->penerima}}</th>
        <th>{{$data->unit}}</th>
        @if(isset($data->file))
         <th><a href="/adminunit/download/{{ str_replace('/', '_', $data->no_surat) }}" class = "btn btn-success btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Download</a></th>
         @else
        <th>Surat Belum DiUpload</th>
        @endif
        </tr>
        @endforeach
      </tbody>  
  </table>
  </div>
</div>
@endsection
  @section('js')

  <script>
    // -------------------------------------------------------------------------
    // Initialize DataTables

    $(function() {
      $('#datatables').dataTable(
       {
          "pageLength": 5
        });
      $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Cari Data');
    });
</script>

@endsection