@extends('layout')
@section('heading')
    <h1> <h1><span class="text-muted font-weight-light"><i class="page-header-icon ion-ios-keypad"></i>Admin/ </span>Surat Resmi</h1></h1>
@endsection
@section('content')
<div class="table-primary">
  <table class="table table-striped table-bordered" id="datatables">
    <thead>
      <tr id ="filters">
        <th>Nomor Surat</th>
        <th>Tanggal Surat</th>
        <th>Jenis Surat</th>
        <th>Penerima</th>
        <th>Unit</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($list as $nomor => $data)
      <tr>
        <th>{{$data->nomor}}</th>  
        <th>{{$data->tanggal}}</th>
        <th>{{$data->nama}}</th>
        <th>{{$data->penerima}}</th>
        <th>{{$data->unit}}</th>
        @if(isset($data->file))
        <th><a href="/download/{{ str_replace('/', '_', $data->nomor)}}" class = "btn btn-success btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Download Surat</a>
        <a href="/admin/surat/data/{{ str_replace('/', '_', $data->nomor)}}" class = "btn btn-success btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Edit Data Surat</a>
        <a href="/admin/arsip/delete/{{ str_replace('/', '_', $data->nomor)}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Hapus Data Surat</a>
        @else
        <th>
          <a href="/admin/surat/data/{{ str_replace('/', '_', $data->nomor)}}" class = "btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Data Surat Belum Benar, Silahkan Perbaiki</a><br> </th>
        @endif
        </tr>
        @endforeach
      </tbody>
  </table>
</div>
<div class="pull-xs-right p-a-2 m-l-3">
  <a href="/admin/surat/data/input"class="btn btn-info btn-rounded" type="button">Upload Surat</a>
</div>

@endsection

  @section('js')


  <script>
    // -------------------------------------------------------------------------
    // Initialize DataTables
    $(function() {
      var datau = <?= json_encode($unit); ?>;
      // "bFilter": true,
      $('#datatables').DataTable({

        "pageLength": 50,
        initComplete: function () {



            this.api().columns(4).every(function () {

                var column = this;


                var select = $('<select><option value="">Semua</option></select>')
                    .appendTo($("#filters").find("th").eq(column.index()))
                    .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                    $(this).val());                                     

                    column.search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });
              

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });
      $('#datatables_wrapper .table-caption').text('Arsip Surat Resmi');
      $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Cari Data');
    });
</script>

@endsection
