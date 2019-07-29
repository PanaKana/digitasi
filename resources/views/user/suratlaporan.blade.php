@extends('userlayout')
@section('heading')
    <h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>User/ </span>Surat Resmi</h1></h1>
@endsection
@section('content')
<div class="table-primary">
  <table class="table table-striped table-bordered" id="datatables">
    <thead>
      <tr>
        <th>Nomor Surat</th>
        <th>Tanggal Surat</th>
        <th>Jenis Surat</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($listsurattugasuser as $nomor => $data)
      <tr>
        <th>{{$data->nomor}}</th>  
        <th>{{$data->tanggal}}</th>
        <th>{{$data->nama}}</th>
        @if(isset($data->file))
        <th><a href="/user/download/{{str_replace('/', '_', $data->nomor)}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Download Laporan</a></th>
        @else
        <th>Laporan Belum DiUpload</th>
        @endif
        @endforeach
      </tbody>
  </table>
</div>

@endsection

  @section('js')

  <script>
    // -------------------------------------------------------------------------
    // Initialize DataTables

    $(function() {
      $('#datatables').dataTable();
      $('#datatables_wrapper .table-caption').text('Arsip Surat Resmi');
      $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Cari Data');
    });
</script>

@endsection
