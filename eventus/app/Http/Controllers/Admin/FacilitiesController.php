<?php
namespace App\Http\Controllers\admin;
use App\Helper\Languagehelper;
use App\Http\Controllers\Controller;
use App\Models\Admin\Facilities;
use App\Models\Admin\Pagenation;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Lang;
class FacilitiesController extends Controller {
	
	protected $tablename;
	protected $title;
	protected $subtitle;
	protected $heading;
	protected $language;
	
	public function __construct() {
		$this->middleware('admins');
		$this->tablename = 'facilities';
		$this->title 	 = 'facilities';
		$this->subtitle  = 'facilities';
		$this->heading   = 'Facilities';
		$this->language  = 1;
	}
	public function index(Request $request){		
		$data = array();		
		 $sessionUpdate = $request->session()->pull('sessionUpdate');
		 $sessionGet = $request->session()->get('sessionData');		 
		 $sessionInsert = $request->session()->pull('sessionInsert');		 
		if($sessionUpdate['isupdate']==1){	
		/* SESSION VALUE */							 
		 $sessionGet = $request->session()->get('sessionData');	
		 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
		 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.order_id';
		 $currpage	 = !empty($sessionGet['currpage'])?$sessionGet['currpage']:1;
		 $offset  	 = !empty($sessionGet['offset'])?$sessionGet['offset']:0;
		 $limit  	 = !empty($sessionGet['limit'])?$sessionGet['limit']:5;
		 $keywords   = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();		 
		 $sessionArray['orderby']	= $orderby;							 
		 $sessionArray['fieldname'] = $fieldname;
		 $sessionArray['currpage']	= $currpage;							 
		 $sessionArray['offset'] 	= $offset;
		 $sessionArray['limit'] 	= $limit;							 
		 $sessionArray['keywords'] 	= $keywords;							 
		 $request->session()->put('sessionData', $sessionArray);							 
		 /* SESSION VALUE */
		}else{			
			$currpage	= 1;
			$offset		= 0;
			$limit		= 5;
			$orderby	= 'asc';
			$fieldname	= 't.order_id';
			$keywords   = array();
			$request->session()->forget('sessionData');
			$request->session()->forget('sessionUpdate');
			$request->session()->forget('$sessionInsert');
		}		
		$data['dataCount'] 	= Facilities::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords);
		$data['dataGrid']  	= Facilities::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords, $fieldname, $orderby, $limit, $offset);
		$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
		$data['title'] 		= $this->title;
		$data['heading'] 	= $this->heading;
		$data['module_ajaxurl']	= url('/').'/admin/facilities_ajax/';
		$data['orderby']	= 'asc';
		$data['fa_order']	= 'asc';
		if($fieldname=='t.order_id' && empty($keywords)){
		 	$data['hide_order']= 0;	
		 }else{
		 	$data['hide_order']= 1;	
		 }
		$data['update_id']  = !empty($sessionUpdate['updateid'])?$sessionUpdate['updateid']:'';	
		$data['insert_id']  = !empty($sessionInsert['insertid'])?$sessionInsert['insertid']:'';			
		$data['maxorder']   = Facilities::maxOrderId($this->tablename);	
		$data['minorder']   = Facilities::minOrderId($this->tablename);	
		$data['keywords'] 	= $keywords;
		$data['limit'] 		= $limit;
		return view('admin.facilities.index',['data' => $data]);
	}
	public function todo($type, Request $request){ // AJAX function
		$data = array();
		$sessionArray = array();		
		switch($type){
			case 'searching':$keywords 	= Input::all();	
							 /* SESSION VALUE */
							 $sessionGet = $request->session()->get('sessionData');	
							 $limit  	 = !empty($sessionGet['limit'])?$sessionGet['limit']:5;
							 $request->session()->forget('sessionData');
							 $sessionArray['keywords']	= $keywords;	
							 $sessionArray['orderby']	= 'asc';					 
							 $sessionArray['fieldname'] = 't.order_id';
							 $sessionArray['currpage']	= 1;							 
							 $sessionArray['offset'] 	= 0;
							 $sessionArray['limit'] 	= $limit;							 
							 $request->session()->put('sessionData', $sessionArray);
							  /* SESSION VALUE */							 
							 $data['dataCount'] 	= Facilities::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords);
							 $data['dataGrid']  	= Facilities::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords, 't.order_id', 'asc', $limit, 0);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],1,$limit);
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/facilities_ajax/';
							 $data['orderby']	= 'asc';
							 $data['fa_order']	= 'asc';
							 $data['hide_order']= 1;
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							 $data['maxorder']  = Facilities::maxOrderId($this->tablename);	
							 $data['minorder']  = Facilities::minOrderId($this->tablename);	 							 						 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;
							 return view('admin.facilities.listview',['data' => $data]);
							 break;
			case 'paging':	 $currpage 	= Input::get('currpage');
							 $limit 	= Input::get('limit');
							 $offset    = (($currpage * $limit)-$limit);							
							/* SESSION VALUE */							 
							 $sessionGet = $request->session()->get('sessionData');
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.order_id';
							 $keywords   = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();
							 $sessionArray['orderby']	= $orderby;
							 $sessionArray['fieldname']	= $fieldname;
							 $sessionArray['currpage']	= $currpage;							 
							 $sessionArray['offset'] 	= $offset;
							 $sessionArray['limit'] 	= $limit;
							 $sessionArray['keywords'] 	= $keywords;
							 $request->session()->put('sessionData', $sessionArray);							
							 /* SESSION VALUE */
							 $data['dataCount'] 	= Facilities::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords);
							 $data['dataGrid']  	= Facilities::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/facilities_ajax/';
							 $data['orderby']	= ($orderby=='asc')?'desc':'asc';
							 $data['fa_order']	= $orderby;
							 if($fieldname=='t.order_id' && empty($keywords)){
							 	$data['hide_order']= 0;	
							 }else{
							 	 $data['hide_order']= 1;	
							 }
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							 $data['maxorder']  = Facilities::maxOrderId($this->tablename);	
							 $data['minorder']  = Facilities::minOrderId($this->tablename);														 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;
							 return view('admin.facilities.listview',['data' => $data]);
							 break;
			case 'ordering': $orderby 	= Input::get('orderby');
							 $fieldname = Input::get('fieldname');							 
							 /* SESSION VALUE */
							 $sessionGet = $request->session()->get('sessionData');							 
							 $keywords   = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();
							 $limit  	 = !empty($sessionGet['limit'])?$sessionGet['limit']:5;
							 $sessionArray['orderby']	= $orderby;							 
							 $sessionArray['fieldname'] = $fieldname;
							 $sessionArray['currpage']	= 1;							 
							 $sessionArray['offset'] 	= 0;
							 $sessionArray['limit'] 	= $limit;
							 $sessionArray['keywords']  = $keywords;							 
							 $request->session()->put('sessionData', $sessionArray);
							 /* SESSION VALUE */	
							 							 
							 $data['dataCount'] 	= Facilities::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords);
							 $data['dataGrid']  	= Facilities::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, 0);
							 $data['pagenation'] 	= Pagenation::getGroupPagination($data['dataCount'],1, $limit);
							 $data['title'] 		= $this->title;
							 $data['heading'] 		= $this->heading;
							 $data['module_ajaxurl']= url('/').'/admin/facilities_ajax/';
							 $data['orderby']		= ($orderby=='asc')?'desc':'asc';
							 $data['fa_order']		= $orderby;
							 $data['hide_order']	= 1;	
							 $data['update_id'] 	= '';	
							 $data['insert_id'] 	= '';							 
							 $data['maxorder']   	= Facilities::maxOrderId($this->tablename);	
							 $data['minorder']   	= Facilities::minOrderId($this->tablename);								 					 $data['keywords'] 		= $keywords;
							 $data['limit'] 		= $limit;
							 return view('admin.facilities.listview',['data' => $data]);
							 break;				 
			case 'setactive':$sessionGet = array();
							 $newactive=0;
							 $primary_id = Input::get('dataid');
							 $active 	 = Input::get('currentval');
							 if($active==1){
							 	$newactive=0;
							 }elseif($active==0){
							 	$newactive=1;
							 }							 
							 /* SESSION VALUE */							 
							 $sessionGet = $request->session()->get('sessionData');
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.order_id';
							 $currpage	 = !empty($sessionGet['currpage'])?$sessionGet['currpage']:1;
							 $offset  	 = !empty($sessionGet['offset'])?$sessionGet['offset']:0;
							 $limit  	 = !empty($sessionGet['limit'])?$sessionGet['limit']:5;
							 $keywords   = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();	
							 $sessionArray['orderby']	= $orderby;							 
							 $sessionArray['fieldname'] = $fieldname;
							 $sessionArray['currpage']	= $currpage;							 
							 $sessionArray['offset'] 	= $offset;
							 $sessionArray['limit'] 	= $limit;							 
							 $sessionArray['keywords'] 	= $keywords;							 
							 $request->session()->put('sessionData', $sessionArray);							 
							 /* SESSION VALUE */							 						 
							 $update = Facilities::updateData($this->tablename, $data=array('is_active'=>$newactive,'updated_at'=>date('Y-m-d H:i:s')), $where=array('id'=>$primary_id));
							 $data['dataCount'] = Facilities::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords);
							 $data['dataGrid']  = Facilities::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation']= Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/facilities_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['update_id'] = '';
							 $data['insert_id'] = '';	
							 if($fieldname=='t.order_id' && empty($keywords)){
							 	$data['hide_order']= 0;	
							 }else{
							 	 $data['hide_order']= 1;	
							 }
							 $data['maxorder']  = Facilities::maxOrderId($this->tablename);	
							 $data['minorder']  = Facilities::minOrderId($this->tablename);
							 $data['limit'] 	= $limit;		
							 return view('admin.facilities.listview',['data' => $data]);
							 break;
			case 'orderup':  $primary_id = Input::get('dataid');
			                 $current_order_id = Input::get('noworder');
							 $orderup = Facilities::orderUp($this->tablename,$primary_id, $current_order_id);
							 
							 /* SESSION VALUE */							 
							 $sessionGet = $request->session()->get('sessionData');
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.order_id';
							 $currpage	 = !empty($sessionGet['currpage'])?$sessionGet['currpage']:1;
							 $offset  	 = !empty($sessionGet['offset'])?$sessionGet['offset']:0;
							 $limit  	 = !empty($sessionGet['limit'])?$sessionGet['limit']:5;
							 $keywords   = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();
							 $sessionArray['orderby']	= $orderby;							 
							 $sessionArray['fieldname'] = $fieldname;
							 $sessionArray['currpage']	= $currpage;							 
							 $sessionArray['offset'] 	= $offset;
							 $sessionArray['limit'] 	= $limit;
							 $sessionArray['keywords'] 	= array();							 
							 $request->session()->put('sessionData', $sessionArray);
							 $data['dataCount'] 	= Facilities::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords=array());
							 $data['dataGrid']  	= Facilities::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords=array(), $fieldname, $orderby, $limit, $offset);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/facilities_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['hide_order']= 0;
							 $data['update_id'] = '';
							 $data['insert_id'] = '';	
							 $data['maxorder']  = Facilities::maxOrderId($this->tablename);	
							 $data['minorder']  = Facilities::minOrderId($this->tablename);
							 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;			
							 return view('admin.facilities.listview',['data' => $data]);
							 break;
			case 'orderdown':$primary_id = Input::get('dataid');
							 $current_order_id = Input::get('noworder');
							 $orderup = Facilities::orderDown($this->tablename,$primary_id, $current_order_id);	
							 /* SESSION VALUE */							 
							 $sessionGet = $request->session()->get('sessionData');
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.order_id';
							 $currpage	 = !empty($sessionGet['currpage'])?$sessionGet['currpage']:1;
							 $offset  	 = !empty($sessionGet['offset'])?$sessionGet['offset']:0;
							 $limit  	 = !empty($sessionGet['limit'])?$sessionGet['limit']:5;
							 $keywords   = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();
							 $sessionArray['orderby']	= $orderby;							 
							 $sessionArray['fieldname'] = $fieldname;
							 $sessionArray['currpage']	= $currpage;							 
							 $sessionArray['offset'] 	= $offset;
							 $sessionArray['limit'] 	= $limit;	
							 $sessionArray['keywords'] 	= array();						 
							 $request->session()->put('sessionData', $sessionArray);							 
							 $data['dataCount'] 	= Facilities::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords=array());
							 $data['dataGrid']  	= Facilities::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords=array(), $fieldname, $orderby, $limit, $offset);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 							 							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/facilities_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['hide_order']= 0;
							 $data['update_id'] = '';
							 $data['insert_id'] = '';
							 $data['maxorder']  = Facilities::maxOrderId($this->tablename);	
							 $data['minorder']  = Facilities::minOrderId($this->tablename);	
							 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;		
							 return view('admin.facilities.listview',['data' => $data]);
							 break;
			case 'delete':	$sessionGet = array();
							 $primary_id = Input::get('dataid');							 						 
							 /* SESSION VALUE */							 
							 $sessionGet = $request->session()->get('sessionData');
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.order_id';
							 $currpage	 = !empty($sessionGet['currpage'])?$sessionGet['currpage']:1;
							 $offset  	 = !empty($sessionGet['offset'])?$sessionGet['offset']:0;
							 $limit  	 = !empty($sessionGet['limit'])?$sessionGet['limit']:5;
							 $keywords   = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();
							 
							 $sessionArray['orderby']	= $orderby;							 
							 $sessionArray['fieldname'] = $fieldname;
							 $sessionArray['currpage']	= $currpage;							 
							 $sessionArray['offset'] 	= $offset;
							 $sessionArray['limit'] 	= $limit;							 
							 $sessionArray['keywords'] 	= $keywords;							 
							 $request->session()->put('sessionData', $sessionArray);							 
							 /* SESSION VALUE */								 						 
							 $delete = Facilities::deleteData($this->tablename, $primary_id);
							 $data['dataCount'] = Facilities::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords);
							 $data['dataGrid']  = Facilities::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation']= Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/facilities_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							 if($fieldname=='t.order_id' && empty($keywords)){
							 	$data['hide_order'] = 0;	
							 }else{
							 	$data['hide_order'] = 1;	
							 }	
							 $data['maxorder']   = Facilities::maxOrderId($this->tablename);	
							 $data['minorder']   = Facilities::minOrderId($this->tablename);	
							 $data['keywords'] 	 = $keywords;
							 $data['limit'] 	 = $limit;	
							 return view('admin.facilities.listview',['data' => $data]);
							 break;
				case 'perpage':$sessionGet = array();
							 $newlimit = Input::get('limit');							 						 
							 /* SESSION VALUE */							 
							 $sessionGet = $request->session()->get('sessionData');
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.order_id';
							 $currpage	 = 1;
							 $offset  	 = 0;
							 $limit  	 = $newlimit;
							 $keywords   = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();	
							 $sessionArray['orderby']	= $orderby;							 
							 $sessionArray['fieldname'] = $fieldname;
							 $sessionArray['currpage']	= $currpage;							 
							 $sessionArray['offset'] 	= $offset;
							 $sessionArray['limit'] 	= $limit;							 
							 $sessionArray['keywords'] 	= $keywords;							 
							 $request->session()->put('sessionData', $sessionArray);							 
							 /* SESSION VALUE */
							 $data['dataCount'] = Facilities::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords);
							 $data['dataGrid']  = Facilities::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation']= Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/facilities_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							 if($fieldname=='t.order_id' && empty($keywords)){
							 	$data['hide_order'] = 0;	
							 }else{
							 	$data['hide_order'] = 1;	
							 }	
							 $data['maxorder']   = Facilities::maxOrderId($this->tablename);	
							 $data['minorder']   = Facilities::minOrderId($this->tablename);	
							 $data['keywords'] 	 = $keywords;	
							 $data['limit'] 	 = $limit;	
							 return view('admin.facilities.listview',['data' => $data]);
							 break;
		}
	}
	
	public function update($id = '', Request $request) {
		$data = array();
		$language = Languagehelper::getlanguage();
		$todo = Input::get('todo');		
		/* SESSION VALUE */							 
			 $sessionGet = $request->session()->get('sessionData');
			 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
			 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.order_id';
			 $currpage	 = !empty($sessionGet['currpage'])?$sessionGet['currpage']:1;
			 $offset  	 = !empty($sessionGet['offset'])?$sessionGet['offset']:0;
			 $limit  	 = !empty($sessionGet['limit'])?$sessionGet['limit']:5;
			 $keywords   = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();			 
			 $sessionArray['orderby']	= $orderby;							 
			 $sessionArray['fieldname'] = $fieldname;
			 $sessionArray['currpage']	= $currpage;							 
			 $sessionArray['offset'] 	= $offset;
			 $sessionArray['limit'] 	= $limit;							 
			 $sessionArray['keywords'] 	= $keywords;							 
			 $request->session()->put('sessionData', $sessionArray);
		/* SESSION VALUE */
		if($todo=='saverec'){	
				$is_active = (!isset($request->is_active)?0:1);					
				$update = Facilities::updateData($this->tablename, $data=array('is_active'=>$is_active,'updated_at'=>date('Y-m-d H:i:s')), $where=array('id'=>$id));								
				$update = Facilities::updateData('facilities_translation', $data=array('facilities_name'=>$request->facilities_name_1), $where=array('facilities_id'=>$id,'language_id'=>1));				
				$update = Facilities::updateData('facilities_translation', $data=array('facilities_name'=>$request->facilities_name_2), $where=array('facilities_id'=>$id,'language_id'=>2));				
				$sessionUpdate['updateid'] 	= $id;
				$sessionUpdate['isupdate'] 	= 1;				 
				$request->session()->put('sessionUpdate', $sessionUpdate);									
				echo '1';
				return;
		}	
			
		$sessionUpdate['updateid'] 	= 0;
		$sessionUpdate['isupdate'] 	= 1;				 
		$request->session()->put('sessionUpdate', $sessionUpdate);	
							
		$facilities = DB::table('facilities as acco')
			->select('*')
			->join('facilities_translation as atrans', 'acco.id', '=', 'atrans.facilities_id')
			->where('acco.id', $id)
			->get();		
		$data['title'] 		= 'Update '.$this->heading;
		$data['heading'] 	= $this->heading;
		$data['subHeading'] = 'Update '.$this->heading;
		$data['saveBtn'] 	= 'Save';
		$data['todo'] 		= 'saverec';
		$data['language'] 	=  $language;
		$data['dataset'] 	=  $facilities;
		$data['id'] 		=  $id;		
		return view('admin.facilities.facilities', ['data' => $data]);
	}
	
	public function create(Request $request) {
		$data = array();
		$language = Languagehelper::getlanguage();
		$todo = Input::get('todo');
		if($todo=='addrec'){
			$is_active = (!isset($request->is_active)?0:1);
			$max_order = DB::table($this->tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_facilities)"))->get();
			$facilitiesId = DB::table($this->tablename)->insertGetId(
					['is_active' => $is_active, 'order_id' => $max_order[0]->order_id + 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
				);
			DB::table('facilities_translation')->insert([
					['facilities_id' => $facilitiesId, 'language_id' => 1, 'facilities_name' => $request->facilities_name_1],
					['facilities_id' => $facilitiesId, 'language_id' => 2, 'facilities_name' => $request->facilities_name_2],
				]);
			$sessionInsert['insertid'] 	= $facilitiesId;
			$sessionInsert['isinsert'] 	= 1;				 
			$request->session()->put('sessionInsert', $sessionInsert);
			echo '1';
			return;
		}
		$data['title'] 		= 'Add '.$this->heading;
		$data['heading'] 	= $this->heading;
		$data['subHeading'] = 'Add '.$this->heading;
		$data['saveBtn'] 	= 'Add';
		$data['todo'] 		= 'addrec';
		$data['language'] 	=  $language;
		$data['dataset'] 	=  array();
		$data['id'] 		=  '';
		return view('admin.facilities.facilities', ['data' => $data]);
	}	
}