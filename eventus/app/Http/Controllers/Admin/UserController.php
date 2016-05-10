<?php
namespace App\Http\Controllers\admin;
use App\Helper\Languagehelper;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\Admin\Pagenation;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Lang;
class UserController extends Controller {
	
	protected $tablename;
	protected $title;
	protected $subtitle;
	protected $heading;
	protected $language;
	
	public function __construct() {
		$this->middleware('admins');
		$this->tablename = 'users';
		$this->title 	 = 'Users';
		$this->subtitle  = 'Users';
		$this->heading   = 'Users';
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
		 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'desc';
		 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.id';
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
			$orderby	= 'desc';
			$fieldname	= 't.id';
			$keywords   = array();
			$request->session()->forget('sessionData');
			$request->session()->forget('sessionUpdate');
			$request->session()->forget('$sessionInsert');
		}		
		$data['dataCount'] 	= User::totalRecord('*', $this->tablename, $where=array(),$keywords);
		$data['dataGrid']  	= User::totalGrid('*', $this->tablename, $where=array(),$keywords, $fieldname, $orderby, $limit, $offset);
		$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
		$data['title'] 		= $this->title;
		$data['heading'] 	= $this->heading;
		$data['module_ajaxurl']	= url('/').'/admin/user_ajax/';
		$data['orderby']	= 'desc';
		$data['fa_order']	= 'desc';
		if($fieldname=='t.id' && empty($keywords)){
		 	$data['hide_order']= 0;	
		 }else{
		 	$data['hide_order']= 1;	
		 }
		$data['update_id']  = !empty($sessionUpdate['updateid'])?$sessionUpdate['updateid']:'';	
		$data['insert_id']  = !empty($sessionInsert['insertid'])?$sessionInsert['insertid']:'';			
		//$data['maxorder']   = User::maxOrderId($this->tablename);	
		//$data['minorder']   = User::minOrderId($this->tablename);	
		$data['keywords'] 	= $keywords;
		$data['limit'] 		= $limit;
		$data['city'] 		= User::MultiRecords('location_translation',$where=array('language_id'=>1));
		$data['state'] 		= User::MultiRecords('province',$where=array());
		return view('admin.user.index',['data' => $data]);
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
							 $sessionArray['orderby']	= 'desc';					 
							 $sessionArray['fieldname'] = 't.id';
							 $sessionArray['currpage']	= 1;							 
							 $sessionArray['offset'] 	= 0;
							 $sessionArray['limit'] 	= $limit;							 
							 $request->session()->put('sessionData', $sessionArray);
							  /* SESSION VALUE */							 
							 $data['dataCount'] 	= User::totalRecord('*', $this->tablename, $where=array(),$keywords);
							 $data['dataGrid']  	= User::totalGrid('*', $this->tablename, $where=array(),$keywords, 't.id', 'asc', $limit, 0);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],1,$limit);
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/user_ajax/';
							 $data['orderby']	= 'asc';
							 $data['fa_order']	= 'asc';
							 $data['hide_order']= 1;
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							// $data['maxorder']  = User::maxOrderId($this->tablename);	
							// // $data['minorder']  = User::minOrderId($this->tablename);	 							 						 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;
							 return view('admin.user.listview',['data' => $data]);
							 break;
			case 'paging':	 $currpage 	= Input::get('currpage');
							 $limit 	= Input::get('limit');
							 $offset    = (($currpage * $limit)-$limit);							
							/* SESSION VALUE */							 
							 $sessionGet = $request->session()->get('sessionData');
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'desc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.id';
							 $keywords   = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();
							 $sessionArray['orderby']	= $orderby;
							 $sessionArray['fieldname']	= $fieldname;
							 $sessionArray['currpage']	= $currpage;							 
							 $sessionArray['offset'] 	= $offset;
							 $sessionArray['limit'] 	= $limit;
							 $sessionArray['keywords'] 	= $keywords;
							 $request->session()->put('sessionData', $sessionArray);							
							 /* SESSION VALUE */
							 $data['dataCount'] 	= User::totalRecord('*', $this->tablename, $where=array(), $keywords);
							 $data['dataGrid']  	= User::totalGrid('*', $this->tablename, $where=array(), $keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/user_ajax/';
							 $data['orderby']	= ($orderby=='asc')?'desc':'asc';
							 $data['fa_order']	= $orderby;
							 if($fieldname=='t.id' && empty($keywords)){
							 	$data['hide_order']= 0;	
							 }else{
							 	 $data['hide_order']= 1;	
							 }
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							// $data['maxorder']  = User::maxOrderId($this->tablename);	
							 // $data['minorder']  = User::minOrderId($this->tablename);														 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;
							 return view('admin.user.listview',['data' => $data]);
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
							 							 
							 $data['dataCount'] 	= User::totalRecord('*', $this->tablename, $where=array(), $keywords);
							 $data['dataGrid']  	= User::totalGrid('*', $this->tablename, $where=array(), $keywords, $fieldname, $orderby, $limit, 0);
							 $data['pagenation'] 	= Pagenation::getGroupPagination($data['dataCount'],1, $limit);
							 $data['title'] 		= $this->title;
							 $data['heading'] 		= $this->heading;
							 $data['module_ajaxurl']= url('/').'/admin/user_ajax/';
							 $data['orderby']		= ($orderby=='asc')?'desc':'asc';
							 $data['fa_order']		= $orderby;
							 $data['hide_order']	= 1;	
							 $data['update_id'] 	= '';	
							 $data['insert_id'] 	= '';							 
							// $data['maxorder']   	= User::maxOrderId($this->tablename);	
							// $data['minorder']   	= User::minOrderId($this->tablename);								 					 $data['keywords'] 		= $keywords;
							 $data['limit'] 		= $limit;
							 return view('admin.user.listview',['data' => $data]);
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
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'desc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.id';
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
							 $update = User::updateData($this->tablename, $data=array('is_active'=>$newactive,'updated_at'=>date('Y-m-d H:i:s')), $where=array('id'=>$primary_id));
							 $data['dataCount'] = User::totalRecord('*', $this->tablename, $where=array(),$keywords);
							 $data['dataGrid']  = User::totalGrid('*', $this->tablename, $where=array(),$keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation']= Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/user_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['update_id'] = '';
							 $data['insert_id'] = '';	
							 if($fieldname=='t.id' && empty($keywords)){
							 	$data['hide_order']= 0;	
							 }else{
							 	 $data['hide_order']= 1;	
							 }
							// $data['maxorder']  = User::maxOrderId($this->tablename);	
							 // $data['minorder']  = User::minOrderId($this->tablename);
							 $data['limit'] 	= $limit;		
							 return view('admin.user.listview',['data' => $data]);
							 break;
			case 'orderup':  $primary_id = Input::get('dataid');
			                 $current_id = Input::get('noworder');
							 $orderup = User::orderUp($this->tablename,$primary_id, $current_id);
							 
							 /* SESSION VALUE */							 
							 $sessionGet = $request->session()->get('sessionData');
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'desc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.id';
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
							 $data['dataCount'] 	= User::totalRecord('*', $this->tablename, $where=array(),$keywords=array());
							 $data['dataGrid']  	= User::totalGrid('*', $this->tablename, $where=array(),$keywords=array(), $fieldname, $orderby, $limit, $offset);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/user_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['hide_order']= 0;
							 $data['update_id'] = '';
							 $data['insert_id'] = '';	
							// $data['maxorder']  = User::maxOrderId($this->tablename);	
							 // $data['minorder']  = User::minOrderId($this->tablename);
							 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;			
							 return view('admin.user.listview',['data' => $data]);
							 break;
			case 'orderdown':$primary_id = Input::get('dataid');
							 $current_id = Input::get('noworder');
							 $orderup = User::orderDown($this->tablename,$primary_id, $current_id);	
							 /* SESSION VALUE */							 
							 $sessionGet = $request->session()->get('sessionData');
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'desc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.id';
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
							 $data['dataCount'] 	= User::totalRecord('*', $this->tablename, $where=array(),$keywords=array());
							 $data['dataGrid']  	= User::totalGrid('*', $this->tablename, $where=array(),$keywords=array(), $fieldname, $orderby, $limit, $offset);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 							 							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/user_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['hide_order']= 0;
							 $data['update_id'] = '';
							 $data['insert_id'] = '';
							// $data['maxorder']  = User::maxOrderId($this->tablename);	
							 // $data['minorder']  = User::minOrderId($this->tablename);	
							 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;		
							 return view('admin.user.listview',['data' => $data]);
							 break;
			case 'delete':	$sessionGet = array();
							 $primary_id = Input::get('dataid');							 						 
							 /* SESSION VALUE */							 
							 $sessionGet = $request->session()->get('sessionData');
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'desc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.id';
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
							 $delete = User::deleteData($this->tablename, $primary_id);
							 $data['dataCount'] = User::totalRecord('*', $this->tablename, $where=array(),$keywords);
							 $data['dataGrid']  = User::totalGrid('*', $this->tablename, $where=array(),$keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation']= Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/user_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							 if($fieldname=='t.id' && empty($keywords)){
							 	$data['hide_order'] = 0;	
							 }else{
							 	$data['hide_order'] = 1;	
							 }	
							 //$data['maxorder']   = User::maxOrderId($this->tablename);	
							// $data['minorder']   = User::minOrderId($this->tablename);	
							 $data['keywords'] 	 = $keywords;
							 $data['limit'] 	 = $limit;	
							 return view('admin.user.listview',['data' => $data]);
							 break;
				case 'perpage':$sessionGet = array();
							 $newlimit = Input::get('limit');							 						 
							 /* SESSION VALUE */							 
							 $sessionGet = $request->session()->get('sessionData');
							 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'desc';
							 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.id';
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
							 $data['dataCount'] = User::totalRecord('*', $this->tablename, $where=array(),$keywords);
							 $data['dataGrid']  = User::totalGrid('*', $this->tablename, $where=array(),$keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation']= Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/user_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							 if($fieldname=='t.id' && empty($keywords)){
							 	$data['hide_order'] = 0;	
							 }else{
							 	$data['hide_order'] = 1;	
							 }	
							 //$data['maxorder']   = User::maxOrderId($this->tablename);	
							 //$data['minorder']   = User::minOrderId($this->tablename);	
							 $data['keywords'] 	 = $keywords;	
							 $data['limit'] 	 = $limit;	
							 return view('admin.user.listview',['data' => $data]);
							 break;
		}
	}
	
	public function update($id = '', Request $request) {
		$data = array();
		$language = Languagehelper::getlanguage();
		$todo = Input::get('todo');		
		/* SESSION VALUE */							 
			 $sessionGet = $request->session()->get('sessionData');
			 $orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'desc';
			 $fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.id';
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
				$is_active = isset($request->is_active)?1:0;
				$update = User::updateData($this->tablename, $data=array(				  				 
			 	 'first_name' 	=> trim($request->first_name),
				 'last_name'	=> trim($request->last_name),				 
			 	 'address' 		=> trim($request->address), 
				 'city' 		=> trim($request->city), 
				 'state' 		=> trim($request->state), 
			 	 'postcode' 	=> trim($request->postcode),  
			 	 'is_active' 	=> $is_active,
			 	 'updated_at' 	=> date('Y-m-d H:i:s') ), 				
				$where=array('id'=>$id));								
								
				$sessionUpdate['updateid'] 	= $id;
				$sessionUpdate['isupdate'] 	= 1;				 
				$request->session()->put('sessionUpdate', $sessionUpdate);									
				echo '1';
				return;
		}	
			
		$sessionUpdate['updateid'] 	= 0;
		$sessionUpdate['isupdate'] 	= 1;				 
		$request->session()->put('sessionUpdate', $sessionUpdate);	
							
		$user = DB::table('users as acco')
			->select('*')			
			->where('acco.id', $id)
			->get();		
		$data['title'] 		= 'Update '.$this->heading;
		$data['heading'] 	= $this->heading;
		$data['subHeading'] = 'Update '.$this->heading;
		$data['saveBtn'] 	= 'Save';
		$data['todo'] 		= 'saverec';
		$data['language'] 	=  $language;
		$data['dataset'] 	=  $user;
		$data['id'] 		=  $id;	
		$data['city'] 		=  User::MultiRecords('location_translation',$where=array('language_id'=>1));
		$data['state'] 		=  User::MultiRecords('province',$where=array());
		return view('admin.user.user', ['data' => $data]);
	}
	
	public function create(Request $request) {
		$data = array();
		$language = Languagehelper::getlanguage();
		$todo = Input::get('todo');
		if($todo=='addrec'){
			$this->validate($request, [
			'email' => 'required|email|max:255|unique:users',
			'contact_number' => 'required|min:10|numeric|unique:users',
			]);
			$userId = DB::table($this->tablename)->insertGetId(
					['email' 		=> trim($request->email), 
					 'password' 	=> Hash::make($request->password), 
 					 'first_name' 	=> trim($request->first_name),
					 'last_name'	=> trim($request->last_name), 
					 'contact_number' => trim($request->contact_number), 
 					 'address' 		=> trim($request->address), 
					 'city' 		=> trim($request->city), 
					 'state' 		=> trim($request->state), 
 					 'postcode' 	=> trim($request->postcode),  
 					 'is_active' 	=> $request->is_active,  
					 'created_at' 	=> date('Y-m-d H:i:s'), 
					 'updated_at' 	=> date('Y-m-d H:i:s')]
				);
			
			$sessionInsert['insertid'] 	= $userId;
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
		$data['city'] 		=  User::MultiRecords('location_translation',$where=array('language_id'=>1));
		$data['state'] 		=  User::MultiRecords('province',$where=array());
		return view('admin.user.user', ['data' => $data]);
	}	
}