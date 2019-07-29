@extends('userlayout')
@section('heading')
@endsection
@section('content')
<div class="panel">
  <div class="panel-title">Surat Anda Untuk Bulan Ini</div>
  <div class="panel-body">
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
      @foreach($nowmonth as $nomor => $data)
      <tr>
        <th>{{$data->no_surat}}</th>  
        <th>{{$data->tanggal}}</th>
        <th>{{$data->nama}}</th>
         @if(isset($data->file))
         <th><a href="/user/download/{{ str_replace('/', '_', $data->no_surat) }}" class = "btn btn-success btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Download</a></th>
         @else
        <th>Surat Belum DiUpload</th>
        @endif
        </tr>
        @endforeach
      </tbody>  
  </table>
  </div>
</div>
<div class="panel">
  <div class="panel-title">Surat Tugas Anda Untuk Bulan Ini</div>
  <div class="panel-body">
    <table class="table table-striped table-bordered" id="datatables1">
    <thead>
      <tr>
        <th>Nomor Surat</th>
        <th>Tanggal Surat</th>
        <th>Jenis Surat</th>
        <th>Download Surat</th>
        <th>Data Laporan</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($nowmonthtask as $nomor => $data)
      <tr>
        <th>{{$data->no_surat}}</th>  
        <th>{{$data->tanggal}}</th>
        <th>{{$data->nama}}</th>
         <th><a href="/user/download/{{ str_replace('/', '_', $data->no_surat) }}" class = "btn btn-success btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Download</a></th>
        @if(isset($data->file))
        <th><a href="/user/download/laporan/{{str_replace('/', '_', $data->no_surat)}}/{{str_replace('/', '_', $data->no_surat)}}_{{$data->penerima_nip}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Lihat Isi Laporan</a></th>
        <th><a href="/user/report/data/{{str_replace('/', '_', $data->no_surat)}}" class ="btn btn-info btn-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit Laporan</a>
          <br><a href="/admin/surat/penerima/delete/{{str_replace('/', '_', $data->no_surat)}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Hapus Laporan</a></th></br>
        @else
        <th>Laporan Belum DiUpload</th>
        <th><a href="/user/report/data/{{str_replace('/', '_', $data->no_surat)}}" class ="btn btn-info btn-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit Laporan</a></th>
        @endif
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

    $(function() {
      $('#datatables1').dataTable(
        {
          "pageLength": 5
        });
      $('#datatables1_wrapper .dataTables_filter input').attr('placeholder', 'Cari Data');
    });   
</script>

@endsection