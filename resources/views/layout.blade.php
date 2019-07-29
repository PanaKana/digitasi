<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <title>Politeknik Negeri Banjarmasin</title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">

  <!-- Core stylesheets -->
  <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="/css/pixeladmin.min.css" rel="stylesheet" type="text/css">
  <link href="/css/widgets.min.css" rel="stylesheet" type="text/css">

  <!-- Theme -->
  <link href="/css/themes/asphalt.min.css" rel="stylesheet" type="text/css">

  <!-- Pace.js -->
  <script src="/pace/pace.min.js"></script>
  @yield('css')
</head>
<body>
  <!-- Nav -->
  <nav class="px-nav px-nav-left">
    <button type="button" class="px-nav-toggle" data-toggle="px-nav">
      <span class="px-nav-toggle-arrow"></span>
      <span class="navbar-toggle-icon"></span>
      <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
    </button>

    <ul class="px-nav-content">
      <li class="px-nav-item px-nav-dropdown">
        <a href="#"><i class="px-nav-icon ion-gear-b"></i><span class="px-nav-label">Admin</span></a>
        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item {{Request ::segment(3) == 'pegawai'?'active' : '' }}"><a href="/admin/list/pegawai"><span class="px-nav-label">Data Karyawan Dan Dosen</span></a></li>
          <li class="px-nav-item {{Request ::segment(2) == 'arsip'?'active' : '' }}"><a href="/admin/arsip"><span class="px-nav-label">Arsip Surat</span></a></li>
          <li class="px-nav-item {{Request ::segment(3) == 'jenis'?'active' : '' }}"><a href="/admin/surat/jenis"><span class="px-nav-label">Daftar Jenis Surat</span></a></li>
           <li class="px-nav-item {{Request ::segment(2) == 'unit'?'active' : '' }}"><a href="/admin/unit"><span class="px-nav-label">Daftar Unit</span></a></li>
           <li class="px-nav-item {{Request ::segment(2) == 'penugasan'?'active' : '' }}"><a href="/admin/penugasan"><span class="px-nav-label">Daftar Laporan Hasil Penugasan</span></a></li>
        </ul>
      </li>
      <li class="px-nav-item px-nav-dropdown">
        <a href="#"><i class="px-nav-icon ion-ios-home"></i><span class="px-nav-label">Surat</span></a>
        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item {{Request ::segment(3) == 'surat'?'active' : '' }}"><a href="/admin/user/surat"><span class="px-nav-label">Daftar Surat Anda</span></a></li>
        </ul>
      </li>
        
      <li class="px-nav-item px-nav-dropdown">
        <a href="#"><i class="px-nav-icon ion-clipboard"></i><span class="px-nav-label">Penugasan</span></a>
        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item {{Request ::segment(3) == 'report'?'active' : '' }}"><a href="/admin/user/report/"><span class="px-nav-label">Daftar Laporan Anda</span></a></li>
        </ul>
      </li>
      <li class="px-nav-item px-nav-dropdown">
        <a href="#"><i class="px-nav-icon ion-clipboard"></i><span class="px-nav-label">Halo, <b>{{session()->get('name')}}</b></span></a>
        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item"><a href="/admin/data/pegawai/{{session()->get('nomor')}}"><span class="px-nav-label">Data Diri</span></a></li>
        </ul>
        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item"><a href="/logout"><span class="px-nav-label">Logout</span></a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <!-- Navbar -->
  <nav class="navbar px-navbar">
    <div class="navbar-header">
      <a class="navbar-brand" href="/admin">POLIBAN</a>
    </div>

    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-navbar-collapse" aria-expanded="true"><i class="navbar-toggle-icon"></i></button>

    <div class="collapse navbar-collapse" id="px-navbar-collapse">
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            {{session()->get('nomor')}}
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">Data Diri</a></li>
            <li class="divider"></li>
            <li><a href="/logout">Logout</a></li>
          
        </li>
      </ul>
    </div>
  </nav>

  <!-- Content -->
  <div class="px-content">
    <div class="page-header">
      @yield('heading')
  </div>

    <div>
      @yield('content')
    </div>
  </div>


  <!-- ==============================================================================
  |
  |  SCRIPTS
  |
  =============================================================================== -->

  <!-- Load jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Core scripts -->
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/pixeladmin.min.js"></script>

  <!-- Your scripts -->
  <script src="/js/app.js"></script>
  <script type="text/javascript">
    $(function(){
      var alertExist = <?= json_encode(Session::has('alerts')); ?>;
      if(alertExist){
        toastr.options = {
          "closeButton": true,
          "positionClass": "toast-top-center",
          "onclick": null,
          "timeOut": "200000"
        }
        var msg = <?= json_encode(session('alerts')[0]); ?>;
        toastr.info(msg.text);
      }
    });
  </script>
  @yield('js')
</body>
</html>
