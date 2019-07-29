@extends('layout')
@section('heading')
    <h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Admin/ </span>List Penerima Surat</h1></h1>
@endsection
@section('content')
<div class="table-primary">
  <table class="table table-striped table-bordered" id="datatables">
    <thead>
      <tr>
        <th>No. Surat</th>
        <th>Tanggal Surat</th>
        <th>Penerima Tugas</th>
        <th>Laporan User</th>
      </tr>
    </thead>
    <tbody>
      @foreach($listpenugasan as $no_surat => $data)
      <tr>
        <th>{{$data->nomor}}</th>  
        <th>{{$data->tanggal}}</th>
        <th>{{$data->nama}}</th>
        <th><a href="/admin/penugasan/list/{{str_replace('/', '_', $data->nomor)}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Lihat Daftar Laporan</th>
        @endforeach
      </tbody>
  </table>
</div>
<div class="pull-xs-right p-a-2 m-l-3">
  <a href="/admin/data/input"class="btn btn-info btn-rounded" type="button">Tambah Penerimaan Surat</a>
</div>

@endsection

  @section('js')

  <script>
    // -------------------------------------------------------------------------
    // Initialize DataTables

    $(function() {
      $('#datatables').dataTable();
      $('#datatables_wrapper .table-caption').text('Karyawan Dan Dosen');
      $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Cari Data');
    });
</script>

@endsection
