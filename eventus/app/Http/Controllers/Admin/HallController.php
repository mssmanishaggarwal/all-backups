<?php
namespace App\Http\Controllers\admin;
use App\Helper\Languagehelper;
use App\Http\Controllers\Controller;
use App\Models\Admin\Hall;
use App\Models\Admin\Pagenation;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HallController extends Controller {

	protected $tablename;
	protected $title;
	protected $subtitle;
	protected $heading;
	protected $language;

	public function __construct() {
		$this->middleware('admins');
		$this->tablename = 'hall';
		$this->title = 'hall';
		$this->subtitle = 'hall';
		$this->heading = 'Hall';
		$this->language = 1;
	}
	public function index(Request $request) {
		$data = array();
		$sessionUpdate = $request->session()->pull('sessionUpdate');
		$sessionGet = $request->session()->get('sessionData');
		$sessionInsert = $request->session()->pull('sessionInsert');
		if ($sessionUpdate['isupdate'] == 1) {
			/* SESSION VALUE */
			$sessionGet = $request->session()->get('sessionData');
			$orderby = !empty($sessionGet['orderby']) ? $sessionGet['orderby'] : 'asc';
			$fieldname = !empty($sessionGet['fieldname']) ? $sessionGet['fieldname'] : 't.order_id';
			$currpage = !empty($sessionGet['currpage']) ? $sessionGet['currpage'] : 1;
			$offset = !empty($sessionGet['offset']) ? $sessionGet['offset'] : 0;
			$limit = !empty($sessionGet['limit']) ? $sessionGet['limit'] : 5;
			$keywords = !empty($sessionGet['keywords']) ? $sessionGet['keywords'] : array();
			$sessionArray['orderby'] = $orderby;
			$sessionArray['fieldname'] = $fieldname;
			$sessionArray['currpage'] = $currpage;
			$sessionArray['offset'] = $offset;
			$sessionArray['limit'] = $limit;
			$sessionArray['keywords'] = $keywords;
			$request->session()->put('sessionData', $sessionArray);
			/* SESSION VALUE */
		} else {
			$currpage = 1;
			$offset = 0;
			$limit = 5;
			$orderby = 'asc';
			$fieldname = 't.order_id';
			$keywords = array();
			$request->session()->forget('sessionData');
			$request->session()->forget('sessionUpdate');
			$request->session()->forget('$sessionInsert');
		}
		$data['dataCount'] = Hall::totalRecord('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords);
		$data['dataGrid'] = Hall::totalGrid('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, $offset);
		
		$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'], $currpage, $limit);
		$data['title'] = $this->title;
		$data['heading'] = $this->heading;
		$data['module_ajaxurl'] = url('/') . '/admin/hall_ajax/';
		$data['orderby'] = 'asc';
		$data['fa_order'] = 'asc';
		if ($fieldname == 't.order_id' && empty($keywords)) {
			$data['hide_order'] = 0;
		} else {
			$data['hide_order'] = 1;
		}
		$data['update_id'] = !empty($sessionUpdate['updateid']) ? $sessionUpdate['updateid'] : '';
		$data['insert_id'] = !empty($sessionInsert['insertid']) ? $sessionInsert['insertid'] : '';
		$data['maxorder'] = Hall::maxOrderId($this->tablename);
		$data['minorder'] = Hall::minOrderId($this->tablename);
		$data['keywords'] = $keywords;
		$data['limit'] = $limit;
		$data['locations'] = Hall::MultiRecords('location_translation', $where = array('language_id' => 1));
		$data['province'] = Hall::MultiRecords('province', $where = array());
		return view('admin.hall.index', ['data' => $data]);
	}
	public function todo($type, Request $request) {
		// AJAX function
		$data = array();
		$sessionArray = array();
		switch ($type) {
		case 'searching':$keywords = Input::all();
		
			/* SESSION VALUE */
			$sessionGet = $request->session()->get('sessionData');
			$limit = !empty($sessionGet['limit']) ? $sessionGet['limit'] : 5;
			$request->session()->forget('sessionData');
			$sessionArray['keywords'] = $keywords;
			$sessionArray['orderby'] = 'asc';
			$sessionArray['fieldname'] = 't.order_id';
			$sessionArray['currpage'] = 1;
			$sessionArray['offset'] = 0;
			$sessionArray['limit'] = $limit;
			$request->session()->put('sessionData', $sessionArray);
			/* SESSION VALUE */
			$data['dataCount'] = Hall::totalRecord('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords);
			$data['dataGrid'] = Hall::totalGrid('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords, 't.order_id', 'asc', $limit, 0);
			$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'], 1, $limit);
			$data['title'] = $this->title;
			$data['heading'] = $this->heading;
			$data['module_ajaxurl'] = url('/') . '/admin/hall_ajax/';
			$data['orderby'] = 'asc';
			$data['fa_order'] = 'asc';
			$data['hide_order'] = 1;
			$data['update_id'] = '';
			$data['insert_id'] = '';
			$data['maxorder'] = Hall::maxOrderId($this->tablename);
			$data['minorder'] = Hall::minOrderId($this->tablename);
			$data['keywords'] = $keywords;
			$data['limit'] = $limit;
			return view('admin.hall.listview', ['data' => $data]);
			break;
		case 'paging':$currpage = Input::get('currpage');
			$limit = Input::get('limit');
			$offset = (($currpage * $limit) - $limit);
			/* SESSION VALUE */
			$sessionGet = $request->session()->get('sessionData');
			$orderby = !empty($sessionGet['orderby']) ? $sessionGet['orderby'] : 'asc';
			$fieldname = !empty($sessionGet['fieldname']) ? $sessionGet['fieldname'] : 't.order_id';
			$keywords = !empty($sessionGet['keywords']) ? $sessionGet['keywords'] : array();
			$sessionArray['orderby'] = $orderby;
			$sessionArray['fieldname'] = $fieldname;
			$sessionArray['currpage'] = $currpage;
			$sessionArray['offset'] = $offset;
			$sessionArray['limit'] = $limit;
			$sessionArray['keywords'] = $keywords;
			$request->session()->put('sessionData', $sessionArray);
			/* SESSION VALUE */
			$data['dataCount'] = Hall::totalRecord('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords);
			$data['dataGrid'] = Hall::totalGrid('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, $offset);
			$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'], $currpage, $limit);
			$data['title'] = $this->title;
			$data['heading'] = $this->heading;
			$data['module_ajaxurl'] = url('/') . '/admin/hall_ajax/';
			$data['orderby'] = ($orderby == 'asc') ? 'desc' : 'asc';
			$data['fa_order'] = $orderby;
			if ($fieldname == 't.order_id' && empty($keywords)) {
				$data['hide_order'] = 0;
			} else {
				$data['hide_order'] = 1;
			}
			$data['update_id'] = '';
			$data['insert_id'] = '';
			$data['maxorder'] = Hall::maxOrderId($this->tablename);
			$data['minorder'] = Hall::minOrderId($this->tablename);
			$data['keywords'] = $keywords;
			$data['limit'] = $limit;
			return view('admin.hall.listview', ['data' => $data]);
			break;
		case 'ordering':$orderby = Input::get('orderby');
			$fieldname = Input::get('fieldname');
			/* SESSION VALUE */
			$sessionGet = $request->session()->get('sessionData');
			$keywords = !empty($sessionGet['keywords']) ? $sessionGet['keywords'] : array();
			$limit = !empty($sessionGet['limit']) ? $sessionGet['limit'] : 5;
			$sessionArray['orderby'] = $orderby;
			$sessionArray['fieldname'] = $fieldname;
			$sessionArray['currpage'] = 1;
			$sessionArray['offset'] = 0;
			$sessionArray['limit'] = $limit;
			$sessionArray['keywords'] = $keywords;
			$request->session()->put('sessionData', $sessionArray);
			/* SESSION VALUE */

			$data['dataCount'] = Hall::totalRecord('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords);
			$data['dataGrid'] = Hall::totalGrid('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, 0);
			$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'], 1, $limit);
			$data['title'] = $this->title;
			$data['heading'] = $this->heading;
			$data['module_ajaxurl'] = url('/') . '/admin/hall_ajax/';
			$data['orderby'] = ($orderby == 'asc') ? 'desc' : 'asc';
			$data['fa_order'] = $orderby;
			$data['hide_order'] = 1;
			$data['update_id'] = '';
			$data['insert_id'] = '';
			$data['maxorder'] = Hall::maxOrderId($this->tablename);
			$data['minorder'] = Hall::minOrderId($this->tablename);
			$data['keywords'] = $keywords;
			$data['limit'] = $limit;
			return view('admin.hall.listview', ['data' => $data]);
			break;
		case 'setactive':$sessionGet = array();
			$newactive = 0;
			$primary_id = Input::get('dataid');
			$active = Input::get('currentval');
			if ($active == 1) {
				$newactive = 0;
			} elseif ($active == 0) {
				$newactive = 1;
			}
			/* SESSION VALUE */
			$sessionGet = $request->session()->get('sessionData');
			$orderby = !empty($sessionGet['orderby']) ? $sessionGet['orderby'] : 'asc';
			$fieldname = !empty($sessionGet['fieldname']) ? $sessionGet['fieldname'] : 't.order_id';
			$currpage = !empty($sessionGet['currpage']) ? $sessionGet['currpage'] : 1;
			$offset = !empty($sessionGet['offset']) ? $sessionGet['offset'] : 0;
			$limit = !empty($sessionGet['limit']) ? $sessionGet['limit'] : 5;
			$keywords = !empty($sessionGet['keywords']) ? $sessionGet['keywords'] : array();
			$sessionArray['orderby'] = $orderby;
			$sessionArray['fieldname'] = $fieldname;
			$sessionArray['currpage'] = $currpage;
			$sessionArray['offset'] = $offset;
			$sessionArray['limit'] = $limit;
			$sessionArray['keywords'] = $keywords;
			$request->session()->put('sessionData', $sessionArray);
			/* SESSION VALUE */
			$update = Hall::updateData($this->tablename, $data = array('is_active' => $newactive, 'updated_at' => date('Y-m-d H:i:s')), $where = array('id' => $primary_id));
			$data['dataCount'] = Hall::totalRecord('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords);
			$data['dataGrid'] = Hall::totalGrid('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, $offset);
			$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'], $currpage, $limit);

			$data['title'] = $this->title;
			$data['heading'] = $this->heading;
			$data['module_ajaxurl'] = url('/') . '/admin/hall_ajax/';
			$data['orderby'] = $orderby;
			$data['fa_order'] = $orderby;
			$data['update_id'] = '';
			$data['insert_id'] = '';
			if ($fieldname == 't.order_id' && empty($keywords)) {
				$data['hide_order'] = 0;
			} else {
				$data['hide_order'] = 1;
			}
			$data['maxorder'] = Hall::maxOrderId($this->tablename);
			$data['minorder'] = Hall::minOrderId($this->tablename);
			$data['limit'] = $limit;
			return view('admin.hall.listview', ['data' => $data]);
			break;
		case 'orderup':$primary_id = Input::get('dataid');
			$current_order_id = Input::get('noworder');
			$orderup = Hall::orderUp($this->tablename, $primary_id, $current_order_id);

			/* SESSION VALUE */
			$sessionGet = $request->session()->get('sessionData');
			$orderby = !empty($sessionGet['orderby']) ? $sessionGet['orderby'] : 'asc';
			$fieldname = !empty($sessionGet['fieldname']) ? $sessionGet['fieldname'] : 't.order_id';
			$currpage = !empty($sessionGet['currpage']) ? $sessionGet['currpage'] : 1;
			$offset = !empty($sessionGet['offset']) ? $sessionGet['offset'] : 0;
			$limit = !empty($sessionGet['limit']) ? $sessionGet['limit'] : 5;
			$keywords = !empty($sessionGet['keywords']) ? $sessionGet['keywords'] : array();
			$sessionArray['orderby'] = $orderby;
			$sessionArray['fieldname'] = $fieldname;
			$sessionArray['currpage'] = $currpage;
			$sessionArray['offset'] = $offset;
			$sessionArray['limit'] = $limit;
			$sessionArray['keywords'] = array();
			$request->session()->put('sessionData', $sessionArray);
			$data['dataCount'] = Hall::totalRecord('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords = array());
			$data['dataGrid'] = Hall::totalGrid('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords = array(), $fieldname, $orderby, $limit, $offset);
			$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'], $currpage, $limit);
			$data['title'] = $this->title;
			$data['heading'] = $this->heading;
			$data['module_ajaxurl'] = url('/') . '/admin/hall_ajax/';
			$data['orderby'] = $orderby;
			$data['fa_order'] = $orderby;
			$data['hide_order'] = 0;
			$data['update_id'] = '';
			$data['insert_id'] = '';
			$data['maxorder'] = Hall::maxOrderId($this->tablename);
			$data['minorder'] = Hall::minOrderId($this->tablename);
			$data['keywords'] = $keywords;
			$data['limit'] = $limit;
			return view('admin.hall.listview', ['data' => $data]);
			break;
		case 'orderdown':$primary_id = Input::get('dataid');
			$current_order_id = Input::get('noworder');
			$orderup = Hall::orderDown($this->tablename, $primary_id, $current_order_id);
			/* SESSION VALUE */
			$sessionGet = $request->session()->get('sessionData');
			$orderby = !empty($sessionGet['orderby']) ? $sessionGet['orderby'] : 'asc';
			$fieldname = !empty($sessionGet['fieldname']) ? $sessionGet['fieldname'] : 't.order_id';
			$currpage = !empty($sessionGet['currpage']) ? $sessionGet['currpage'] : 1;
			$offset = !empty($sessionGet['offset']) ? $sessionGet['offset'] : 0;
			$limit = !empty($sessionGet['limit']) ? $sessionGet['limit'] : 5;
			$keywords = !empty($sessionGet['keywords']) ? $sessionGet['keywords'] : array();
			$sessionArray['orderby'] = $orderby;
			$sessionArray['fieldname'] = $fieldname;
			$sessionArray['currpage'] = $currpage;
			$sessionArray['offset'] = $offset;
			$sessionArray['limit'] = $limit;
			$sessionArray['keywords'] = array();
			$request->session()->put('sessionData', $sessionArray);
			$data['dataCount'] = Hall::totalRecord('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords = array());
			$data['dataGrid'] = Hall::totalGrid('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords = array(), $fieldname, $orderby, $limit, $offset);
			$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'], $currpage, $limit);

			$data['title'] = $this->title;
			$data['heading'] = $this->heading;
			$data['module_ajaxurl'] = url('/') . '/admin/hall_ajax/';
			$data['orderby'] = $orderby;
			$data['fa_order'] = $orderby;
			$data['hide_order'] = 0;
			$data['update_id'] = '';
			$data['insert_id'] = '';
			$data['maxorder'] = Hall::maxOrderId($this->tablename);
			$data['minorder'] = Hall::minOrderId($this->tablename);
			$data['keywords'] = $keywords;
			$data['limit'] = $limit;
			return view('admin.hall.listview', ['data' => $data]);
			break;
		case 'delete':$sessionGet = array();
			$primary_id = Input::get('dataid');
			/* SESSION VALUE */
			$sessionGet = $request->session()->get('sessionData');
			$orderby = !empty($sessionGet['orderby']) ? $sessionGet['orderby'] : 'asc';
			$fieldname = !empty($sessionGet['fieldname']) ? $sessionGet['fieldname'] : 't.order_id';
			$currpage = !empty($sessionGet['currpage']) ? $sessionGet['currpage'] : 1;
			$offset = !empty($sessionGet['offset']) ? $sessionGet['offset'] : 0;
			$limit = !empty($sessionGet['limit']) ? $sessionGet['limit'] : 5;
			$keywords = !empty($sessionGet['keywords']) ? $sessionGet['keywords'] : array();

			$sessionArray['orderby'] = $orderby;
			$sessionArray['fieldname'] = $fieldname;
			$sessionArray['currpage'] = $currpage;
			$sessionArray['offset'] = $offset;
			$sessionArray['limit'] = $limit;
			$sessionArray['keywords'] = $keywords;
			$request->session()->put('sessionData', $sessionArray);
			/* SESSION VALUE */
			$delete = Hall::deleteData($this->tablename, $primary_id);
			$data['dataCount'] = Hall::totalRecord('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords);
			$data['dataGrid'] = Hall::totalGrid('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, $offset);
			$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'], $currpage, $limit);

			$data['title'] = $this->title;
			$data['heading'] = $this->heading;
			$data['module_ajaxurl'] = url('/') . '/admin/hall_ajax/';
			$data['orderby'] = $orderby;
			$data['fa_order'] = $orderby;
			$data['update_id'] = '';
			$data['insert_id'] = '';
			if ($fieldname == 't.order_id' && empty($keywords)) {
				$data['hide_order'] = 0;
			} else {
				$data['hide_order'] = 1;
			}
			$data['maxorder'] = Hall::maxOrderId($this->tablename);
			$data['minorder'] = Hall::minOrderId($this->tablename);
			$data['keywords'] = $keywords;
			$data['limit'] = $limit;
			return view('admin.hall.listview', ['data' => $data]);
			break;
		case 'perpage':$sessionGet = array();
			$newlimit = Input::get('limit');
			/* SESSION VALUE */
			$sessionGet = $request->session()->get('sessionData');
			$orderby = !empty($sessionGet['orderby']) ? $sessionGet['orderby'] : 'asc';
			$fieldname = !empty($sessionGet['fieldname']) ? $sessionGet['fieldname'] : 't.order_id';
			$currpage = 1;
			$offset = 0;
			$limit = $newlimit;
			$keywords = !empty($sessionGet['keywords']) ? $sessionGet['keywords'] : array();
			$sessionArray['orderby'] = $orderby;
			$sessionArray['fieldname'] = $fieldname;
			$sessionArray['currpage'] = $currpage;
			$sessionArray['offset'] = $offset;
			$sessionArray['limit'] = $limit;
			$sessionArray['keywords'] = $keywords;
			$request->session()->put('sessionData', $sessionArray);
			/* SESSION VALUE */
			$data['dataCount'] = Hall::totalRecord('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords);
			$data['dataGrid'] = Hall::totalGrid('*', $this->tablename, $where = array('atrans.language_id'=>$this->language,'loctrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, $offset);
			$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'], $currpage, $limit);

			$data['title'] = $this->title;
			$data['heading'] = $this->heading;
			$data['module_ajaxurl'] = url('/') . '/admin/hall_ajax/';
			$data['orderby'] = $orderby;
			$data['fa_order'] = $orderby;
			$data['update_id'] = '';
			$data['insert_id'] = '';

			if ($fieldname == 't.order_id' && empty($keywords)) {
				$data['hide_order'] = 0;
			} else {
				$data['hide_order'] = 1;
			}
			$data['maxorder'] = Hall::maxOrderId($this->tablename);
			$data['minorder'] = Hall::minOrderId($this->tablename);
			$data['keywords'] = $keywords;
			$data['limit'] = $limit;

			return view('admin.hall.listview', ['data' => $data]);
			break;
		}
	}

	public function update($id = '', Request $request) {
		$data = array();
		$language = Languagehelper::getlanguage();
		$todo = Input::get('todo');
		/* SESSION VALUE */
		$sessionGet = $request->session()->get('sessionData');
		$orderby = !empty($sessionGet['orderby']) ? $sessionGet['orderby'] : 'asc';
		$fieldname = !empty($sessionGet['fieldname']) ? $sessionGet['fieldname'] : 't.order_id';
		$currpage = !empty($sessionGet['currpage']) ? $sessionGet['currpage'] : 1;
		$offset = !empty($sessionGet['offset']) ? $sessionGet['offset'] : 0;
		$limit = !empty($sessionGet['limit']) ? $sessionGet['limit'] : 5;
		$keywords = !empty($sessionGet['keywords']) ? $sessionGet['keywords'] : array();
		$sessionArray['orderby'] = $orderby;
		$sessionArray['fieldname'] = $fieldname;
		$sessionArray['currpage'] = $currpage;
		$sessionArray['offset'] = $offset;
		$sessionArray['limit'] = $limit;
		$sessionArray['keywords'] = $keywords;
		$request->session()->put('sessionData', $sessionArray);

		$data['locations'] = Hall::MultiRecords('location_translation', $where = array('language_id' => 1));
		$data['province'] = Hall::MultiRecords('province', $where = array());
		/*$data['halltypes'] = Hall::MultiRecords('hall_type_translation', $where = array('language_id' => 1));
		$data['facilities'] = Hall::MultiRecords('facilities_translation', $where = array('language_id' => 1));*/
		$data['halltypes'] = $query = DB::table('hall_type' . ' as ht')
														->join('hall_type_translation as htrans', 'ht.id', '=', 'htrans.hall_type_id')
														->where('ht.is_active', '=', '1')
														->where('htrans.language_id', '=', '1')
														->get();
														
		$data['facilities'] = $query = DB::table('facilities' . ' as ft')
														->join('facilities_translation as ftrans', 'ft.id', '=', 'ftrans.facilities_id')
														->where('ft.is_active', '=', '1')
														->where('ftrans.language_id', '=', '1')
														->get();
		$data['users'] = Hall::MultiRecords('users', $where = array());

		/* SESSION VALUE */
		if ($todo == 'saverec') {
			$hall_types = $request->hall_type;
			$hall_fac = $request->hall_fac;
			$is_active = (!isset($request->is_active) ? 0 : 1);
			$update = Hall::updateData($this->tablename, $data = array('is_active' => $is_active, 'location_id' => $request->location, 'hall_province' => $request->province, 'hall_postcode' => $request->hall_postcode, 'rental_amount' => $request->rental_amount, 'contact_mobile' => $request->contact_mobile, 'contact_email' => $request->contact_email, 'user_id' => $request->user_id, 'lat' => $request->lat,'lng' => $request->lng,'g_address' => $request->g_address, 'updated_at' => date('Y-m-d H:i:s')), $where = array('id' => $id));
			$update = Hall::updateData('hall_translation', $data = array('hall_name' => $request->hall_name, 'hall_description' => $request->hall_description, 'hall_address' => $request->hall_address, 'official_name' => $request->official_name, 'contact_name' => $request->contact_name), $where = array('hall_id' => $id, 'language_id' => 1));
			$update = Hall::updateData('hall_translation', $data = array('hall_name' => $request->hall_name, 'hall_description' => $request->hall_description, 'hall_address' => $request->hall_address, 'official_name' => $request->official_name, 'contact_name' => $request->contact_name), $where = array('hall_id' => $id, 'language_id' => 2));
			DB::table('hall_type_relation')->where('hall_id', $id)->delete();
			if(isset($hall_types) && !empty($hall_types)) {
				foreach ($hall_types as $hall_type) {
					DB::table('hall_type_relation')->insert(['hall_type_id' => $hall_type, 'hall_id' => $id]);
				}
			}
			DB::table('hall_facilities_relation')->where('hall_id', $id)->delete();
			if(isset($hall_fac) && !empty($hall_fac)) {
				foreach ($hall_fac as $each_fac) {
					DB::table('hall_facilities_relation')->insert(['facilities_id' => $each_fac, 'hall_id' => $id]);
				}
			}
			$sessionUpdate['updateid'] = $id;
			$sessionUpdate['isupdate'] = 1;
			$request->session()->put('sessionUpdate', $sessionUpdate);
			//echo '1';
			//return;
			return redirect('/admin/hall_list');
		}

		$sessionUpdate['updateid'] = 0;
		$sessionUpdate['isupdate'] = 1;
		$request->session()->put('sessionUpdate', $sessionUpdate);

		$hall = DB::table('hall as acco')
			->select('*')
			->join('hall_translation as atrans', 'acco.id', '=', 'atrans.hall_id')
			->where('acco.id', $id)
			->get();

		$hall_types = DB::table('hall_type_relation as acco')
			->select('*')
			->where('acco.hall_id', $id)
			->get();
		$allhalltypes = array();
		foreach ($hall_types as $hall_type) {
			$allhalltypes[] = $hall_type->hall_type_id;
		}
		
		$hall_fac_types = DB::table('hall_facilities_relation as hall_fac')
			->select('*')
			->where('hall_fac.hall_id', $id)
			->get();
		$hall_fac_selected = array();
		if(isset($hall_fac_types) && !empty($hall_fac_types)) {
			foreach ($hall_fac_types as $hall_fac_type) {
				$hall_fac_selected[] = $hall_fac_type->facilities_id;
			}
		}
		
		$data['title'] = 'Update ' . $this->heading;
		$data['heading'] = $this->heading;
		$data['subHeading'] = 'Update ' . $this->heading;
		$data['saveBtn'] = 'Save';
		$data['todo'] = 'saverec';
		$data['language'] = $language;
		$data['dataset'] = $hall;
		$data['halltypeids'] = $allhalltypes;
		$data['hall_fac_selected'] = $hall_fac_selected;
		$data['id'] = $id;
		$data['hall_id'] = $id;
		$data['url'] = url('/') . '/admin/hall/' . $id;
		//print_r($hall_types); die;
		return view('admin.hall.hall', ['data' => $data]);
	}

	public function getuserdetails(Request $request) {
		$user_id = Input::get('user_id');

		$user_details = Hall::MultiRecords('users', $where = array('id' => $user_id));

		return response()->json($user_details);

		die;
	}

	public function create(Request $request) {
		$data = array();
		$language = Languagehelper::getlanguage();
		$todo = Input::get('todo');
		if ($todo == 'addrec') {
			$is_active = (!isset($request->is_active) ? 0 : 1);
			$hall_types = $request->hall_type;
			$hall_fac = $request->hall_fac;
			$max_order = DB::table($this->tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_hall)"))->get();
			$hallId = DB::table($this->tablename)->insertGetId(
				['is_active' => $is_active, 'location_id' => $request->location, 'hall_province' => $request->province, 'hall_postcode' => $request->hall_postcode, 'rental_amount' => $request->rental_amount, 'contact_mobile' => $request->contact_mobile, 'contact_email' => $request->contact_email, 'user_id' => $request->user_id, 'lat' => $request->lat,'lng' => $request->lng,'g_address' => $request->g_address, 'order_id' => $max_order[0]->order_id + 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
			);
			DB::table('hall_translation')->insert([
				['hall_id' => $hallId, 'language_id' => 1, 'hall_name' => $request->hall_name, 'hall_description' => $request->hall_description, 'hall_address' => $request->hall_address, 'official_name' => $request->official_name, 'contact_name' => $request->contact_name],
				['hall_id' => $hallId, 'language_id' => 2, 'hall_name' => $request->hall_name, 'hall_description' => $request->hall_description, 'hall_address' => $request->hall_address, 'official_name' => $request->official_name, 'contact_name' => $request->contact_name],
			]);
			//DB::table('hall_type_relation')->where('hall_id', $hallId)->delete();
			if( !empty($hall_types) ) {
				foreach ($hall_types as $hall_type) {
					DB::table('hall_type_relation')->insert(['hall_type_id' => $hall_type, 'hall_id' => $hallId]);
				}
			}
			//DB::table('hall_facilities_relation')->where('hall_id', $id)->delete();
			if( !empty($hall_fac) ){
				foreach ($hall_fac as $each_fac) {
					DB::table('hall_facilities_relation')->insert(['facilities_id' => $each_fac, 'hall_id' => $hallId]);
				}
			}
			$sessionInsert['insertid'] = $hallId;
			$sessionInsert['isinsert'] = 1;
			$request->session()->put('sessionInsert', $sessionInsert);
			//echo '1';
			//return;
			return redirect('/admin/hall_list');
		}
		$data['title'] = 'Add ' . $this->heading;
		$data['heading'] = $this->heading;
		$data['subHeading'] = 'Add ' . $this->heading;
		$data['saveBtn'] = 'Add';
		$data['todo'] = 'addrec';
		$data['language'] = $language;
		$data['dataset'] = array();
		$data['halltypeids'] = array();
		$data['hall_fac_selected'] = array();
		$data['id'] = '';
		$data['hall_id'] = '';
		$data['locations'] = Hall::MultiRecords('location_translation', $where = array('language_id' => 1));
		$data['province'] = Hall::MultiRecords('province', $where = array());
		/*$data['halltypes'] = Hall::MultiRecords('hall_type_translation', $where = array('language_id' => 1));*/
		
		$data['halltypes'] = $query = DB::table('hall_type' . ' as ht')
														->join('hall_type_translation as htrans', 'ht.id', '=', 'htrans.hall_type_id')
														->where('ht.is_active', '=', '1')
														->where('htrans.language_id', '=', '1')
														->get();
														
		$data['facilities'] = $query = DB::table('facilities' . ' as ft')
														->join('facilities_translation as ftrans', 'ft.id', '=', 'ftrans.facilities_id')
														->where('ft.is_active', '=', '1')
														->where('ftrans.language_id', '=', '1')
														->get();
														
		$data['users'] = Hall::MultiRecords('users', $where = array());
		$data['url'] = url('/') . '/admin/hall';
		return view('admin.hall.hall', ['data' => $data]);
	}

	public function multipleimage($hall_id, Request $request) {
		$past_hall_id = $hall_id;
		//$past_hall_id = $request->session()->get('hall_id');
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
	public function appendingImages($hall_id, Request $request) {
		$past_hall_id = $hall_id;
		$query = DB::select(DB::raw("SELECT * FROM `ev_hallimages` WHERE `hall_id`='" . $past_hall_id . "'
			AND `image_order`>'" . $request->image_order . "'"));
		return $query;
	}

	public function uploadimage($id = '', Request $request) {

		$images = DB::table('hallimages')
			->select('*')
			->where('hall_id', '=', $id)
			->orderBy('image_order', 'asc')
			->get();

		$data = array();
		$data['hall_id'] = $id;
		$data['title'] = 'Add ' . $this->heading;
		$data['heading'] = $this->heading;
		$data['subHeading'] = 'Add ' . $this->heading;
		$data['saveBtn'] = 'Save';
		$data['todo'] = 'saverec';
		$data['hallimages'] = $images;
		$todo = Input::get('todo');

		//print_r($data['hallimages']);
		//die();
		return view('admin.hall.images', ['data' => $data]);
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

	public function showlocation($id = '', Request $request) {
		$data = array();
		$data['hall_id'] = $id;
		$data['title'] = 'Add ' . $this->heading;
		$data['heading'] = $this->heading;
		$data['subHeading'] = 'Add ' . $this->heading;
		$data['saveBtn'] = 'Save';
		$data['todo'] = 'saverec';

		$lat = Input::get('lat');
		$lng = Input::get('lng');
		$g_address = Input::get('g_address');

		if (!empty($id)) {
			DB::table('hall')
				->where('id', $id)
				->update(['lat' => $lat, 'lng' => $lng, 'g_address' => $g_address]);
		}

		return view('admin.hall.location', ['data' => $data]);
		//return redirect('admin/hall/set-location/'.$id, ['data' => $data]);
	}

	public function setlocation($id = '', Request $request) {
		$data = array();
		$data['hall_id'] = $id;
		$data['title'] = 'Add ' . $this->heading;
		$data['heading'] = $this->heading;
		$data['subHeading'] = 'Add ' . $this->heading;
		$data['saveBtn'] = 'Save';
		$data['todo'] = 'saverec';

		$lat = Input::get('lat');
		$lng = Input::get('lng');
		$g_address = Input::get('g_address');

		if (!empty($id)) {
			DB::table('hall')
				->where('id', $id)
				->update(['lat' => $lat, 'lng' => $lng, 'g_address' => $g_address]);
		}

		return view('admin.hall.location', ['data' => $data]);
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
	public function accommodationchecker(Request $request) {
		$hall_id = Input::get('hall_id');
		$hall_accommodation_relation = DB::table('hall_accommodation_relation')
			->select('*')
			->where('hall_id', '=', $hall_id)
			->get();
		//return json_encode($hall_accommodation_relation);
		return response()->json($hall_accommodation_relation);
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

	public function addon($id = '', Request $request) {
		$data = array();
		$data['hall_id'] = $id;
		$data['title'] = 'Add ' . $this->heading;
		$data['heading'] = $this->heading;
		$data['subHeading'] = 'Add ' . $this->heading;
		$data['saveBtn'] = 'Save';
		$data['todo'] = 'saverec';
		return view('admin.hall.addon', ['data' => $data]);
	}
	public function accommodation($id = '', Request $request) {
		$data = array();
		$data['hall_id'] = $id;
		$data['title'] = 'Add ' . $this->heading;
		$data['heading'] = $this->heading;
		$data['subHeading'] = 'Add ' . $this->heading;
		$data['saveBtn'] = 'Save';
		$data['todo'] = 'saverec';
		return view('admin.hall.accommodation', ['data' => $data]);
	}
	public function subscription($id = '', Request $request) {
		$data = array();
		$data['hall_id'] = $id;
		$data['title'] = 'Add ' . $this->heading;
		$data['heading'] = $this->heading;
		$data['subHeading'] = 'Add ' . $this->heading;
		$data['saveBtn'] = 'Save';
		$data['todo'] = 'saverec';
		$data['subscription_last_date'] = Hall::subscriptionAvailability($data['hall_id']);
		$data['subscription_notification'] = Hall::fetchsubScriptionStatus($this->language, $data['hall_id']);
		$data['feature_notification'] = Hall::fetchsubFeaturedStatus($this->language, $data['hall_id']);
		$data['subscription'] = Hall::fetchSubscription($this->language);
		$data['featured'] = Hall::fetchSubscriptionFeatured($this->language);
		return view('admin.hall.subscription', ['data' => $data]);
	}

	public function hallSubscriptionPayment($id = '', Request $request) {
		$past_hall_id = $id;
		$hall_user_id = Hall::getHallUser($id);		
		$payment_number = uniqid();
		$request->session()->put('payment_number', $payment_number);
		
		if ($request->subscription_id != '') {
			
			$start_date = $request->subscription_start_date;
			
			$subscription_id = DB::table('hall_subscription_relation')->insertGetId(
				['hall_id' => $past_hall_id,
					'subscription_id' => $request->subscription_id,
					'subscription_name' => $request->subscription_name,
					'subscription_price' => $request->subscription_price,
					'subscription_month' => $request->subscription_month,
					'payment_status' => 1,
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
					'payment_by_id' => $hall_user_id,
					'transaction_id' => $request->transaction_id,
					'payment_status' => 'S',
					'payment_method' => 'M',
				]
			);
			
		}
		if ($request->featured_id != '') {
			/*$date_available = Common::checkSubExpiryFeature($past_hall_id);*/
			//dd($date_available);
			//exit();
			$start_date = $request->featured_start_date;
			/*if ($date_available == 'notfound') {
					$start_date = date('Y-m-d');
				} else {
					$start_date = date("Y-m-d", strtotime("1 day", strtotime($date_available)));
			*/
			$feature_id = DB::table('hall_subscription_feature_relation')->insertGetId(
				['hall_id' => $past_hall_id,
					'feature_id' => $request->featured_id,
					'feature_name' => $request->featured_name,
					'feature_price' => $request->featured_price,
					'feature_month' => $request->featured_month,
					'payment_status' => 1,
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
					'payment_by_id' => $hall_user_id,
					'transaction_id' => $request->transaction_id,
					'payment_status' => 'S',
					'payment_method' => 'M',
				]
			);

		}
		
		return response()->json(array('status' => 'success', 'hall_id' => $past_hall_id));

	}

	public function selectcalender($id = '', Request $request) {
		//$hall_id = Input::get('hall_id');

		$data['hall_id'] = $id;
		$data['title'] = 'Add ' . $this->heading;
		$data['heading'] = $this->heading;
		$data['subHeading'] = 'Add ' . $this->heading;
		$data['saveBtn'] = 'Save';
		$data['todo'] = 'saverec';

		return view('admin.hall.calender', ['data' => $data]);
	}

	/* public function selectblockdates($id = '', Request $request) {
		//$hall_id = Input::get('hall_id');

		$data['hall_id'] =  $id;
		$data['title'] 		= 'Add '.$this->heading;
		$data['heading'] 	= $this->heading;
		$data['subHeading'] = 'Add '.$this->heading;
		$data['saveBtn'] = 'Save';
		$data['todo'] 	 = 'saverec';

		return view('admin.hall.calender-block-dates', ['data' => $data]);
	} */

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

	public function setCalenderBlockDates($id = '', Request $request) {
		$past_hall_id = $id;
		$data['dataset'] = array();
		$data['hall_id'] = $id;
		if ($request->activity == 'saverec') {
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
		$data['title'] = 'Add ' . $this->heading;
		$data['heading'] = $this->heading;
		$data['subHeading'] = 'Add ' . $this->heading;
		$data['saveBtn'] = 'Save';
		$data['todo'] = 'saverec';

		return view('admin.hall.calender-block-dates', ['data' => $data]);
	}

	function deleteCalenderBlockDates(Request $request) {
		$hall_block_id = Input::get('hall_block_id');
		DB::table('hall_block')->where('hall_block_id', $hall_block_id)->delete();
		die;
	}
}