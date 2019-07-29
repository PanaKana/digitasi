@extends('userlayout')
@section('heading')
    <h1>Welcome Page</h1>
@endsection
@section('content')
      <div class="tab-pane fade in active" id="account-profile">
        <div class="row">
          <form action="" class="col-md-8 col-lg-9">
            <div class="p-x-1">
              <fieldset class="form-group form-group-lg">
                <label for="form-inline-input-1">Nomor Induk</label>
                <input type="text" class="form-control" name="nim" value="{{isset($inputdata->nim) ? $inputdata->nim : '' }}" disabled>
              </fieldset>
              <fieldset class="form-group form-group-lg">
                <label for="form-inline-input-1">Nama</label>
                <input type="text" class="form-control" name="nama" value="{{isset($inputdata->nama) ? $inputdata->nama : '' }}">
              </fieldset>
              <fieldset class="form-group form-group-lg">
                <label for="form-inline-input-1">Alamat</label>
                <input type="text" class="form-control" name="alamat" value="{{isset($inputdata->alamat) ? $inputdata->alamat : '' }}">
              </fieldset>
              <fieldset class="form-group form-group-lg">
                <label for="form-inline-input-1">Sekretariat</label>
                <input type="text" class="form-control" name="sekretariat" value="{{isset($inputdata->sekretariat) ? $inputdata->sekretariat : '' }}">
              </fieldset>
              <fieldset class="form-group form-group-lg">
                <label for="form-inline-input-1">Telepon</label>
                <input type="text" class="form-control" name="telepon" value="{{isset($inputdata->telepon) ? $inputdata->telepon : '' }}">
              </fieldset>
              </div>
               </form>
               <div class="m-t-4 visible-xs visible-sm"></div>
               <a href="/user/profile/data/input"class="btn btn-lg btn-primary m-t-3" type="button">Update profile</button></a>
                <a href="/user/profile/"class="btn btn-lg btn-primary m-t-3" type="button">Batalkan Update</button></a>            
@endsection