@extends('layout')
@section('heading')
    <h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>User/ </span>Daftar Penugasan</h1></h1>
@endsection
@section('content')

<div class="table-primary">
  <table class="table table-striped table-bordered" id="datatables">
    <thead>
      <tr>
        <th>No. Surat</th>
        <th>Surat</th>
        <th>Tgl Surat</th>
        <th>Tgl Lapor</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
      <tbody>
      @foreach($datasurat as $nomor => $data)
      <tr>
        <th>{{$data->no_surat}}</th>  
        <th>{{$data->nama}}</th>
        <th>{{$data->tanggal}}</th>
        <th>{{$data->tanggal_upload}}</th>
        @if(isset($data->file))
        <th>Laporan Telah Diupload</th>
        <th><a href="/download/laporan/{{str_replace('/', '_', $data->no_surat)}}/{{str_replace('/', '_', $data->no_surat)}}_{{$data->penerima_nip}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Lihat Isi Laporan</a>
          <br><a href="/admin/user/report/data/{{str_replace('/', '_', $data->no_surat)}}" class ="btn btn-info btn-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit Laporan</a></br>
          <a href="/admin/user/report/data/delete/{{str_replace('/', '_', $data->no_surat)}}/{{session()->get('nomor')}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Hapus Laporan</a></th>
        @else
        <th>Laporan Belum DiUpload</th>
        <th><a href="/admin/user/report/data/{{str_replace('/', '_', $data->no_surat)}}" class ="btn btn-info btn-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Masukan Laporan</a>
        @endif
      </tr> 
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
      $('#datatables_wrapper .table-caption').text('Daftar Laporan Penugasan');
      $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Cari Data');
    });
</script>

@endsection
