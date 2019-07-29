@extends('layout')
@section('heading')
    <h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Admin/ </span>Data Karyawan Dan Dosen</h1></h1>
@endsection
@section('content')
<div class="table-primary">
  <table class="table table-striped table-bordered" id="datatables">
    <thead>
      <tr>
        <th>NIK</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Alamat Domisili</th>
        <th>Nomor HP</th>
        <th>Jenis User</th>
        <th>Unit</th>
        <th>Ubah</th>
      </tr>
    </thead>
    <tbody>
      @foreach($listdata as $nim => $data)
      <tr>
        <th>{{$data->nip}}</th>  
        <th>{{$data->nama}}</th>
        <th>{{$data->jabatan}}</th>
        <th>{{$data->alamat}}</th>
        <th>{{$data->telepon}}</th>
        <th>{{$data->status}}</th>
        <th>{{$data->unit}}</th>
        <th><a href="/admin/data/pegawai/{{$data->nip}}" class ="btn btn-info btn-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a>
          <a href="/admin/list/pegawai/delete/{{$data->nip}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</a></th>
        </tr> 
        @endforeach
      </tbody>
  </table>
</div>
<div class="pull-xs-right p-a-2 m-l-3">
  <a href="/admin/data/pegawai/input"class="btn btn-info btn-rounded" type="button">Tambah Data Dosen Dan Karyawan</a>
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
