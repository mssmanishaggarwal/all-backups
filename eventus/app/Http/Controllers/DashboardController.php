<?php

namespace App\Http\Controllers;
use App\Helper\Languagehelper;
use App\Models\Common;
use App\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;

class DashboardController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function languageSetter(Request $request) {
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
		$request->session()->forget('breadcrumb');
		return $data;
	}

	public function index(Request $request) {
		$data = $this->languageSetter($request);
		return view('dashboard.index', ['data' => $data]);
	}

	public function details($id, Request $request) {
		$request->session()->put('hall_id', $id);
		return redirect('dashboard/add-my-hall');
	}
	public function photos($id, Request $request) {
		$request->session()->put('hall_id', $id);
		return redirect('dashboard/hall/uploadimage');
	}
	public function addons($id, Request $request) {
		$request->session()->put('hall_id', $id);
		return redirect('dashboard/hall/addon');
	}
	public function accommodations($id, Request $request) {
		$request->session()->put('hall_id', $id);
		return redirect('dashboard/hall/accommodation');
	}
	public function subscription($id, Request $request) {
		$request->session()->put('hall_id', $id);
		return redirect('dashboard/hall/subscription');
	}
	public function calender($id, Request $request) {
		$request->session()->put('hall_id', $id);
		return redirect('dashboard/hall/calender');
	}

	public function editProfile(Request $request) {
		$data = $this->languageSetter($request);
		$data['locationList'] = Common::getLocation($data['language_val']);
		$data['getprovince'] = Common::getProvince();

		return view('dashboard.editprofile', ['data' => $data]);
	}

	public function profilePicture(Request $request) {
		$files = Input::file('file');
		extract($_POST);
		//dd($_FILES["file"]);
		$error = array();
		$extension = array("jpeg", "jpg", "png", "gif");
		$file_name = $_FILES["file"]["name"];
		$file_tmp = $_FILES["file"]["tmp_name"];
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		if (in_array($ext, $extension)) {
			if (Auth::user()->profile_image) {
				unlink("public/uploads/user/" . Auth::user()->profile_image);
			}
			if (!file_exists("public/uploads/user/" . $file_name)) {
				move_uploaded_file($file_tmp = $_FILES["file"]["tmp_name"], "public/uploads/user/" . $file_name);
				DB::table('users')
					->where('id', '=', Auth::user()->id)
					->update(
						['profile_image' => $file_name]
					);
			} else {
				$filename = basename($file_name, $ext);
				$newFileName = $filename . time() . "." . $ext;
				move_uploaded_file($file_tmp = $_FILES["file"]["tmp_name"], "public/uploads/user/" . $newFileName);
				DB::table('users')
					->where('id', '=', Auth::user()->id)
					->update(
						['profile_image' => $newFileName]
					);
			}
			//return redirect('dashboard/hall/uploadimage')->with('success', 'You have uploaded images.');
		} else {
			array_push($error, "$file_name, ");
			/*return redirect('dashboard/hall/uploadimage')->with('fails', 'This File ' . $file_name . ' Not Acceptable');*/
		}
	}

	public function updateProfile(Request $request) {
		/*=================================================*/

		$this->validate($request, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'address' => 'required|max:1055',
			'city' => 'required|max:255',
			'state' => 'required|max:255',
		]);

		//exit();
		/*=================================================*/
		$user_update = User::findOrFail(Auth::user()->id);
		$user_update->update($request->all());

		$data = $this->languageSetter($request);
		$data['locationList'] = Common::getLocation($data['language_val']);
		$data['getprovince'] = Common::getProvince();
		$data['msg'] = 'Profile Updated!';
		/* SET DEFAULT LANGUAGE END */

		//return view('dashboard.editprofile', ['data' => $data]);
		return json_encode(array('success' => 'Your profile has been updated successfully.'));
		//return redirect('dashboard/edit-profile')->with('status', 'Profile updated!');
	}
	public function changePassword(Request $request) {
		$data = $this->languageSetter($request);
		/* SET DEFAULT LANGUAGE END */
		//$data['reg_email'] = $request->session()->get('reg_email');
		return view('dashboard.changepassword', ['data' => $data]);
	}

	public function updatePassword(Request $request) {
		$this->validate($request, [
			'password' => 'required|min:6',
			'newPassword' => 'required|min:6',
		]);
		$user = User::findOrFail(Auth::user()->id);
		if (Hash::check($request->password, Auth::user()->password)) {
			$user->fill([
				'password' => Hash::make($request->newPassword),
			])->save();
			//return redirect('dashboard/change-password')->with('status', 'Password updated!');
			return json_encode(array('success' => 'true'));
		} else {
			//return redirect('dashboard/change-password')->with('fails', 'Old Password does not matched!');
			return json_encode(array('password' => 'Old Password does not matched!'));
		}

	}
	public function editRedirects($id, Request $request) {
		//echo $val;
		//echo $id;
		$request->session()->put('hall_id', $id);
		/*if ($val == 'details') {*/
		return redirect('dashboard/add-my-hall');
		/*}*/
		//exit();
	}
	public function editPhotos($id, Request $request) {
		$request->session()->put('hall_id', $id);
		return redirect('dashboard/hall/uploadimage');
	}

	public function myHall(Request $request) {
		$request->session()->forget('hall_id');
		$data = $this->languageSetter($request);
		$query = DB::table('hall as hl');
		$query->select('htrans.hall_name', 'hl.id', 'loc.location_name', 'prov.province_name','hsr.subscription_name', 'hsr.start_date', 'hsr.expiry_date');
		$query->leftJoin('hall_translation as htrans', 'hl.id', '=', 'htrans.hall_id');
		$query->leftJoin('location_translation as loc', 'loc.location_id', '=', 'hl.location_id');
		$query->leftJoin('province as prov', 'prov.id', '=', 'hl.hall_province');
		$query->leftJoin(DB::RAW('(select * from ev_hall_subscription_relation as ev_subrel where ev_subrel.start_date <= CURDATE() AND ev_subrel.expiry_date >= CURDATE() group by ev_subrel.hall_id) ev_hsr'), 'hsr.hall_id', '=', 'hl.id');
		$query->where('loc.language_id', '=', $data['language_val']);
		$query->where('htrans.language_id', '=', 1);
		$query->where('hl.user_id', '=', Auth::user()->id);
		//->where('htrans.language_id', env('default_language'))
		$query->orderBy('hl.created_at', 'desc');
		$return = $query->get();
		foreach ($return as $key => $value) {
			$return[$key]->hall_type = Common::hallTypeForMyHall($value->id, $data['language_val']);
			$return[$key]->addon = Common::hallTypeForMyAddon($value->id, $data['language_val']);
			$return[$key]->accommodation = Common::hallTypeForMyAccommodation($value->id, $data['language_val']);
		}
		//dd($return);
		//exit();
		$data['hall_details'] = $return;
		return view('dashboard.myhall', ['data' => $data]);
	}

	public function deleteHall($id, Request $request) {
		$image_data = Common::hallImage($id);
		//dd($image_data);
		foreach ($image_data as $key => $value) {
			unlink("public/uploads/hall/" . $value);
			unlink("public/uploads/hall/135x94/" . $value);
			unlink("public/uploads/hall/275x275/" . $value);
			unlink("public/uploads/hall/390x260/" . $value);
			unlink("public/uploads/hall/855x408/" . $value);
		}
		//exit();
		DB::table('hall')
			->where('user_id', '=', Auth::user()->id)
			->where('id', '=', $id)
			->delete();
		return redirect('dashboard/my-hall')->with('status', 'You have deleted a hall successfully.');
	}

	public function addMyHall(Request $request) {

		$data = $this->languageSetter($request);
		$data['halltype'] = Common::getHalltype($data['language_val']);
		$data['facilitiesList'] = Common::getfacilitiesList($data['language_val']);
		$data['locationList'] = Common::getLocation($data['language_val']);
		$data['getprovince'] = Common::getProvince();
		$past_hall_id = $request->session()->get('hall_id');
		if (!isset($past_hall_id)) {
			$data['hall_fac_selected'] = array();
			return view('dashboard.hall.addmyhall', ['data' => $data]);
		} else {
			$hall_type = DB::table('hall_type_relation');
			$hall_type->select('hall_type_id');
			$hall_type->where('hall_id', '=', $past_hall_id);
			$rt = $hall_type->get();
			
			$hall_fac_types = DB::table('hall_facilities_relation as hall_fac')
				->select('*')
				->where('hall_fac.hall_id', $past_hall_id)
				->get();
			$hall_fac_selected = array();
			foreach ($hall_fac_types as $hall_fac_type) {
				$hall_fac_selected[] = $hall_fac_type->facilities_id;
			}

			//$halltype = implode(',', $rt);
			//echo $halltype;
			$query = DB::table('hall as hl');
			$query->select('htrans.*', 'hl.*');
			$query->leftJoin('hall_translation as htrans', 'hl.id', '=', 'htrans.hall_id');
			//$query->leftJoin('hall_type_relation as htr', 'hl.id', '=', GROUP_CONCAT('htr.hall_id'));
			$query->where('hl.id', '=', $past_hall_id);
			$query->where('htrans.language_id', '=', $data['language_val']);
			//->where('htrans.language_id', env('default_language'))
			$query->orderBy('hl.id');
			$return = $query->get();
			$data['hall_details'] = $return;
			/*$arra=array();
				foreach ($return as $key => $value) {
					array_push($arra[0],$value->hall_type_id)
			*/
			//dd($rt);
			//exit();
			$data['fetched_hall_type'] = $rt;
			if( isset($hall_fac_selected) && !empty($hall_fac_selected) ) {
				$data['hall_fac_selected'] = $hall_fac_selected;
			} else {
				$data['hall_fac_selected'] = array();
			}
			return view('dashboard.hall.addmyhall', ['data' => $data])->with('status', 'You have updated this Hall!');
		}
	}

	/*public function validate(Request $request, array $rules, array $messages = array()) {
			$validator = $this->getValidationFactory()->make($request->all(), $rules, $messages);

			if ($validator->fails()) {
				$this->throwValidationException($request, $validator);
			}
		}
			http://stackoverflow.com/questions/28884287/laravel-5-how-to-insert-error-custom-messages-array-inside-validate
	*/

	public function addMyHallValidate(Request $request) {
		$messages = [
			'hall_name.required' => 'Hall name is required!',
			'hall_type.required' => 'Atleat One hall Type should be chosen!',
			'hall_address.required' => 'Hall address is required!',
			'contact_email.required' => 'Contact email is required!',
			'contact_mobile.required' => 'Contact mobile is required!',
			'lat.required' => 'Latitude is required!',
			'lng.required' => 'Longitude is required',
			'hall_description.required' => 'Hall description is required',
			'location_id.required' => 'Hall location is required',
			'rental_amount.required' => 'Hall rental amount is required',
		];
		$this->validate($request, [
			'hall_name' => 'required|max:255',
			'hall_type' => 'required|max:255',
			'hall_address' => 'required|max:255',
			'contact_email' => 'required|max:255',
			'contact_mobile' => 'required|max:15|min:10',
			'lat' => 'required|max:255',
			'lng' => 'required|max:255',
			'hall_description' => 'required|max:1055',
			'location_id' => 'required|max:255',
			'hall_province' => 'required|max:255',
			'rental_amount' => 'required|max:255',
		], $messages);
		//exit();
		return $this->hallInsert($request);
	}

	public function hallInsert(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		if (!isset($past_hall_id)) {
			$hallid = DB::table('hall')->insertGetId(
				['is_active' => 1, 'user_id' => Auth::user()->id, 'location_id' => $request->location_id, 'contact_email' => $request->contact_email, 'contact_mobile' => $request->contact_mobile,
					'lat' => $request->lat, 'lng' => $request->lng, 'g_address' => $request->g_address, 'hall_province' => $request->hall_province, 'hall_postcode' => $request->hall_postcode, 'rental_amount' => $request->rental_amount, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
			);
			DB::table('hall_translation')->insert([
				['hall_id' => $hallid, 'language_id' => 1, 'official_name' => $request->official_name, 'contact_name' => $request->contact_name, 'hall_name' => $request->hall_name, 'hall_description' => $request->hall_description, 'hall_address' => $request->hall_address],
				['hall_id' => $hallid, 'language_id' => 2, 'official_name' => $request->official_name, 'contact_name' => $request->contact_name, 'hall_name' => $request->hall_name, 'hall_description' => $request->hall_description, 'hall_address' => $request->hall_address],
			]);
			for ($sn = 0; $sn < count(Input::get('hall_type')); $sn++) {
				DB::table('hall_type_relation')->insert([
					['hall_id' => $hallid, 'hall_type_id' => $request->hall_type[$sn]],
				]);
			}
			for ($sn = 0; $sn < count(Input::get('facilities')); $sn++) {
				DB::table('hall_facilities_relation')->insert([
					['hall_id' => $past_hall_id, 'facilities_id' => $request->facilities[$sn]],
				]);
			}
			$data = $this->languageSetter($request);
			$request->session()->put('hall_id', $hallid);

			// Email section start //
			$username = Auth::user()->first_name;
			$location_name = Common::getData('location_translation', 'location_name', 'location_id', $request->location_id, $data['language_val']);
			$province_name = Common::getData('province', 'province_name', 'id', $request->hall_province, '');
			$emailTemplate = Common::getEmaildata(4, $data['language_val']);
			$data['email_subject'] = $emailTemplate->email_subject;
			$headerText = $emailTemplate->email_body;
			$headerText = str_replace('[USERNAME]', $username, $headerText);
			$headerText = str_replace('[HALL_NAME]', $request->hall_name, $headerText);
			$headerText = str_replace('[LOCATION]', $location_name, $headerText);
			$headerText = str_replace('[PROVINCE]', $province_name, $headerText);
			$headerText = str_replace('[RENTALAMOUNT]', $request->rental_amount . ' AOA', $headerText);

			$data['body'] = $headerText;

			Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
				$fromEmail = Common::getSettingdata(2);
				$message->from($fromEmail, 'Eventus Angola');
				$message->to(Auth::user()->email)->subject($data['email_subject']);
			});
			// Email section end //

			return redirect('dashboard/add-my-hall')->with('status', 'You Have Added a Hall!');
		} else {
			DB::table('hall')
				->where('id', $past_hall_id)
				->update(array(
					'location_id' => $request->location_id, 'contact_email' => $request->contact_email, 'contact_mobile' => $request->contact_mobile,
					'lat' => $request->lat, 'lng' => $request->lng, 'g_address' => $request->g_address, 'hall_province' => $request->hall_province, 'hall_postcode' => $request->hall_postcode, 'rental_amount' => $request->rental_amount, 'updated_at' => date('Y-m-d H:i:s'),
				));
			DB::table('hall_translation')
				->where('hall_id', $past_hall_id)
				->where('language_id', 1)
				->update(array(
					'hall_id' => $past_hall_id, 'official_name' => $request->official_name, 'contact_name' => $request->contact_name, 'hall_name' => $request->hall_name, 'hall_description' => $request->hall_description, 'hall_address' => $request->hall_address,
				)
				);
			DB::table('hall_translation')
				->where('hall_id', $past_hall_id)
				->where('language_id', 2)
				->update(array(
					'hall_id' => $past_hall_id, 'official_name' => $request->official_name, 'contact_name' => $request->contact_name, 'hall_name' => $request->hall_name, 'hall_description' => $request->hall_description, 'hall_address' => $request->hall_address,
				)
				);
			DB::table('hall_type_relation')->where('hall_id', '=', $past_hall_id)->delete();
			for ($sn = 0; $sn < count(Input::get('hall_type')); $sn++) {
				DB::table('hall_type_relation')->insert([
					['hall_id' => $past_hall_id, 'hall_type_id' => $request->hall_type[$sn]],
				]);
			}
			DB::table('hall_facilities_relation')->where('hall_id', '=', $past_hall_id)->delete();
			for ($sn = 0; $sn < count(Input::get('facilities')); $sn++) {
				DB::table('hall_facilities_relation')->insert([
					['hall_id' => $past_hall_id, 'facilities_id' => $request->facilities[$sn]],
				]);
			}
			return redirect('dashboard/add-my-hall')->with('status', 'You have updated this Hall!');
		}
	}
	public function uploadImages(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$images = DB::table('hallimages')
			->select('*')
			->where('hall_id', '=', $past_hall_id)
			->orderBy('image_order', 'asc')
			->get();
		$data = $this->languageSetter($request);
		$data['fetched_images'] = $images;
		return view('dashboard.hall.uploadimages', ['data' => $data]);
	}
	public function sortImageOrder(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$image_order_ids = Input::get('post_variable');
		foreach ($image_order_ids as $sort => $row_id) {
			if ($sort == 0) {
				continue;
			} else {
				DB::table('hallimages')
					->where('id', $row_id)
					->update(array(
						'image_order' => $sort,
						'updated_at' => date('Y-m-d H:i:s'),
					)
					);
			}
		}
		return json_encode(array('status' => 'success'));

	}
	public function multipleimage(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$files = Input::file('images');
		//print_r($files);
		//exit();
		$file_count = count($files);
		$image_order = DB::table('hallimages')
			->where('hall_id', '=', $past_hall_id)
			->max('image_order');
		$uploadcount = 0;

		extract($_POST);
		//dd($_FILES["images"]);
		//exit();
		$error = array();
		$extension = array("jpeg", "jpg", "png", "gif");
		$make_order = $image_order + 1;
		foreach ($_FILES["images"]["tmp_name"] as $key => $tmp_name) {
			$file_name = $_FILES["images"]["name"][$key];
			$file_tmp = $_FILES["images"]["tmp_name"][$key];
			$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			//print_r($ext);
			//exit();
			if (in_array($ext, $extension)) {
				if (!file_exists("public/uploads/hall/" . $file_name)) {
					move_uploaded_file($file_tmp = $_FILES["images"]["tmp_name"][$key], "public/uploads/hall/" . $file_name);
					$this->createThumbnail($ext, "public/uploads/hall/135x94/", $file_name, 135, 94, "public/uploads/hall/" . $file_name);
					$this->createThumbnail($ext, "public/uploads/hall/275x275/", $file_name, 275, 275, "public/uploads/hall/" . $file_name);
					$this->createThumbnail($ext, "public/uploads/hall/390x260/", $file_name, 390, 260, "public/uploads/hall/" . $file_name);
					$this->createThumbnail($ext, "public/uploads/hall/855x408/", $file_name, 855, 408, "public/uploads/hall/" . $file_name);
					DB::table('hallimages')->insertGetId(
						['hall_id' => $past_hall_id, 'image_order' => $make_order, 'hall_image' => $file_name, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
					);
				} else {
					$filename = basename($file_name, $ext);
					$newFileName = $filename . time() . "." . $ext;
					move_uploaded_file($file_tmp = $_FILES["images"]["tmp_name"][$key], "public/uploads/hall/" . $newFileName);
					$this->createThumbnail($ext, "public/uploads/hall/135x94/", $newFileName, 135, 94, "public/uploads/hall/" . $newFileName);
					$this->createThumbnail($ext, "public/uploads/hall/275x275/", $newFileName, 275, 275, "public/uploads/hall/" . $newFileName);
					$this->createThumbnail($ext, "public/uploads/hall/390x260/", $newFileName, 390, 260, "public/uploads/hall/" . $newFileName);
					$this->createThumbnail($ext, "public/uploads/hall/855x408/", $newFileName, 855, 408, "public/uploads/hall/" . $newFileName);
					DB::table('hallimages')->insertGetId(
						['hall_id' => $past_hall_id, 'image_order' => $make_order, 'hall_image' => $newFileName, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
					);
				}
				//return redirect('dashboard/hall/uploadimage')->with('success', 'You have uploaded images.');
			} else {
				array_push($error, "$file_name, ");
				/*return redirect('dashboard/hall/uploadimage')->with('fails', 'This File ' . $file_name . ' Not Acceptable');*/
				return json_encode(array('err' => 'Uploaded Successfully.'));
			}
			$make_order++;
		}
		return json_encode(array('success' => 'Uploaded Successfully.'));
		//return redirect('dashboard/hall/uploadimage')->with('success', 'You have uploaded images.');
	}

	public function createThumbnail($file_ext, $thumb_path, $fileName, $thumb_width, $thumb_height, $upload_image) {
		$thumbnail = $thumb_path . $fileName;
		list($width, $height) = getimagesize($upload_image);
		$thumb_create = imagecreatetruecolor($thumb_width, $thumb_height);
		switch ($file_ext) {
		case 'jpg':
			$source = imagecreatefromjpeg($upload_image);
			break;
		case 'jpeg':
			$source = imagecreatefromjpeg($upload_image);
			break;

		case 'png':
			$source = imagecreatefrompng($upload_image);
			break;
		case 'gif':
			$source = imagecreatefromgif($upload_image);
			break;
		default:
			$source = imagecreatefromjpeg($upload_image);
		}

		imagecopyresized($thumb_create, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
		switch ($file_ext) {
		case 'jpg' || 'jpeg':
			imagejpeg($thumb_create, $thumbnail, 100);
			break;
		case 'png':
			imagepng($thumb_create, $thumbnail, 100);
			break;

		case 'gif':
			imagegif($thumb_create, $thumbnail, 100);
			break;
		default:
			imagejpeg($thumb_create, $thumbnail, 100);
		}
	}

	public function appendingImages(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$query = DB::select(DB::raw("SELECT * FROM `ev_hallimages` WHERE `hall_id`='" . $past_hall_id . "'
			AND `image_order`>'" . $request->image_order . "'"));
		return $query;
	}

	public function captionImage(Request $request) {
		$update_id = Input::get('update_id');
		$content = Input::get('content');
		DB::table('hallimages')
			->where('id', $update_id)
			->update(array(
				'hall_image_caption' => $content,
				'updated_at' => date('Y-m-d H:i:s'),
			)
			);
	}
	public function deleteImage(Request $request) {
		$id = Input::get('id');
		DB::table('hallimages')->where('id', '=', $id)->delete();
		unlink("public/uploads/hall/" . $request->image_name);
		unlink("public/uploads/hall/135x94/" . $request->image_name);
		unlink("public/uploads/hall/275x275/" . $request->image_name);
		unlink("public/uploads/hall/390x260/" . $request->image_name);
		unlink("public/uploads/hall/855x408/" . $request->image_name);
		return json_encode(array('status' => 'success'));
	}
	public function hallAddon(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		//echo $past_hall_id;
		$data = $this->languageSetter($request);
		$data['display_addon'] = Common::selectaddon($data['language_val']);
		return view('dashboard.hall.halladdon', ['data' => $data]);
	}
	public function addonchecker(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$hall_addon_relation = DB::table('hall_addon_relation')
			->select('*')
			->where('hall_id', '=', $past_hall_id)
			->get();
		//return json_encode($hall_addon_relation);
		return response()->json($hall_addon_relation);

	}
	public function insrtaddon(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$addon_id = Input::get('addon_id');
		$addon_price = Input::get('addon_price');
		DB::table('hall_addon_relation')->where('hall_id', '=', $past_hall_id)->delete();
		for ($cn = 0; $cn < count($addon_id); $cn++) {
			DB::table('hall_addon_relation')->insertGetId(
				['hall_id' => $past_hall_id, 'addon_id' => $addon_id[$cn], 'addon_price' => $addon_price[$cn]]
			);
		}
		return response()->json(array('status' => 'success'));
	}
	public function hallAccommodation(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$data = $this->languageSetter($request);
		$data['display_accomn'] = Common::selectaccommodation($data['language_val']);
		return view('dashboard.hall.accommodation', ['data' => $data]);
	}
	public function accommodationchecker(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$hall_accommodation_relation = DB::table('hall_accommodation_relation')
			->select('*')
			->where('hall_id', '=', $past_hall_id)
			->get();
		//return json_encode($hall_accommodation_relation);
		return response()->json($hall_accommodation_relation);
	}
	public function insrtaccommodation(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$accommodation_id = Input::get('accommodation_id');
		$accommodation_number = Input::get('accommodation_number');
		DB::table('hall_accommodation_relation')->where('hall_id', '=', $past_hall_id)->delete();
		for ($cn = 0; $cn < count($accommodation_id); $cn++) {
			DB::table('hall_accommodation_relation')->insertGetId(
				['hall_id' => $past_hall_id, 'accommodation_id' => $accommodation_id[$cn], 'accommodation_number' => $accommodation_number[$cn]]
			);
		}
		return response()->json(array('status' => 'success'));
	}
	public function hallSubscription(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$data = $this->languageSetter($request);
		$data['subscription'] = Common::fetchSubscription($data['language_val']);
		$data['featured'] = Common::fetchSubscriptionFeatured($data['language_val']);
		$data['subscription_notification'] = Common::fetchsubScriptionStatus($data['language_val'], $past_hall_id);
		$data['feature_notification'] = Common::fetchsubFeaturedStatus($data['language_val'], $past_hall_id);
		$data['hall_id'] = $request->session()->get('hall_id');
		return view('dashboard.hall.subscription', ['data' => $data]);
	}
	public function hallSubscriptionPayment(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$request->session()->put('hall_id', $past_hall_id);
		$hall_name = Common::hallName($past_hall_id);
		$payment_number = uniqid();
		$request->session()->put('payment_number', $payment_number);
		//	exit();
		if ($request->subscription_id != '') {
			$date_available = Common::checkSubExpiry($past_hall_id);
			//dd($date_available);
			//exit();
			$start_date;
			if ($date_available == 'notfound') {
				$start_date = date('Y-m-d');
			} else {
				$start_date = date("Y-m-d", strtotime("1 day", strtotime($date_available)));
			}
			$subscription_id = DB::table('hall_subscription_relation')->insertGetId(
				['hall_id' => $past_hall_id,
					'subscription_id' => $request->subscription_id,
					'subscription_name' => $request->subscription_name,
					'subscription_price' => $request->subscription_price,
					'subscription_month' => $request->subscription_month,
					'payment_date' => date('Y-m-d H:i:s'),
					'start_date' => $start_date,
					'expiry_date' => date("Y-m-d", strtotime("$request->subscription_month months", strtotime($start_date))),
				]
			);
			$payment_id = DB::table('payments')->insertGetId(
				[
					'payment_number' => $payment_number,
					'payment_date' => date('Y-m-d H:i:s'),
					'payment_amount' => $request->subscription_price,
					'payment_for' => 'S',
					'payment_for_id' => $subscription_id,
					'payment_by_id' => Auth::user()->id]
			);
			//exit();
			$request->session()->put('subscription_price', $request->subscription_price);
			$request->session()->put('subscription_name', $request->subscription_name);
			$request->session()->put('subscription_month', $request->subscription_month);
			$request->session()->put('subscription_id', $subscription_id);
			$request->session()->put('payment_id', $payment_id);
		}
		if ($request->featured_id != '') {
			$date_available = Common::checkSubExpiryFeature($past_hall_id);
			//dd($date_available);
			//exit();
			$start_date;
			if ($date_available == 'notfound') {
				$start_date = date('Y-m-d');
			} else {
				$start_date = date("Y-m-d", strtotime("1 day", strtotime($date_available)));
			}
			$feature_id = DB::table('hall_subscription_feature_relation')->insertGetId(
				['hall_id' => $past_hall_id,
					'feature_id' => $request->featured_id,
					'feature_name' => $request->featured_name,
					'feature_price' => $request->featured_price,
					'feature_month' => $request->featured_month,
					'payment_date' => date('Y-m-d H:i:s'),
					'start_date' => $start_date,
					'expiry_date' => date("Y-m-d", strtotime("$request->featured_month months", strtotime($start_date))),
				]
			);
			$payment_id = DB::table('payments')->insertGetId(
				[
					'payment_number' => $payment_number,
					'payment_date' => date('Y-m-d H:i:s'),
					'payment_amount' => $request->featured_price,
					'payment_for' => 'F',
					'payment_for_id' => $feature_id,
					'payment_by_id' => Auth::user()->id]
			);
			$request->session()->put('feature_id', $feature_id);
			$request->session()->put('feature_name', $request->featured_name);
			$request->session()->put('feature_month', $request->featured_month);
			$request->session()->put('feature_price', $request->featured_price);
			$request->session()->put('payment_id', $payment_id);
		}

		$paypal = '<script>$(function() {$("#ppl").submit();});</script><form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="ppl">
			<input type="hidden" name="cmd" value="_xclick" />
			<input type="hidden" name="business" value="citytech.tester@gmail.com" />
			<input type="hidden" name="currency_code" value="EUR" />
			<input type="hidden" name="no_shipping" value="10" />
			<input type="hidden" name="no_note" value="20" />
			<input type="hidden" name="item_name" value="' . $hall_name[0] . '" />
			<input type="hidden" name="item_number" value="' . $past_hall_id . '" />
			<input type="hidden" name="custom" value="18" />
			<input type="hidden" name="rm" value="2" />
			<input type="hidden" name="lc" value="AO" />
			<input type="hidden" name="return" value="' . url('/dashboard/hall/subscription/thank-you') . '" />
			<input type="hidden" name="notify_url" value="" />
			<input type="hidden" name="cancel_url" value="' . url('/dashboard/hall/subscription/cancel-payment') . '" />
			<input type="hidden" name="quantity" value="1" />
			<input type="hidden" name="amount" value="' . ($request->featured_price + $request->subscription_price) . '" /></form>';

		//echo 'success';
		return json_encode(array('success' => 'Redirecting to paypal', 'form_data' => $paypal));
	}
	public function hallSubscriptionThankYou(Request $request) {
		error_reporting(0);
		
		$past_hall_id = $request->session()->get('hall_id');
		$data = $this->languageSetter($request);

		$payment_status = '';
		$sub_payment_status = 0;
		switch ($request->payment_status) {
		case 'Failed':
			$payment_status = 'F';			
			break;
		case 'Completed':
			$payment_status = 'S';
			$sub_payment_status = 1;
			break;
		default:
			$payment_status = 'P';
			$sub_payment_status = 1;
			break;
		}

		if ($request->session()->has('feature_id')) {
			DB::table('payments')
				->where('payment_id', '=', $request->session()->get('payment_id'))
				->update(
					[
						'transaction_id' => $request->txn_id,
						'payment_date' => date('Y-m-d H:i:s'),
						'payment_status' => $payment_status]
				);

			DB::table('hall_subscription_feature_relation')
				->where('id', '=', $request->session()->get('feature_id'))
				->update(

					['payment_status' => $sub_payment_status, 'payment_date' => date('Y-m-d H:i:s')]
				);
			// Email section start //
			$username = Auth::user()->first_name;
			$data['featured_notification'] = Common::fetchsubScriptionFeatureStatusByID($data['language_val'], $request->session()->get('feature_id'));
			$expiry_date = date("d/m/Y", strtotime($request->session()->get('feature_month') . " months", strtotime($data['featured_notification'][0]->payment_date)));
			$emailTemplate = Common::getEmaildata(8, $data['language_val']);
			$data['email_subject'] = $emailTemplate->email_subject;
			$headerText = $emailTemplate->email_body;
			$headerText = str_replace('[USERNAME]', $username, $headerText);
			$headerText = str_replace('[PAYMENT_NUMBER]', $request->session()->get('payment_number'), $headerText);
			$headerText = str_replace('[HALL_NAME]', $request->item_name, $headerText);
			$headerText = str_replace('[FEATURED_NAME]', $request->session()->get('feature_name'), $headerText);
			$headerText = str_replace('[FEATURED_PRICE]', $request->session()->get('feature_price') . 'AOA', $headerText);
			$headerText = str_replace('[FEATURED_MONTH]', $request->session()->get('feature_month'), $headerText);
			$headerText = str_replace('[FEATURED_DATE]', date("d/m/Y"), $headerText);
			$headerText = str_replace('[FEATURED_EXPIRY]', $expiry_date, $headerText);

			$data['body'] = $headerText;

			Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
				$fromEmail = Common::getSettingdata(2);
				$message->from($fromEmail, 'Eventus Angola');
				$message->to(Auth::user()->email)->subject($data['email_subject']);
			});
			// Email section end //

		}
		if ($request->session()->has('subscription_id')) {
			DB::table('payments')
				->where('payment_id', '=', $request->session()->get('payment_id'))
				->update(
					[
						'transaction_id' => $request->txn_id,
						'payment_date' => date('Y-m-d H:i:s'),
						'payment_status' => $payment_status]
				);
			DB::table('hall_subscription_relation')
				->where('id', '=', $request->session()->get('subscription_id'))
				->update(
					['payment_status' => $sub_payment_status, 'payment_date' => date('Y-m-d H:i:s')]
				);
			// Email section start //
			$username = Auth::user()->first_name;
			$data['subscription_notification'] = Common::fetchsubScriptionStatusByID($data['language_val'], $request->session()->get('subscription_id'));
			$expiry_date = date("d/m/Y", strtotime($request->session()->get('subscription_month') . " months", strtotime($data['subscription_notification'][0]->payment_date)));
			$emailTemplate = Common::getEmaildata(5, $data['language_val']);
			$data['email_subject'] = $emailTemplate->email_subject;
			$headerText = $emailTemplate->email_body;
			$headerText = str_replace('[USERNAME]', $username, $headerText);
			$headerText = str_replace('[PAYMENT_NUMBER]', $request->session()->get('payment_number'), $headerText);
			$headerText = str_replace('[HALL_NAME]', $request->item_name, $headerText);
			$headerText = str_replace('[SUBSCRIPTION_NAME]', $request->session()->get('subscription_name'), $headerText);
			$headerText = str_replace('[SUBSCRIPTION_PRICE]', $request->session()->get('subscription_price') . 'AOA', $headerText);
			$headerText = str_replace('[SUBSCRIPTION_MONTH]', $request->session()->get('subscription_month'), $headerText);
			$headerText = str_replace('[SUBSCRIPTION_DATE]', date("d/m/Y"), $headerText);
			$headerText = str_replace('[SUBSCRIPTION_EXPIRY]', $expiry_date, $headerText);

			$data['body'] = $headerText;

			Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
				$fromEmail = Common::getSettingdata(2);
				$message->from($fromEmail, 'Eventus Angola');
				$message->to(Auth::user()->email)->subject($data['email_subject']);
			});
			// Email section end //
		}
		$request->session()->forget('payment_id');
		$request->session()->forget('payment_number');
		$request->session()->forget('subscription_price');
		$request->session()->forget('subscription_name');
		$request->session()->forget('subscription_month');
		$request->session()->forget('subscription_id');
		$request->session()->forget('feature_id');
		$request->session()->forget('feature_name');
		$request->session()->forget('feature_month');
		$request->session()->forget('feature_price');

		return view('dashboard.hall.paymentsuccess', ['data' => $data]);
	}
	public function hallSubscriptionCancelPayment() {
		$data = $this->languageSetter($request);
		return view('dashboard.hall.cancelpayment', ['data' => $data]);
	}
	public function myFavourite(Request $request) {
		$data = $this->languageSetter($request);
		$data['my_favourite'] = Common::myFavourite($data['language_val']);
		foreach ($data['my_favourite'] as $key => $val) {
			$data['my_favourite'][$key]->hall_url = url('/hall') . '/' . base64_encode($val->id);
		}
		//dd($data['my_favourite']);
		return view('dashboard.myfavourite', ['data' => $data]);
	}
	public function myFavouriteDelete(Request $request) {
		$id = Input::get('id');
		DB::table('favorite')
			->where('user_id', '=', Auth::user()->id)
			->where('hall_id', '=', $id)
			->delete();
		return json_encode(array('status' => 'success'));

	}
	public function reviewRatings(Request $request) {
		$data = $this->languageSetter($request);
		$data['my_reviews'] = Common::myReviews($data['language_val']);
		return view('dashboard.reviewRatings.reviewratings', ['data' => $data]);
	}
	public function reviewsOnMyHall(Request $request) {
		$data = $this->languageSetter($request);
		$data['other_review'] = Common::reviewsOnMyHall($data['language_val']);
		return view('dashboard.reviewRatings.reviewsonmyhall', ['data' => $data]);
	}
	
	public function myBooking(Request $request) {
			$data = $this->languageSetter($request);
			$data['my_booking'] = Common::myBooking();
			$data['status_array'] = array(''=>'Select','0'=>'Not confirmed','1'=>'Confirmed','2'=>'Booked','3'=>'Payment pending','4'=>'Canceled');
			//dd($data['my_booking']);
			return view('dashboard.booking.mybooking', ['data' => $data]);
	}
	
	public function bookingOnMyHall(Request $request) {
		$data = $this->languageSetter($request);
		$data['other_booking'] = Common::bookingOnMyHall();
		$data['status_array'] = array(''=>'Select','0'=>'Not confirmed','1'=>'Confirmed','2'=>'Booked','3'=>'Payment pending','4'=>'Canceled');
		//dd($data['other_booking']);
		return view('dashboard.booking.booking', ['data' => $data]);
	}	

	public function enquiries(Request $request) {
		$request->session()->forget('msg_id');
		$data = $this->languageSetter($request);
		return view('dashboard.enquiries', ['data' => $data]);
	}
	public function enquiryView(Request $request) {
		$msg_id = $request->session()->get('msg_id');
		$data = $this->languageSetter($request);
		$data['msg_id'] = $msg_id;
		$query = DB::select(DB::raw("select * from `ev_messages` where `msg_id` = '" . $msg_id . "'"));
		$data['heading_msg'] = $query;
		return view('dashboard.enquiry.single', ['data' => $data]);
	}
	public function setMessageid($id, Request $request) {
		$request->session()->put('msg_id', $id);
		return redirect('/dashboard/single/enquiry');

	}

	public function messageReply(Request $request) {
		DB::table('messages')
			->insert(
				['msg_parent_id' => $request->msg_parent_id, 'hall_id' => $request->hall_id, 'message' => $request->message, 'from_user_id' => Auth::user()->id, 'to_user_id' => $request->to_user_id, 'msg_datetime' => date('Y-m-d H:i:s'), 'msgreply_datetime' => date('Y-m-d H:i:s')]
			);
		DB::table('messages')
			->where('msg_id', '=', $request->msg_parent_id)
			->update(
				['msgpost_datetime' => date('Y-m-d H:i:s')]
			);
		// Email section start //
		$data = $this->languageSetter($request);
		$username = Auth::user()->first_name;
		$data['to_user_name'] = Common::getToUserName($request->to_user_id);
		//dd($data['to_user_name']);
		$emailTemplate = Common::getEmaildata(7, $data['language_val']);
		$data['email_subject'] = $emailTemplate->email_subject;
		$headerText = $emailTemplate->email_body;
		$headerText = str_replace('[USERNAME]', $data['to_user_name'][0], $headerText);
		$headerText = str_replace('[POSTEDBY]', $username, $headerText);
		$headerText = str_replace('[REPLYTEXT]', $request->message, $headerText);
		$data['to_email'] = Common::getUserEmail($request->to_user_id);

		$data['body'] = $headerText;

		Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
			$fromEmail = Auth::user()->email;
			$message->from($fromEmail, 'Eventus Angola');
			$message->to($data['to_email'][0])->subject($data['email_subject']);
		});
		// Email section end //
		return json_encode(array('success' => 'Your reply has been sent successfully.'));
	}

	public function setCalenderBlockDates(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$data = $this->languageSetter($request);
		$data['dataset'] = array();

		if ($request->activity == 'insertData') {
			$start_date = $request->start_date ? date("Y-m-d", strtotime($request->start_date)) : NULL;
			$end_date = $request->end_date ? date("Y-m-d", strtotime($request->end_date)) : NULL;
			DB::table('hall_block')
				->insert(
					['hall_id' => $past_hall_id, 'block_type' => $request->calender_block_dates, 'start_date' => $start_date, 'end_date' => $end_date, 'week_day' => $request->recurring_weekday_select, 'month_date' => $request->recurring_monthday_select]
				);

		}

		if ($past_hall_id) {
			$data['dataset'] = DB::select(DB::raw("select * from `ev_hall_block` where `hall_id` = '" . $past_hall_id . "'"));
		}
		$data['todo'] = 'insertData';

		return view('dashboard.hall.calender-block-dates', ['data' => $data]);
	}

	function deleteCalenderBlockDates(Request $request) {
		$hall_block_id = Input::get('hall_block_id');
		DB::table('hall_block')->where('hall_block_id', $hall_block_id)->delete();
		die;
	}

	public function setCalender(Request $request) {
		$past_hall_id = $request->session()->get('hall_id');
		$data = $this->languageSetter($request);
		$data['hall_id'] = $past_hall_id;
		return view('dashboard.hall.calender', ['data' => $data]);
	}

	function get_particular_dates() {
		$block_days = array();
		$hall_block_id = Input::get('hall_block_id');
		//$current_month_year = Input::get('current_month_year');

		if ($hall_block_id) {
			$block_days = DB::select(DB::raw("select * from `ev_hall_block` where `hall_id` = '" . $hall_block_id . "'"));
		}
		$all_block_date = array();
		$i = 0;
		foreach ($block_days as $block_day) {
			if ($block_day->block_type == 'D') {
				$all_block_date = array_merge($all_block_date, $this->createDateRangeArray($block_day->start_date, $block_day->end_date));
			}
		}
		echo json_encode($all_block_date);
		die;
	}
	function get_weekdays() {
		$block_days = array();
		$hall_block_id = Input::get('hall_block_id');

		if ($hall_block_id) {
			$block_days = DB::select(DB::raw("select * from `ev_hall_block` where `hall_id` = '" . $hall_block_id . "'"));
		}
		$all_block_date = array();
		$i = 0;
		$weekdays = array(
			'1' => 'mon',
			'2' => 'tue',
			'3' => 'wed',
			'4' => 'thu',
			'5' => 'fri',
			'6' => 'sat',
			'7' => 'sun',
		);
		foreach ($block_days as $block_day) {
			if ($block_day->block_type == 'W') {
				$all_block_date[] = $weekdays[$block_day->week_day];
			}
		}
		$all_block_date = array_unique($all_block_date);
		echo json_encode($all_block_date);
		die;
	}

	function get_monthdays() {
		$block_days = array();
		$hall_block_id = Input::get('hall_block_id');
		$current_month_year = Input::get('current_month_year');

		$selected_month_year = explode(',', $current_month_year);

		if ($hall_block_id) {
			$block_days = DB::select(DB::raw("select * from `ev_hall_block` where `hall_id` = '" . $hall_block_id . "'"));
		}
		$all_block_date = array();
		$i = 0;
		$current_year = $selected_month_year[1];
		$current_month = $selected_month_year[0] + 1;
		if ($current_month / 10 < 1) {
			$current_month = '0' . $current_month;
		}
		foreach ($block_days as $block_day) {
			if ($block_day->block_type == 'M') {
				if ($block_day->month_date / 10 < 1) {
					$all_block_date[] = $current_year . '-' . $current_month . '-0' . $block_day->month_date;
				} else {
					$all_block_date[] = $current_year . '-' . $current_month . '-' . $block_day->month_date;
				}
			}
		}
		echo json_encode($all_block_date);
		die;
	}

	function createDateRangeArray($strDateFrom, $strDateTo) {
		$aryRange = array();
		$iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
		$iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));
		if ($iDateTo >= $iDateFrom) {
			array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
			while ($iDateFrom < $iDateTo) {
				$iDateFrom += 86400; // add 24 hours
				array_push($aryRange, date('Y-m-d', $iDateFrom));
			}
		}
		return $aryRange;
	}
}