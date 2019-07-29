@extends('layout')
@section('heading')
    <h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Admin/ </span>Data Jenis Surat</h1></h1>
@endsection
@section('content')
<div class="table-primary">
  <table class="table table-striped table-bordered" id="datatables">
    <thead>
      <tr>
        <th>Kode Jenis Surat</th>
        <th>Nama Jenis Surat</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($listjenis as $kode => $data)
      <tr>
        <th>{{$data->idjenis}}</th>  
        <th>{{$data->nama}}</th>
        <th><a href="/admin/surat/jenis/{{$data->idjenis}}" class ="btn btn-info btn-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a>
          <a href="/admin/surat/jenis/delete/{{$data->idjenis}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</a></th>
        </tr> 
        @endforeach
      </tbody>
  </table>
</div>
<div class="pull-xs-right p-a-2 m-l-3">
  <a href="/admin/surat/jenis/input"class="btn btn-info btn-rounded" type="button">Tambah Jenis Surat</a>
</div>

@endsection

  @section('js')


  <script>
    // -------------------------------------------------------------------------
    // Initialize DataTables
    $(function() {
      $('#datatables').dataTable();
      $('#datatables_wrapper .table-caption').text('Daftar Sekretariat');
      $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Cari Data');
    });
</script>

@endsection
