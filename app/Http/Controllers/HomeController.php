<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class SuratController extends Controller
{
        public function cek(){
        if(session::get('auth')->status == 'Admin'){
        return redirect('/');
        }elseif(session::get('auth')->status == 'User'){
        return redirect('/user');
        }
        }
}   