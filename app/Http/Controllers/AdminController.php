<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use App\Mail\NewUserEmail;
use Mail;

class AdminController extends Controller
{
	public function list(){
		$listdata = DB::table('user')->where('nip', '!=' , "all")->get();
		// dd($selectalluser);
		return view('admin.list',compact('listdata'));
	}

	public function input($nim){
		$inputdata = DB::table('user')->where('nip', $nim)->first();
		$unit = DB::table('unit')->select('id', 'nama as text')->get();
		// dd($unit);
		// $sekretariat = DB::table('sekretariat')->select('kode as id', 'nama as text')->get();
		return view('admin.form', compact('inputdata', 'unit'));

	}
	public function save(Request $req, $nim){
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
				"unit" => $req->unit,
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
				"unit" => $req->unit,
				"password" => $req->password
			];

		$nama = $req->nama;
		$nip = $req->nim;
		$password = $req->password;
		$email = $req->email;
		// dd($email);
		Mail::to($email)->send(new NewUserEmail($nama, $nip, $password));

 
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
		return redirect('/admin/list/pegawai');
	}
	public function delete($nim){
		DB::table('user')->where('nip', $nim)->delete();
		return redirect('/admin/list/pegawai/');
	}

	public function login(Request $req){
		$exists = DB::table('user')
		->where('nip', $req->NIP)
		->where('password', $req->Password)->first();
		
		if($exists){
			Session::put('auth', $exists);
			session(['nomor' => $exists->nip]);
			session(['name' => $exists->nama]);
			session(['status' => $exists->status]);
			session(['unit' => $exists->unit]);
			if($exists){
				redirect('/')->with('cek', 'Sukses Login');
			} else{
				$redi = redirect('/')->with('cek', 'Login Gagal, Silahkan Cek Kembali Password Anda');
			}

			if($exists->status =='User'){
				return redirect('/user');
			}elseif($exists->status =='Admin'){
				return redirect('/admin');
			}elseif($exists->status =='AdminUnit'){	
				return redirect('/adminunit');
			}
		}else{
			return redirect('/')->with('cek', 'Login Gagal, Silahkan Cek Kembali NIP Dan Password Anda');
		}
			$cb=Session::get('cek');
			dd($cb);

	}

	public function logout(){
		Session::forget('auth');
		Session::forget('nip');
		Session::forget('name');
		Session::forget('unit');
		return redirect('/');
	}

	public function listsekretariat(){
		$listunit = DB::table('unit')->get();
		//dd($listmhs);
		return view('admin.listsekretariat',compact('listunit'));
	}

	public function inputsekretariat($kode){
		$inputdata = DB::table('unit')->where('id', $kode)->first();
		return view('admin.sform', compact('inputdata'));
	}
	public function savesekretariat(Request $req, $kode){
		$exist = DB::table('unit')->where('id', $kode)->first();

		if($exist){
			//jika data ada maka update
			DB::table('unit')->where('id', $kode)->update([
				"id"  => $req->kode,
				"nama"   => $req->nama
			]);		
		}else{
		//jika tidak ada data maka register
			DB::table('unit')->insert([
				"id"  => $req->kode,
				"nama"   => $req->nama
			]);
		}
		return redirect('/admin/unit');
	}
	public function deletesekretariat($kode){
		DB::table('sekretariat')->where('kode', $kode)->delete();
		return redirect('/admin/unit');
	}

	public function listjenis(){
		$listjenis = DB::table('jenis_surat')->get();
		//dd($listmhs);
		return view('admin.listjabatan',compact('listjenis'));
	}

	public function inputjenis($kode){
		$inputdata = DB::table('jenis_surat')->where('idjenis', $kode)->first();
		return view('admin.jenisform', compact('inputdata'));
	}
	public function savejenis(Request $req, $kode){
		$exist = DB::table('jenis_surat')->where('idjenis', $kode)->first();

		if($exist){
			//jika data ada maka update
			DB::table('jenis_surat')->where('idjenis', $kode)->update([
				"idjenis"  => $req->kode,
				"nama"   => $req->nama
			]);		
		}else{
		//jika tidak ada data maka register
			DB::table('jenis_surat')->insert([
				"idjenis"  => $req->kode,
				"nama"   => $req->nama
			]);
		}
		return redirect('/admin/surat/jenis');
	}
	public function deletejenis($kode){
		DB::table('jenis_surat')->where('idjenis', $kode)->delete();
		return redirect('/admin/surat/jenis');
	}

	public function listpenugasan(){
		$listpenugasan = DB::select('SELECT s.tanggal, s.nomor, GROUP_CONCAT(u.nama) as nama FROM surat s INNER JOIN surat_user su ON s.nomor = su.no_surat INNER JOIN jenis_surat js ON s.jenis_surat = js.idjenis INNER JOIN user u ON su.penerima_nip = u.nip WHERE js.idjenis = '.'"'."ST".'"'. 'GROUP BY s.nomor');
		// dd($listpenugasan);
		return view('admin.listpenugasan',compact('listpenugasan'));
	}

	public function listlaporanpenugasan($nomor){
		$listlaporanpenugasan = DB::select('SELECT u.nip, u.nama, lu.tanggal_upload, lu.file AS file FROM laporan_user lu INNER JOIN user u ON lu.pelapor = u.nip WHERE lu.no_surat = '.'"'.(str_replace('_', '/', $nomor)).'"');
		// dd($listlaporanpenugasan);
		return view('admin.listlaporanpenugasan',compact('listlaporanpenugasan', 'nomor'));
	}

	public function listsuratuser(){
		$capture = session()->get('nomor');
		$listsuratuser = DB::select('SELECT su.no_surat, s.tanggal, js.nama, s.file FROM surat_user su INNER JOIN surat s ON su.no_surat = s.nomor INNER JOIN jenis_surat js ON s.jenis_surat = js.idjenis WHERE su.penerima_nip = '.'"'.$capture.'"'.' OR su.penerima_nip = '.'"'."all".'"');
		// $listsuratuser = DB::table('surat_user')->where('penerima_nip', $capture)->get();
		// dd($listsuratuser);
		return view('admin.surat',compact('listsuratuser'));
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
       		return view('admin.listtugas',compact('datasurat'));
       	}

       	public function inputreport($nomor){
       		$capture = session()->get('nomor');
       		$datasurat = DB::table('laporan_user')->where('no_surat', str_replace("_", "/", '"'.$nomor.'"'))->where('pelapor', $capture)->first();
       		$jenis_surat = DB::table('jenis_surat')->select('idjenis as id','nama as text');
       		return view('admin.formlapor', compact('datasurat', 'jenis_surat'));
       	}

    public function savereport(Request $req, $nomor){
       		$capture = session()->get('nomor');
       		// $nosurat = str_replace('_','/',$nomor)
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
       		return redirect('/admin/user/report');
       	}

       	public function deletereport($nomor, $nip){
		DB::table('laporan_user')->where('no_surat', str_replace('_','/',$nomor))->where('pelapor', $nip)->delete();
		return redirect('/user/report');
	}
}	