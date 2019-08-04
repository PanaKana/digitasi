<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class AdminUnitController extends Controller
{
		public function listdashboard(){
		$capture = session()->get('unit');
		$listsuratunit = DB::select('SELECT su.no_surat, s.tanggal, js.nama, s.file, GROUP_CONCAT(u.nama) as penerima, su.penerima_unit as unit FROM surat_user su INNER JOIN surat s ON su.no_surat = s.nomor INNER JOIN jenis_surat js ON s.jenis_surat = js.idjenis RIGHT JOIN user u ON su.penerima_nip = u.nip WHERE ( su.penerima_unit ='.'"'.$capture.'"'.' OR su.penerima_nip = '.'"'."all".'"'.') AND MONTH(s.tanggal) = MONTH(CURDATE()) GROUP BY s.nomor');
		// dd($listsuratunit);
		return view('adminunit.dashboard',compact('listsuratunit'));
	}

	public function list(){
		$capture = session()->get('unit');
		$list = DB::select('SELECT s.nomor, s.tanggal, js.nama, s.file, GROUP_CONCAT(u.nama) as penerima, su.penerima_unit as unit FROM surat_user su INNER JOIN surat s ON su.no_surat = s.nomor INNER JOIN jenis_surat js ON s.jenis_surat = js.idjenis RIGHT JOIN user u ON su.penerima_nip = u.nip WHERE ( su.penerima_unit ='.'"'.$capture.'"'.' OR su.penerima_nip = '.'"'."all".'"'.') GROUP BY s.nomor');
		// dd($list);
		return view('adminunit.list',compact('list'));
	}

	public function listsuratuser(){
		$capture = session()->get('nomor');
		$listsuratuser = DB::select('SELECT su.no_surat, s.tanggal, js.nama, s.file FROM surat_user su INNER JOIN surat s ON su.no_surat = s.nomor INNER JOIN jenis_surat js ON s.jenis_surat = js.idjenis WHERE su.penerima_nip = '.'"'.$capture.'"'.' OR su.penerima_nip = '.'"'."all".'"');
		// $listsuratuser = DB::table('surat_user')->where('penerima_nip', $capture)->get();
		// dd($listsuratuser);
		return view('adminunit.surat',compact('listsuratuser'));
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
       		return view('adminunit.listtugas',compact('datasurat'));
       	}
		public function inputreport($nomor){
       		$capture = session()->get('nomor');
       		$datasurat = DB::table('laporan_user')->where('no_surat', str_replace("_", "/", '"'.$nomor.'"'))->where('pelapor', $capture)->first();
       		$jenis_surat = DB::table('jenis_surat')->select('idjenis as id','nama as text');
       		return view('adminunit.formlapor', compact('datasurat', 'jenis_surat'));
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
       		return redirect('/adminunit/user/report');
       	}

              public function inputdatadiri($nim){
              $inputdata = DB::table('user')->where('nip', $nim)->first();
              // $sekretariat = DB::table('sekretariat')->select('kode as id', 'nama as text')->get();
              return view('adminunit.formedit', compact('inputdata'));
       }
       
       public function savedatadiri(Request $req, $nim){
             $validasi = $req->validate([
                     'nama' => 'required',
                     'alamat' => 'required',
                     "jk" => 'required',
                     "telepon" => 'required',
                     "email" => 'required|email',
                     "password" => 'required'
              ]);

              $exist = DB::table('user')->where('nip', $nim)->first();

              if($exist){
                     //jika data ada maka update
                     $update = [
                            "nip" => $req->nim,
                            "nama" => $req->nama,
                            "alamat" => $req->alamat,
                            "jk" => $req->jk,
                            "telepon" => $req->telepon,
                            "email" => $req->email,
                            "password" => $req->password
                     ];            
                            try {
                                   DB::table('user')->where('nip', $nim)->update($update);  
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