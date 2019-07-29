<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;

use App\Mail\SidareEmail;
use Illuminate\Support\Facades\Mail;

class SuratController extends Controller
{
	public function list(){
		$list = DB::select('SELECT s.nomor, s.tanggal, js.nama, s.file, GROUP_CONCAT(u.nama) as penerima, unit.nama as unit FROM surat s INNER JOIN jenis_surat js ON s.jenis_surat = js.idjenis LEFT JOIN surat_user su ON s.nomor = su.no_surat LEFT JOIN user u ON su.penerima_nip = u.nip LEFT JOIN unit unit ON su.penerima_unit = unit.id GROUP BY s.nomor');
		$unit = DB::table('unit')->select('id', 'nama as text')->get();
		// dd($list);
		return view('admin.arsip',compact('list', 'unit'));
	}

	public function input($nomor){
		$inputdata = DB::table('surat')->where('nomor', str_replace('_','/',$nomor))->first();
		// dd($inputdata);
		$todaydate = date("Y-m-d");
		$jenis = DB::table('jenis_surat')->select('idjenis as id', 'nama as text')->get();
		// dd($jenis);
		return view('admin.formsurat', compact('inputdata', 'todaydate', 'jenis'));
	}
	public function save(Request $req, $nomor){
		$exist = DB::table('surat')->where('nomor', str_replace('_','/',$nomor))->first();
		// dd($exist);
		if($exist){
			//jika data ada maka update
			DB::table('surat')->where('nomor', str_replace('_','/',$nomor))->update([
				"nomor"  => $req->nomor,
				"tanggal"   => $req->tanggal,
				"jenis_surat"	=>	$req->jenis
			]);
			return redirect('/admin/surat/penerima/data/'.str_replace('/','_',$req->nomor));		
		}else{
		//jika tidak ada data maka register
			DB::table('surat')->insert([
				"nomor"  => $req->nomor,
				"tanggal"   => $req->tanggal,
				"jenis_surat"	=> $req->jenis
			]);
		}
		$input = 'file';

		if($req->hasFile($input)){
			//siapkan folder upload auto
			$path = public_path().'/upload/'.$req->jenis;
			if (!file_exists($path)){
				if(!mkdir($path, 0775, true))
					return 'gagal menyiapkan folder foto evidence';
			}
			//
			//taroh file ke variable
			$file = $req->file($input);
			try{
				//mendapatkan nama asli file
				$nama =  str_replace('/','_',$req->nomor.'.pdf');
				//proses uploading
				$moved = $file->move("$path", "$nama");
					// dd($moved);
				$suratinput = DB::table('surat')->where('nomor', str_replace('_','/',$req->nomor))->update(['file' => $nama]);
				// dd($suratinput);
				return redirect('/admin/surat/penerima/data/'.str_replace('/','_',$req->nomor));
			}
			catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $e)
			{
				return 'gagal menyimpan foto evidence' .$nomor;
			}
			
		}
		return redirect('/admin/arsip');
	}
	
	public function deletesurat($nomor){
		DB::table('surat_user')->where('no_surat', (str_replace('_', '/', $nomor)))->delete();
		DB::table('surat')->where('nomor', (str_replace('_', '/', $nomor)))->delete();
		return redirect('/admin/arsip');
	}
	public function delete($nim){
		DB::table('user')->where('nim', $nim)->delete();
		return redirect('/admin/list');
	}


	public function download(Request $req, $nomor){
		$js = DB::table('surat')->where('nomor', str_replace('_','/',$req->nomor))->first();
		$nama =  str_replace('/','_',$req->nomor.'.pdf');
		// dd($js);
		$path = public_path().'/upload/'.str_replace('/','_', $js->jenis_surat);
		
		return response()->download("$path". "/" . "$nama");
		return redirect('/user');
	}

	public function downloadlaporan(Request $req, $file){
		$nama =  str_replace('/','_',$req->file.'.pdf');
		// dd($js);
		$path = public_path().'/upload/'.'ST/'.'FileReport/'.str_replace('_','/',$req->nomor);
		// dd($path);
		return response()->download("$path". "/" . "$nama");
		return redirect('/admin/penugasan/list/{$req->nomor}');
	}		

	public function listpenerima(){
		$list = DB::select ('SELECT su.no_surat, s.tanggal, GROUP_CONCAT(u.nama) AS penerima_nip FROM surat_user su INNER JOIN user u ON su.penerima_nip = u.nip INNER JOIN surat s ON su.no_surat = s.nomor GROUP BY no_surat');
		// dd($list);
		return view('admin.listpenerima',compact('list'));
	}	

	public function inputpenerima($nomor){
		$datasurat = DB::table('surat_user')->where('no_surat', (str_replace('_', '/', $nomor)))->first();
		$datapenerima = DB::table('surat_user')->where('no_surat', (str_replace('_', '/', $nomor)))->implode('penerima_nip', ', ');
		$dataunit = DB::table('unit')->select('id as id', 'nama as text')->get();
		// dd($datasurat);
		$datapegawai = DB::table('user')->select('nip as id', 'nama as text')->get();
		$datasurat1 = DB::table('surat')->where('nomor', str_replace('_','/',$nomor))->first();
		$penerimaedit = DB::select('SELECT su.no_surat, su.penerima_nip as id, u.nama as text FROM surat_user su INNER JOIN user u on u.nip = su.penerima_nip WHERE su.no_surat = '.(str_replace("_", "/", '"'.$nomor.'"')));
		// dd($penerimaedit);
		return view('admin.formpenerima', compact('datasurat1', 'datasurat', 'datapenerima', 'datapegawai', 'penerimaedit','dataunit'));
	}

	public function savepenerima(Request $request, $nomor){
		$input = $request->all();
		$datenow = date('Y-m-d');
		$selectalluser = DB::table('user')->where('nip', '!=' , "all")->get();
		// dd($input);
		$exist = DB::table('surat_user')->where('no_surat', (str_replace('_', '/', $nomor)))->first();
		if($exist){
			for($i=0; $i < count($input['penerima']); $i++) {

				$dataupdate[] = [ 
					'no_surat' => (str_replace('_', '/', $nomor)),
					'penerima_nip' => $input['penerima'][$i],
					'penerima_unit' => $request->unit
				];
			}
			DB::table('surat_user')->where('no_surat', (str_replace('_', '/', $nomor)))->delete();
			DB::table('surat_user')->insert($dataupdate);

		}else if ($input['penerima'][0] == 'ALL'){
				$datainput[] = [ 
					'no_surat' => (str_replace('_', '/', $nomor)),
					'penerima_nip' => $request->penerima[0],
					'penerima_unit' => $request->unit
				];
				// dd($datainput);
			DB::table('surat_user')->insert($datainput);

			for($i=0; $i < count($selectalluser); $i++) {
				$dataemail[] = [ 
					$selectalluser
				];
				// dd($dataemail);
			}

			for($i=0; $i < count($selectalluser); $i++) {
				$getnama[] = [$dataemail[0][0][$i]->nama];
				$getemail[] = [$dataemail[0][0][$i]->email];
			}
				// dd($getemail);
			for($i=0; $i < count($selectalluser); $i++) {
				$naming[] = [$getnama[$i]];
				$nosurat = (str_replace('_', '/', $nomor));
				// dd($nosurat);
				$insertmail = Mail::to($getemail[$i])->send(new SidareEmail($naming[$i], $nosurat));
			}
				// dd($naming);
		}else{
			for($i=0; $i < count($input['penerima']); $i++) {
				$datainput[] = [ 
					'no_surat' => (str_replace('_', '/', $nomor)),
					'penerima_nip' => $input['penerima'][$i],
					'penerima_unit' => $request->unit
				];
			}
				// dd($getemail);
			DB::table('surat_user')->insert($datainput);
			for($i=0; $i < count($input['penerima']); $i++) {
				$dataemail[] = [ 
					DB::table('user')->where('nip', $input['penerima'][$i])->first()
				];
				// $getemail = $dataemail[$i];
			}

			for($i=0; $i < count($input['penerima']); $i++) {
				$getnama[] = [$dataemail[$i][0]->nama];
				$getemail[] = [$dataemail[$i][0]->email];
			}
			for($i=0; $i < count($input['penerima']); $i++) {
				$naming[] = [$getnama[$i]];
				$nosurat = (str_replace('_', '/', $nomor));
				// dd($nosurat);
				$insertmail = Mail::to($getemail[$i])->send(new SidareEmail($naming[$i], $nosurat));
				// dd($insertmail);
			}
		}
				// dd($naming);
			return redirect('/admin/arsip');
	}		// $getemail = DB::	
	public function deletepenerima($nomor){
		$delete = DB::table('surat_user')->where('no_surat', (str_replace('_', '/', $nomor)))->delete();
		// dd($delete);
		return redirect('/admin/arsip');
	}

	public function listsuratuser(){
		$capture = session()->get('nomor');
		$listsuratuser = DB::select('SELECT su.no_surat, s.tanggal, js.nama, s.file FROM surat_user su INNER JOIN surat s ON su.no_surat = s.nomor INNER JOIN jenis_surat js ON s.jenis_surat = js.idjenis WHERE su.penerima_nip = '.'"'.$capture.'"'.' OR su.penerima_nip = '.'"'."all".'"');
		// $listsuratuser = DB::table('surat_user')->where('penerima_nip', $capture)->get();
		// dd($listsuratuser);
		return view('user.surat',compact('listsuratuser'));
	}

	public function kirimemail(){

		return redirect('/admin/surat/penerima');
	}

}