<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <!-- DEMO ONLY: Function for the proper stylesheet loading according to the demo settings -->

  <!-- Core stylesheets -->
  <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="/css/pixeladmin.min.css" rel="stylesheet" type="text/css">
  <link href="/css/widgets.min.css" rel="stylesheet" type="text/css">
  <link href="/demo/demo.css" rel="stylesheet" type="text/css">

  <!-- Theme -->
  <link href="/css/themes/asphalt.min.css" rel="stylesheet" type="text/css">

  <!-- Pace.js -->
  <script src="/pace/pace.min.js"></script>

  <!-- Custom styling -->
  <style>
    .page-signin-modal {
      position: relative;
      top: auto;
      right: auto;
      bottom: auto;
      left: auto;
      z-index: 1;
      display: block;
    }

    .page-signin-form-group { position: relative; }

    .page-signin-icon {
      position: absolute;
      line-height: 21px;
      width: 36px;
      border-color: rgba(0, 0, 0, .14);
      border-right-width: 1px;
      border-right-style: solid;
      left: 1px;
      top: 9px;
      text-align: center;
      font-size: 15px;
    }

    html[dir="rtl"] .page-signin-icon {
      border-right: 0;
      border-left-width: 1px;
      border-left-style: solid;
      left: auto;
      right: 1px;
    }

    html:not([dir="rtl"]) .page-signin-icon + .page-signin-form-control { padding-left: 50px; }
    html[dir="rtl"] .page-signin-icon + .page-signin-form-control { padding-right: 50px; }

    #page-signin-forgot-form {
      display: none;
    }

    /* Margins */

    .page-signin-modal > .modal-dialog { margin: 30px 10px; }

    @media (min-width: 544px) {
      .page-signin-modal > .modal-dialog { margin: 60px auto; }
    }
  </style>
  <!-- / Custom styling -->
</head>
<body>
  <div class="page-signin-modal modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="box m-a-0">
          <div class="box-row">

            <div class="box-cell col-md-5 bg-primary p-a-4">
              <div class="text-xs-center">
                <img src="/picture/poliban.png" width="200" height="200">
              </img>
              <br></br>
              <p><span class="font-size-20">SIDARE</span>
              <div class="font-size-15 m-t-1 line-height-1">Sistem Digitasi Dan Arsip Surat Resmi Politeknik Negeri Banjarmasin</div></p>
            </div>
          </div>

          <div class="box-cell col-md-7">

            <!-- Sign In form -->

            <form method="post" class="p-a-4" id="page-signin-form">
              <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">Login Untuk Melanjutkan</h4>
          @if (session('cek'))
          <div class="alert alert-danger">{{ session('cek') }}</div>
          @endif
              <fieldset class="page-signin-form-group form-group form-group-lg">
                <div class="page-signin-icon text-muted"><i class="ion-person"></i></div>
                <input type="text" class="page-signin-form-control form-control" name="NIP" placeholder="Masukkan Nomor NIP">
              </fieldset>

              <fieldset class="page-signin-form-group form-group form-group-lg">
                <div class="page-signin-icon text-muted"><i class="ion-asterisk"></i></div>
                <input type="password" class="page-signin-form-control form-control" name="Password" placeholder="Masukkan Password">
              </fieldset>


              <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3" >Login</button>
            </form>

            <!-- / Sign In form -->

            <!-- Reset form -->

            <form action="index.html" class="p-a-4" id="page-signin-forgot-form">
              <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">Password reset</h4>

              <fieldset class="page-signin-form-group form-group form-group-lg">
                <div class="page-signin-icon text-muted"><i class="ion-at"></i></div>
                <input type="email" class="page-signin-form-control form-control" placeholder="Your Email">
              </fieldset>

            </form>

            <!-- / Reset form -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- ==============================================================================
  |
  |  SCRIPTS
  |
  =============================================================================== -->

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/pixeladmin.min.js"></script>



</body>
</html>
