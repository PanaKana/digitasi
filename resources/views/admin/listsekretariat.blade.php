@extends('layout')
@section('heading')
    <h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Admin/ </span>Data Sekretariat</h1></h1>
@endsection
@section('content')
<div class="table-primary">
  <table class="table table-striped table-bordered" id="datatables">
    <thead>
      <tr>
        <th>Kode Sekretariat</th>
        <th>Nama Sekretariat</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($listunit as $kode => $data)
      <tr>
        <th>{{$data->id}}</th>  
        <th>{{$data->nama}}</th>
        <th><a href="/admin/unit/data/{{$data->id}}" class ="btn btn-info btn-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a>
          <a href="/admin/unit/delete/{{$data->id}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</a></th>
        </tr> 
        @endforeach
      </tbody>
  </table>
</div>
<div class="pull-xs-right p-a-2 m-l-3">
  <a href="/admin/unit/data/input"class="btn btn-info btn-rounded" type="button">Tambah Data Unit</a>
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
