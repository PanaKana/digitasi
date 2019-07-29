@extends('userlayout')
@section('heading')
@endsection
@section('content')
<div class="panel">
  <div class="panel-title">Title</div>
  <div class="panel-body">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
  </div>
</div>
@endsection
  @section('js')
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/pixeladmin.min.js"></script>

  <script>
    // -------------------------------------------------------------------------
    // Initialize DataTables

    $(function() {
      $('#datatables').dataTable();
      $('#datatables_wrapper .table-caption').text('Surat Anda Pada Bulan Ini');
      $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Cari Data');
    });
</script>

@endsection