@extends('layout')
@section('heading')
    <h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Admin/ </span>List Penerima Surat</h1></h1>
@endsection
@section('content')
<div class="table-primary">
  <table class="table table-striped table-bordered" id="datatables">
    <thead>
      <tr>
        <th>NIP</th>
        <th>Nama</th>
        <th>Tanggal Upload</th>
        <th>Download</th>
      </tr>
    </thead>
    <tbody>
      @foreach($listlaporanpenugasan as $no_surat => $data)
      <tr>
        <th>{{$data->nip}}</th>  
        <th>{{$data->nama}}</th>
        <th>{{$data->tanggal_upload}}</th> 
        @if(isset($data->file))
        <th><a href="/download/laporan/{{str_replace('/', '_', $nomor)}}/{{str_replace('/', '_', $nomor)}}_{{$data->nip}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Download Laporan</a></th>
        @else
        <th>Laporan Belum DiUpload</th>
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
      $('#datatables_wrapper .table-caption').text('Karyawan Dan Dosen');
      $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Cari Data');
    });
</script>

@endsection
