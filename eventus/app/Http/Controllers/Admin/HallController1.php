<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Lang;
use Validator;

class HallController extends Controller {
	public function __construct() {
		$this->middleware('admins');

	}
	public function index(Request $request) {

		$hall_name = Input::get('hall_name');
		$contact_name = Input::get('contact_name');
		$contact_email = Input::get('contact_email');
		$contact_mobile = Input::get('contact_mobile');
		$rental_amount = Input::get('rental_amount');
		$location_id = Input::get('location_id');
		$todo = Input::get('todo');
		$sorting = Input::get('sorting');
		//$order_type = Input::get('order_type');
		//$primary_id = Input::get('primary_id');
		if ($request->wantsJson() || $request->isJson()) {
			if ($todo == 'search') {
				$query = DB::table('hall as htype');
				//$query->select('*');
				$query->select('htrans.*', 'htype.*', 'pr.province_name', 'lc.location_name', 'usr.first_name', 'usr.last_name');
				$query->leftJoin('hall_translation as htrans', 'htype.id', '=', 'htrans.hall_id');
				$query->leftJoin('province as pr', 'pr.id', '=', 'htrans.hall_province');
				$query->leftJoin('location_translation as lc', 'lc.location_id', '=', 'htrans.location_id');
				$query->leftJoin('users as usr', 'usr.id', '=', 'htrans.user_id');
				/*$query->where(DB::raw('CONCAT(ev_u.first_name," ",ev_u.last_name)'),'like','%'.$first_name.'%');*/
				//$query->join('hall_translation as htrans', 'htype.id', '=', 'htrans.hall_id');
				if (!empty($hall_name)) {
					$query->where('htrans.hall_name', 'like', '%' . $hall_name . '%');
				}
				if (!empty($contact_name)) {
					$query->where('htrans.contact_name', 'like', '%' . $contact_name . '%');
				}
				if (!empty($contact_email)) {
					$query->where('htrans.contact_email2', 'like', '%' . $contact_email . '%');
				}
				if (!empty($contact_mobile)) {
					$query->where('htrans.contact_mobile', 'like', '%' . $contact_mobile . '%');
				}
				if (!empty($rental_amount)) {
					$query->where('htrans.rental_amount', 'like', '%' . $rental_amount . '%');
				}
				if (!empty($location_id)) {
					$query->where('htrans.location_id', 'like', '%' . $location_id . '%');
				}
				$query->where('htrans.language_id', env('default_language'));
				$query->orderBy('htype.id');
				$return = $query->get();
				///echo response()->json($halltype);
			} elseif ($todo == 'sort_asc') {

				$query = DB::table('hall as htype');
				$query->select('*');
				$query->join('hall_translation as htrans', 'htype.id', '=', 'htrans.hall_id');
				$query->where('htrans.language_id', env('default_language'));
				$query->orderBy('htrans.' . $sorting, 'asc');
				$return = $query->get();

			} elseif ($todo == 'sort_desc') {
				$query = DB::table('hall as htype');
				$query->select('*');
				$query->join('hall_translation as htrans', 'htype.id', '=', 'htrans.hall_id');
				$query->where('htrans.language_id', env('default_language'));
				$query->orderBy('htrans.' . $sorting, 'desc');
				$return = $query->get();

			} else {
				$query = DB::table('hall as htype');
				$query->select('htrans.*', 'htype.*', 'pr.province_name', 'lc.location_name', 'usr.first_name', 'usr.last_name');
				$query->leftJoin('hall_translation as htrans', 'htype.id', '=', 'htrans.hall_id');
				$query->leftJoin('province as pr', 'pr.id', '=', 'htrans.hall_province');
				$query->leftJoin('location_translation as lc', 'lc.location_id', '=', 'htrans.location_id');
				$query->leftJoin('users as usr', 'usr.id', '=', 'htrans.user_id');
				$query->where('htrans.language_id', '=', 1);
				$query->where('lc.language_id', '=', 1);
				//->where('htrans.language_id', env('default_language'))
				$query->orderBy('htype.id');
				$return = $query->get();
				foreach ($return as $key => $usr) {
					$return[$key]->created_at = dateFormat($usr->created_at);
				}

			}
			//dd($halltype[0]->location_id);
			return response()->json($return);
		}
		return view('admin.hall.index', ['title' => 'Hall', 'heading' => 'Hall']);
	}
	public function selectlocation(Request $request) {
		$hall = DB::table('location as loc')
			->select('ltrans.location_id', 'ltrans.location_name')
			->join('location_translation as ltrans', 'loc.location_id', '=', 'ltrans.location_id')
		//->where('ltrans.language_id', env('default_language'))->get();
			->where('ltrans.language_id', '=', 1)->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($hall);
		}

	}
	public function autouser(Request $request) {
		$param = Input::get('term');
		$query = DB::table('users');
		$query->select(DB::raw('CONCAT(first_name," ",last_name) as full_name'));
		//$query->orwhere(DB::raw('CONCAT(first_name," ",last_name)'), 'like', '%' . $param . '%');
		$query->orwhere('first_name', 'like', '%' . $param . '%');
		$query->orwhere('last_name', 'like', '%' . $param . '%');
		$return = $query->get();
		//return $return;
		$hall_tp_id = array();
		foreach ($return as $key => $val) {
			array_push($hall_tp_id, $val->full_name);
		}
		return $hall_tp_id;
	}
	public function selechalltype(Request $request) {
		$hall = DB::table('hall_type as loc')
			->select('ltrans.hall_type_id', 'ltrans.hall_type_name')
			->join('hall_type_translation as ltrans', 'loc.id', '=', 'ltrans.hall_type_id')
			->where('loc.is_active', '=', 1)
			->where('ltrans.language_id', env('default_language'))->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($hall);
		}
	}
	public function selectaddon(Request $request) {
		$hall = DB::table('addon as loc')
			->select('*')
			->join('addon_translation as ltrans', 'loc.id', '=', 'ltrans.addon_id')
			->where('loc.is_active', '=', 1)
			->where('ltrans.language_id', '=', 1)->get();
		//->where('ltrans.language_id', env('default_language'))->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($hall);
		}

	}
	public function selectaccommodation(Request $request) {
		$hall = DB::table('accommodation as loc')
			->select('*')
			->join('accommodation_translation as ltrans', 'loc.id', '=', 'ltrans.accommodation_id')
			->where('loc.is_active', '=', 1)
			->where('ltrans.language_id', '=', 1)->get();
		//->where('ltrans.language_id', env('default_language'))->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($hall);
		}
	}
	public function displayimages(Request $request) {
		$hall_id = Input::get('hall_id');
		$hall_images = DB::table('hallimages')
			->select('*')
			->where('hall_id', '=', $hall_id)
			->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($hall_images);
		}
	}
	public function deleteimage(Request $request) {
		$hall_id = Input::get('hall_id');
		$img_id = Input::get('img_id');
		$imgname = Input::get('imgname');
		DB::table('hallimages')->where('id', '=', $img_id)->delete();
		$file_path = public_path("uploads");
		//echo $file_path;
		/*if (File::exists($file_path)) {*/
		File::delete($file_path);
		/*}*/
		return response()->json(array('status' => 'success', 'hall_id' => $hall_id));
	}
	public function insrtaddon(Request $request) {
		$hall_id = Input::get('hall_id');
		$addon_id = Input::get('addon_id');
		$addon_price = Input::get('addon_price');
		DB::table('hall_addon_relation')->where('hall_id', '=', $hall_id)->delete();
		for ($cn = 0; $cn < count($addon_id); $cn++) {
			DB::table('hall_addon_relation')->insertGetId(
				['hall_id' => $hall_id, 'addon_id' => $addon_id[$cn], 'addon_price' => $addon_price[$cn]]
			);
		}
		return response()->json(array('status' => 'success', 'hall_id' => $hall_id));
	}
	public function insrtlocation(Request $request) {
		$hall_id = Input::get('hall_id');
		$lat = Input::get('lat');
		$lng = Input::get('lng');
		$g_address = Input::get('g_address');
		$data = DB::table('hall')
			->where('id', $hall_id)
			->update(array('lat' => $lat, 'lng' => $lng, 'g_address' => $g_address));
		return response()->json(array('status' => 'success', 'hall_id' => $hall_id));
	}
	public function insrtaccommodation(Request $request) {
		$hall_id = Input::get('hall_id');
		$accommodation_id = Input::get('accommodation_id');
		$accommodation_number = Input::get('accommodation_number');
		DB::table('hall_accommodation_relation')->where('hall_id', '=', $hall_id)->delete();
		for ($cn = 0; $cn < count($accommodation_id); $cn++) {
			DB::table('hall_accommodation_relation')->insertGetId(
				['hall_id' => $hall_id, 'accommodation_id' => $accommodation_id[$cn], 'accommodation_number' => $accommodation_number[$cn]]
			);
		}
		return response()->json(array('status' => 'success', 'hall_id' => $hall_id));
	}
	public function addonchecker(Request $request) {
		$hall_id = Input::get('hall_id');
		$hall_addon_relation = DB::table('hall_addon_relation')
			->select('*')
			->where('hall_id', '=', $hall_id)
			->get();
		//return json_encode($hall_addon_relation);
		return response()->json($hall_addon_relation);

	}
	public function accommodationchecker(Request $request) {
		$hall_id = Input::get('hall_id');
		$hall_accommodation_relation = DB::table('hall_accommodation_relation')
			->select('*')
			->where('hall_id', '=', $hall_id)
			->get();
		//return json_encode($hall_accommodation_relation);
		return response()->json($hall_accommodation_relation);
	}
	public function selectprovince(Request $request) {
		$province = DB::table('province')
			->select('*')->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($province);
		}
	}
	public function create() {
		//$language = Languagehelper::getlanguage();
		return view('admin.hall.hall', ['heading' => 'Add Hall', 'saveBtn' => 'Add', 'page_id' => '']);
	}
	public function selectuser(Request $request) {
		$user = DB::table('users')
			->select('id', 'email')
			->where('is_active', '=', 1)->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($user);
		}
	}

	public function show($id = '', Request $request) {
		//$language = Languagehelper::getlanguage();

		$query = DB::table('hall as htype');
		$query->select('htype.*', 'htrans.*', 'pr.id', 'pr.province_name');
		$query->join('hall_translation as htrans', 'htype.id', '=', 'htrans.hall_id');
		$query->join('province as pr', 'pr.id', '=', 'htrans.hall_province');
		$query->where('htrans.hall_id', $id);
		//$query->where('htrans.language_id', env('default_language'));
		$query->where('htrans.language_id', '=', 1);
		$return = $query->get();

		$query = DB::table('hall_type_relation');
		$query->select('hall_type_id');
		$query->where('hall_id', $id);
		$halltype = $query->get();
		$hall_tp_id = array();
		foreach ($halltype as $key => $val) {
			array_push($hall_tp_id, $val->hall_type_id);
		}
		foreach ($return as $key => $val) {
			$return[$key]->hall_type_checked = $halltype;
		}

		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($return);
		}

		return view('admin.hall.hall', ['title' => 'Update hall', 'heading' => 'Hall', 'saveBtn' => 'Save', 'page_id' => $id]);
	}

	public function store(Request $request) {

		if ($request->wantsJson() || $request->isJson()) {
			try {
				//echo '<pre>';
				//dd(Input::get('hall_type'));
				//echo '</pre>';
				//exit();
				/*$max_order = DB::table('hall_type')->where('order_id', DB::raw("(select max(`order_id`) from ev_hall_type)"))->get(); */
				$hallid = DB::table('hall')->insertGetId(
					['is_active' => $request->is_active, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
				);

				DB::table('hall_translation')->insert([
					['hall_id' => $hallid, 'language_id' => 1, 'user_id' => $request->user_id, 'location_id' => $request->location_id, 'official_name' => $request->official_name, 'contact_name' => $request->contact_name, 'contact_email' => $request->contact_email, 'contact_mobile' => $request->contact_mobile, 'hall_name' => $request->hall_name, 'hall_description' => $request->hall_description, 'hall_address' => $request->hall_address, 'hall_city' => $request->hall_city, 'hall_province' => $request->hall_province, 'hall_postcode' => $request->hall_postcode, 'hall_country' => $request->hall_country, 'rental_amount' => $request->rental_amount],
					['hall_id' => $hallid, 'language_id' => 2, 'user_id' => $request->user_id, 'location_id' => $request->location_id, 'official_name' => $request->official_name, 'contact_name' => $request->contact_name, 'contact_email' => $request->contact_email, 'contact_mobile' => $request->contact_mobile, 'hall_name' => $request->hall_name, 'hall_description' => $request->hall_description, 'hall_address' => $request->hall_address, 'hall_city' => $request->hall_city, 'hall_province' => $request->hall_province, 'hall_postcode' => $request->hall_postcode, 'hall_country' => $request->hall_country, 'rental_amount' => $request->rental_amount],
				]);
				for ($sn = 0; $sn < count(Input::get('hall_type')); $sn++) {
					DB::table('hall_type_relation')->insert([
						['hall_id' => $hallid, 'hall_type_id' => $request->hall_type[$sn]],
					]);
				}
				return response()->json(['status' => 'success', 'data' => $hallid]);
			} catch (\Illuminate\Database\QueryException $e) {
				return response()->json(['status' => 'error', 'code' => 500, 'data' => 'database error', 'message' => Lang::get('messages.query_exception'),
					'errorInfo' => $e->errorInfo[2]]);
			}
		}
	}
	public function fetch_user_data(Request $request) {
		$user_id = $request->user_id;
		$user = DB::table('users')
			->select('email', 'first_name', 'last_name', 'contact_number')
			->where('is_active', '=', 1)
			->where('id', '=', $user_id)->get();

		return response()->json($user);
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($user);
		}
	}
	public function update($id, Request $request) {
		//$hall_id = Input::get('hall_id');
		if ($request->wantsJson() || $request->isJson()) {
			try {
				$data = DB::table('hall_translation')
					->where('hall_id', $id)
					->where('language_id', 1)
					->update(array('user_id' => $request->user_id,
						'location_id' => $request->location_id,
						'official_name' => $request->official_name,
						'contact_name' => $request->contact_name,
						'contact_email' => $request->contact_email,
						'contact_mobile' => $request->contact_mobile,
						'hall_name' => $request->hall_name,
						'hall_description' => $request->hall_description,
						'hall_address' => $request->hall_address,
						'hall_city' => $request->hall_city,
						'hall_province' => $request->hall_province,
						'hall_postcode' => $request->hall_postcode,
						'hall_country' => $request->hall_country,
						'rental_amount' => $request->rental_amount,
						'is_active' => $request->is_active));
				DB::table('hall_type_relation')->where('hall_id', '=', $id)->delete();
				for ($sn = 0; $sn < count(Input::get('hall_type')); $sn++) {
					DB::table('hall_type_relation')->insert([
						['hall_id' => $id, 'hall_type_id' => $request->hall_type[$sn]],
					]);
				}
				return response()->json(['status' => 'success', 'data' => $id]);
			} catch (\Illuminate\Database\QueryException $e) {
				return response()->json(['status' => 'error', 'code' => 500, 'data' => 'database error', 'message' => Lang::get('messages.query_exception')]);
			}
		}
	}
	public function delete($id, Request $request) {
		if ($request->isJson() || $request->wantsJson()) {
			try {
				$query = DB::table('hall_translation');
				$findRow1 = $query->where('hall_id', $id)->get();
				//dd($findRow1);exit();
				foreach ($findRow1 as $row):
					DB::table('hall_translation')->where('hall_translation_id', $row->location_id)->delete();
				endforeach;

				$query = DB::table('hall');
				$delete2 = $query->where('id', $id)->delete();
				DB::table('hall_type_relation')->where('hall_id', '=', $id)->delete();
				DB::table('hall_addon_relation')->where('hall_id', '=', $id)->delete();
				DB::table('hall_accommodation_relation')->where('hall_id', '=', $id)->delete();
				return response()->json([
					'status' => 'success',
					'data' => $delete2,
				]);
			} catch (Exception $e) {
				return response()->json([
					'status' => 'error',
					'code' => 500,
					'data' => Lang::get('messages.response_error_db'),
					'message' => Lang::get('messages.query_exception'),
				]);
			}
		}
	}

	public function uploadimage($id, Request $request) {
		return view('admin.hall.images', ['title' => 'Update hall', 'heading' => 'Hall', 'saveBtn' => 'Add', 'page_id' => $id]);
	}
	public function setlocation($id, Request $request) {
		return view('admin.hall.location', ['title' => 'Update hall', 'heading' => 'Hall', 'saveBtn' => 'Add', 'page_id' => $id]);
	}
	public function addon($id) {
		return view('admin.hall.addon', ['title' => 'Update hall', 'heading' => 'Hall', 'saveBtn' => 'Add', 'page_id' => $id]);
	}
	public function accommodation($id) {
		return view('admin.hall.accommodation', ['title' => 'Update hall', 'heading' => 'Hall', 'saveBtn' => 'Add', 'page_id' => $id]);
	}
	public function subscription($id) {
		return view('admin.hall.subscription', ['title' => 'Update hall', 'heading' => 'Hall', 'saveBtn' => 'Add', 'page_id' => $id]);
	}
	public function multipleimage(Request $request) {
		$files = Input::file('images');
		$file_count = count($files);
		// start count how many uploaded
		$uploadcount = 0;
		foreach ($files as $file) {
			$rules = array('file' => 'required|mimes:png,gif,jpeg'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
			$validator = Validator::make(array('file' => $file), $rules);
			if ($validator->passes()) {
				$destinationPath = 'public/uploads';
				$filename = $file->getClientOriginalName();
				$upload_success = $file->move($destinationPath, $filename);
				DB::table('hallimages')->insertGetId(
					['hall_id' => $request->page_id, 'hall_image' => $filename, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
				);
				$uploadcount++;
			}
		}
		if ($uploadcount == $file_count) {
			/*return view('admin.hall.images', ['title' => 'Update hall', 'heading' => 'Hall', 'saveBtn' => 'Add', 'page_id' => $request->page_id]);*/
			return redirect('admin/hall/set-location/' . $request->page_id);
		} else {
			return redirect('admin/hall/uploadimage/' . $request->page_id)->withInput()->withErrors($validator);
		}
	}
}
