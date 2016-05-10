<?php

namespace App\Http\Controllers;
use App\Helper\Languagehelper;
use DB;
use Illuminate\Http\Request;

class RegisterController extends Controller {

	public function __construct() {
		//$this->middleware('auth');
	}

	public function index(Request $request) {
		$data = array();
		/* SET DEFAULT LANGUAGE START */
		$data['languages'] = Languagehelper::getLanguage();
		$data['default_language'] = Languagehelper::getDefaultLanguage();

		$language_id = $request->session()->get('language_id');
		if (empty($language_id)) {
			$request->session()->put('language_id', $data['default_language']);
			$data['language_val'] = $data['default_language'];
			$data['currentlanguages'] = $data['default_language'];

		} else {
			$data['language_val'] = $language_id;
			$data['currentlanguages'] = $language_id;
		}
		$data['secondary_header'] = 0;
		/* SET DEFAULT LANGUAGE END */
		$data['reg_email'] = $request->session()->get('reg_email');
		return view('registrationthanks', ['data' => $data]);
	}

	public function show($id, Request $request) {
		$data = array();
		/* SET DEFAULT LANGUAGE START */
		$data['languages'] = Languagehelper::getLanguage();
		$data['default_language'] = Languagehelper::getDefaultLanguage();

		$language_id = $request->session()->get('language_id');
		if (empty($language_id)) {
			$request->session()->put('language_id', $data['default_language']);
			$data['language_val'] = $data['default_language'];
			$data['currentlanguages'] = $data['default_language'];

		} else {
			$data['language_val'] = $language_id;
			$data['currentlanguages'] = $language_id;
		}
		$data['secondary_header'] = 0;
		/* SET DEFAULT LANGUAGE END */
		$userid = '';
		$user = DB::table('users')
			->select('id')
			->where('email_auth', '=', $id)
			->get();
		foreach ($user as $key => $val) {
			$userid = $val->id;
		}
		if (!isset($val->id) || $val->id == '') {
			$data['msg'] = 'error';
			return view('authenticate', ['data' => $data]);
		} else {
			DB::table('users')
				->where('id', $val->id)
				->update(array(
					'is_active' => 1,
					'email_auth' => '',
				)
				);
			$data['msg'] = 'success';
			return view('authenticate', ['data' => $data]);
		}

		//
	}

}