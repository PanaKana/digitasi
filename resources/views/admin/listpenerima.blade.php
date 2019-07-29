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
        <th>Tanggal Upload</th>
        <th>Penerima</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($list as $no_surat => $data)
      <tr>
        <th>{{$data->no_surat}}</th>  
        <th>{{$data->tanggal_upload}}</th>
        <th>{{$data->penerima_nip}}</th>
        <th><a href="/admin/surat/penerima/data/{{str_replace('/', '_', $data->no_surat)}}" class ="btn btn-info btn-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a>
          <a href="/admin/surat/penerima/delete/{{str_replace('/', '_', $data->no_surat)}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</a></th>
        </tr> 
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
