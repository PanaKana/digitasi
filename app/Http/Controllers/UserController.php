<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
       public function dashboard(){
              $capture = session()->get('nomor');
              $suratuser = DB::table('surat_user')->where('penerima_nip', $capture)->get();
              $nowmonth = DB::select('SELECT su.no_surat, s.tanggal, js.nama, s.file FROM surat_user su INNER JOIN surat s ON su.no_surat = s.nomor INNER JOIN jenis_surat js ON s.jenis_surat = js.idjenis WHERE ( su.penerima_nip = '.'"'.$capture.'"'.' OR su.penerima_nip = '.'"'."all".'"'.') AND MONTH(s.tanggal) = MONTH(CURDATE())');
              $nowmonthtask = DB::select('SELECT su.no_surat, s.tanggal, js.nama, su.penerima_nip, lu.file FROM surat s INNER JOIN jenis_surat js ON s.jenis_surat = js.idjenis INNER JOIN surat_user su ON s.nomor = su.no_surat LEFT JOIN laporan_user lu ON s.nomor = lu.no_surat WHERE (su.penerima_nip = '.'"'.$capture.'"'.' AND js.idjenis = "ST") AND MONTH(s.tanggal) = MONTH(CURDATE())');
              // dd($nowmonth);
              return view('user.home',compact('nowmonth', 'capture', 'nowmonthtask'));
       }

	public function list(){
		$capture = session()->get('nomor');
		$datadiri = DB::table('user')->where('nim', $capture)->first();
		// dd($datadiri);
		return view('user.profile',compact('datadiri', 'capture'));
	}

	public function input(){
		$capture = session()->get('nomor');
		$inputdata = DB::table('user')->where('nim', $capture)->first();
		return view('user.profileform', compact('inputdata'));
	}

	public function save(Request $req, $nim){
		$capture = session()->get('nomor');
		$exist = DB::table('user')->where('nim', $capture)->first();
		dd($exist);
		if($exist){
			//jika data ada maka update
			DB::table('user')->where('nim', $capture)->update([
				"nim"  => $req->nim,
				"nama"   => $req->nama,
				"alamat"   => $req->alamat,
				"sekretariat"   => $req->prodi,
				"telepon"   => $req->telepon,
				"status"   => $exist->status,
				"password"   => $exist->password
			]);		
		}else{
		//jika tidak ada data maka register
			DB::table('user')->insert([
				"nim"  => $req->nim,
				"nama"   => $req->nama,
				"alamat"   => $req->alamat,
				"sekretariat"   => $req->prodi,
				"telepon"   => $req->telepon,
				"status"   => $exist->status,
				"password"   => $exist->password
			]);
		}
		return redirect('/user/profile');
	}

	public function download(Request $req, $nim){
		$model_file = Model::findOrFail($nim); //Mencari model atau objek yang dicari
    	$file = public_path() . '/upload/' . $model_file->file;//Mencari file dari model yang sudah dicari
       	return response()->download($file, $model_file->file_name); //Download file yang dicari berdasarkan nama fil
       	return redirect('/user');
       }

       	public function listreport(){
       		$capture = session()->get('nomor');

                     $datasurat =  DB::select('SELECT su.no_surat, s.tanggal, js.nama, su.penerima_nip, lu.tanggal_upload, lu.file, lu.tanggal_upload 
                            FROM surat s 
                            INNER JOIN jenis_surat js ON s.jenis_surat = js.idjenis 
                            INNER JOIN surat_user su ON s.nomor = su.no_surat 
                            LEFT JOIN laporan_user lu ON s.nomor = lu.no_surat 
                            WHERE su.penerima_nip = '.'"'.$capture.'"'.' AND js.idjenis = "ST"');
              // dd($datasurat);
       		return view('user.listtugas',compact('datasurat'));
       	}

       public function listsurattugasuser(){
              $capture = session()->get('nomor');
              $listsurattugasuser = DB::select('SELECT s.nomor, s.tanggal, js.nama, s.file FROM surat_user su INNER JOIN surat s ON su.no_surat = s.nomor INNER JOIN jenis_surat js ON s.jenis_surat = js.idjenis INNER JOIN user u ON su.penerima_nip = u.nip WHERE su.penerima_nip = '.'"'.$capture.'"');
              // $listsuratuser = DB::table('surat_user')->where('penerima_nip', $capture)->get();
              // dd($listsuratuser);
              return view('user.suratlaporan',compact('listsurattugasuser'));
       }
       	public function inputreport($nomor){
       		$capture = session()->get('nomor');
       		$datasurat = DB::table('laporan_user')->where('no_surat', str_replace("_", "/", '"'.$nomor.'"'))->where('pelapor', $capture)->first();
       		$jenis_surat = DB::table('jenis_surat')->select('idjenis as id','nama as text');
       		return view('user.formlapor', compact('datasurat', 'jenis_surat'));
       	}

       	public function savereport(Request $req, $nomor){
       		$capture = session()->get('nomor');
       		$exist = DB::table('laporan_user')->where('no_surat', str_replace("_", "/", '"'.$nomor.'"'))->where('pelapor', $capture)->first();
       		if($exist){
       			DB::table('laporan_user')->where('no_surat', str_replace('_','/',$nomor))->update([
       				"no_surat"  => str_replace("_", "/",$req->nomor),
       				"pelapor"	=>	$capture
       			]);
       		}else{
       			DB::table('laporan_user')->where('no_surat', str_replace('_','/',$nomor))->insert([
       				"no_surat"  => str_replace("_", "/",$req->nomor),
       				"pelapor"	=>	$capture,
       				"tanggal_upload"  => DB::raw('now()')
       			]);
       		}
       		$input = 'file';

       		if($req->hasFile($input)){
			//siapkan folder upload auto
       			$path = public_path().'/upload/ST/FileReport/'.$req->nomor;
       			if (!file_exists($path)){
       				if(!mkdir($path, 0775, true))
       					return 'gagal menyiapkan folder foto evidence';
       			}
			//
			//taroh file ke variable
       			$file = $req->file($input);
       			try{
				//mendapatkan nama asli file
       				$nama =  str_replace('/','_',$req->nomor.'_'.$capture.'.pdf');
				//proses uploading
       				$moved = $file->move("$path", "$nama");
					// dd($moved);
       				DB::table('laporan_user')->where('no_surat', str_replace('_','/',$req->nomor))->where('pelapor', $capture)->update(['file' => $nama]);

       			}
       			catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $e)
       			{
       				return 'gagal menyimpan foto evidence' .$nomor;
       			}
       		}
       		return redirect('/user/report');
       	}
              public function deletereport($nomor, $nip){
              DB::table('laporan_user')->where('no_surat', str_replace('_','/',$nomor))->where('pelapor', $nip)->delete();
              return redirect('/admin/user/report');
       }

             public function inputdatadiri($nim){
              $inputdata = DB::table('user')->where('nip', $nim)->first();
              // $sekretariat = DB::table('sekretariat')->select('kode as id', 'nama as text')->get();
              return view('user.formedit', compact('inputdata'));
       }
       
       public function savedatadiri(Request $req, $nim){
              $validasi = $req->validate([
                     'nim' => 'required',
                     'nama' => 'required',
                     'alamat' => 'required',
                     'jabatan' => 'required',
                     "jk" => 'required',
                     "telepon" => 'required',
                     "email" => 'required|email',
                     "status" => 'required',
                     "password" => 'required'
              ]);

              $exist = DB::table('user')->where('nip', $nim)->first();

              if($exist){
                     //jika data ada maka update
                     $update = [
                            "nip" => $req->nim,
                            "nama" => $req->nama,
                            "alamat" => $req->alamat,
                            "jabatan" => $req->jabatan,
                            "jk" => $req->jk,
                            "telepon" => $req->telepon,
                            "email" => $req->email,
                            "status" => $req->status,
                            "password" => $req->password
                     ];            
                            try {
                                   DB::table('users')->update($update);  
                            } catch(\Illuminate\Database\QueryException $e){
                                   $errorCode = $e->errorInfo[1];
                                   if($errorCode == '1062'){
                                          
                                   }
                            }
              }else{
              //jika tidak ada data maka register
                     $insert = [
                            "nip" => $req->nim,
                            "nama" => $req->nama,
                            "alamat" => $req->alamat,
                            "jabatan" => $req->jabatan,
                            "jk" => $req->jk,
                            "telepon" => $req->telepon,
                            "email" => $req->email,
                            "status" => $req->status,
                            "password" => $req->password
                     ];
                            try {
                                   DB::table('user')->where('nip', $nim)->insert($insert);  
                            } catch(\Illuminate\Database\QueryException $e){
                                   $errorCode = $e->errorInfo[1];
                                   if($errorCode == '1062'){
                                          return redirect('/admin/data/pegawai/input')->with('ganda','Data Pegawai Sudah Ada');
                                   }
                            }
              }
              // dd($exist);
              return redirect('/adminunit/');
       }
       }