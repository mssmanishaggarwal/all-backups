<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('admins');
   }
public function index(){
		$data =array();		
		$data['heading'] 	= 'Dashboard';
        return view('admin.home',['data' => $data]);
    }
}
