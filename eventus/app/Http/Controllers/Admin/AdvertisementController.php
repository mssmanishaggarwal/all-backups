<?php
namespace App\Http\Controllers\admin;
use App\Helper\Languagehelper;
use App\Http\Controllers\Controller;
use App\Models\Admin\Advertisement;
use App\Models\Admin\Pagenation;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Lang;
class AdvertisementController extends Controller {
	
	protected $tablename;
	protected $title;
	protected $subtitle;
	protected $heading;
	protected $language;
	
	public function __construct() {
		$this->middleware('admins');
		$this->tablename = 'advertisement';
		$this->title 	 = 'advertisement';
		$this->subtitle  = 'advertisement';
		$this->heading   = 'Advertisement';
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
		$data['dataCount'] 	= Advertisement::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords);
		$data['dataGrid']  	= Advertisement::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords, $fieldname, $orderby, $limit, $offset);
		$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
		$data['title'] 		= $this->title;
		$data['heading'] 	= $this->heading;
		$data['module_ajaxurl']	= url('/').'/admin/advertisement_ajax/';
		$data['orderby']	= 'asc';
		$data['fa_order']	= 'asc';
		if($fieldname=='t.order_id' && empty($keywords)){
		 	$data['hide_order']= 0;	
		 }else{
		 	$data['hide_order']= 1;	
		 }
		$data['update_id']  = !empty($sessionUpdate['updateid'])?$sessionUpdate['updateid']:'';	
		$data['insert_id']  = !empty($sessionInsert['insertid'])?$sessionInsert['insertid']:'';			
		$data['maxorder']   = Advertisement::maxOrderId($this->tablename);	
		$data['minorder']   = Advertisement::minOrderId($this->tablename);	
		$data['keywords'] 	= $keywords;
		$data['limit'] 		= $limit;
		return view('admin.advertisement.index',['data' => $data]);
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
							 $data['dataCount'] 	= Advertisement::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords);
							 $data['dataGrid']  	= Advertisement::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords, 't.order_id', 'asc', $limit, 0);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],1,$limit);
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/advertisement_ajax/';
							 $data['orderby']	= 'asc';
							 $data['fa_order']	= 'asc';
							 $data['hide_order']= 1;
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							 $data['maxorder']  = Advertisement::maxOrderId($this->tablename);	
							 $data['minorder']  = Advertisement::minOrderId($this->tablename);	 							 						 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;
							 return view('admin.advertisement.listview',['data' => $data]);
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
							 $data['dataCount'] 	= Advertisement::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords);
							 $data['dataGrid']  	= Advertisement::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/advertisement_ajax/';
							 $data['orderby']	= ($orderby=='asc')?'desc':'asc';
							 $data['fa_order']	= $orderby;
							 if($fieldname=='t.order_id' && empty($keywords)){
							 	$data['hide_order']= 0;	
							 }else{
							 	 $data['hide_order']= 1;	
							 }
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							 $data['maxorder']  = Advertisement::maxOrderId($this->tablename);	
							 $data['minorder']  = Advertisement::minOrderId($this->tablename);														 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;
							 return view('admin.advertisement.listview',['data' => $data]);
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
							 							 
							 $data['dataCount'] 	= Advertisement::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords);
							 $data['dataGrid']  	= Advertisement::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, 0);
							 $data['pagenation'] 	= Pagenation::getGroupPagination($data['dataCount'],1, $limit);
							 $data['title'] 		= $this->title;
							 $data['heading'] 		= $this->heading;
							 $data['module_ajaxurl']= url('/').'/admin/advertisement_ajax/';
							 $data['orderby']		= ($orderby=='asc')?'desc':'asc';
							 $data['fa_order']		= $orderby;
							 $data['hide_order']	= 1;	
							 $data['update_id'] 	= '';	
							 $data['insert_id'] 	= '';							 
							 $data['maxorder']   	= Advertisement::maxOrderId($this->tablename);	
							 $data['minorder']   	= Advertisement::minOrderId($this->tablename);								 					 $data['keywords'] 		= $keywords;
							 $data['limit'] 		= $limit;
							 return view('admin.advertisement.listview',['data' => $data]);
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
							 $update = Advertisement::updateData($this->tablename, $data=array('is_active'=>$newactive,'updated_at'=>date('Y-m-d H:i:s')), $where=array('id'=>$primary_id));
							 $data['dataCount'] = Advertisement::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords);
							 $data['dataGrid']  = Advertisement::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation']= Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/advertisement_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['update_id'] = '';
							 $data['insert_id'] = '';	
							 if($fieldname=='t.order_id' && empty($keywords)){
							 	$data['hide_order']= 0;	
							 }else{
							 	 $data['hide_order']= 1;	
							 }
							 $data['maxorder']  = Advertisement::maxOrderId($this->tablename);	
							 $data['minorder']  = Advertisement::minOrderId($this->tablename);
							 $data['limit'] 	= $limit;		
							 return view('admin.advertisement.listview',['data' => $data]);
							 break;
			case 'orderup':  $primary_id = Input::get('dataid');
			                 $current_order_id = Input::get('noworder');
							 $orderup = Advertisement::orderUp($this->tablename,$primary_id, $current_order_id);
							 
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
							 $data['dataCount'] 	= Advertisement::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords=array());
							 $data['dataGrid']  	= Advertisement::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords=array(), $fieldname, $orderby, $limit, $offset);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/advertisement_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['hide_order']= 0;
							 $data['update_id'] = '';
							 $data['insert_id'] = '';	
							 $data['maxorder']  = Advertisement::maxOrderId($this->tablename);	
							 $data['minorder']  = Advertisement::minOrderId($this->tablename);
							 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;			
							 return view('admin.advertisement.listview',['data' => $data]);
							 break;
			case 'orderdown':$primary_id = Input::get('dataid');
							 $current_order_id = Input::get('noworder');
							 $orderup = Advertisement::orderDown($this->tablename,$primary_id, $current_order_id);	
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
							 $data['dataCount'] 	= Advertisement::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords=array());
							 $data['dataGrid']  	= Advertisement::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords=array(), $fieldname, $orderby, $limit, $offset);
							 $data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 							 							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/advertisement_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['hide_order']= 0;
							 $data['update_id'] = '';
							 $data['insert_id'] = '';
							 $data['maxorder']  = Advertisement::maxOrderId($this->tablename);	
							 $data['minorder']  = Advertisement::minOrderId($this->tablename);	
							 $data['keywords'] 	= $keywords;
							 $data['limit'] 	= $limit;		
							 return view('admin.advertisement.listview',['data' => $data]);
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
							 $delete = Advertisement::deleteData($this->tablename, $primary_id);
							 $data['dataCount'] = Advertisement::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords);
							 $data['dataGrid']  = Advertisement::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation']= Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/advertisement_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							 if($fieldname=='t.order_id' && empty($keywords)){
							 	$data['hide_order'] = 0;	
							 }else{
							 	$data['hide_order'] = 1;	
							 }	
							 $data['maxorder']   = Advertisement::maxOrderId($this->tablename);	
							 $data['minorder']   = Advertisement::minOrderId($this->tablename);	
							 $data['keywords'] 	 = $keywords;
							 $data['limit'] 	 = $limit;	
							 return view('admin.advertisement.listview',['data' => $data]);
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
							 $data['dataCount'] = Advertisement::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords);
							 $data['dataGrid']  = Advertisement::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords, $fieldname, $orderby, $limit, $offset);
							 $data['pagenation']= Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
							 
							 $data['title'] 	= $this->title;
							 $data['heading'] 	= $this->heading;
							 $data['module_ajaxurl']	= url('/').'/admin/advertisement_ajax/';
							 $data['orderby']	= $orderby;
							 $data['fa_order']	= $orderby;
							 $data['update_id'] = '';	
							 $data['insert_id'] = '';
							 if($fieldname=='t.order_id' && empty($keywords)){
							 	$data['hide_order'] = 0;	
							 }else{
							 	$data['hide_order'] = 1;	
							 }	
							 $data['maxorder']   = Advertisement::maxOrderId($this->tablename);	
							 $data['minorder']   = Advertisement::minOrderId($this->tablename);	
							 $data['keywords'] 	 = $keywords;	
							 $data['limit'] 	 = $limit;	
							 return view('admin.advertisement.listview',['data' => $data]);
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
				$files = Input::file('advertisement_image');
				if($files) {
					extract($_POST);
					$error = array();
		  			$extension = array("jpeg", "jpg", "png", "gif");
					$file_name = $_FILES["advertisement_image"]["name"];
		   			$file_tmp = $_FILES["advertisement_image"]["tmp_name"];
		   			$ext = pathinfo($file_name, PATHINFO_EXTENSION);
					if(in_array($ext, $extension)) {
						if(!file_exists("public/uploads/advertisement/" . $file_name)) {
					    	move_uploaded_file($file_tmp = $_FILES["advertisement_image"]["tmp_name"], "public/uploads/advertisement/" . $file_name);
					     $request->advertisement_image = $file_name;
					    } else {
					    	$filename = basename($file_name, $ext);
					    	$newFileName = $filename . time() . "." . $ext;
					    	move_uploaded_file($file_tmp = $_FILES["advertisement_image"]["tmp_name"], "public/uploads/advertisement/" . $newFileName);
					     $request->advertisement_image = $file_name;
					    }
					 }
				}	
				$is_active = (!isset($request->is_active)?0:1);	
				if(!empty($request->advertisement_image)) {				
					$update = Advertisement::updateData($this->tablename, $data=array('is_active'=>$is_active,'advertisement_link'=>$request->advertisement_link,'advertisement_image'=>$request->advertisement_image,'position_id'=>$request->position_id,'start_date'=>$request->start_date,'end_date'=>$request->end_date,'updated_at'=>date('Y-m-d H:i:s')), $where=array('id'=>$id));		
				} else {
					$update = Advertisement::updateData($this->tablename, $data=array('is_active'=>$is_active,'advertisement_link'=>$request->advertisement_link,'position_id'=>$request->position_id,'start_date'=>$request->start_date,'end_date'=>$request->end_date,'updated_at'=>date('Y-m-d H:i:s')), $where=array('id'=>$id));
				}						
				$update = Advertisement::updateData('advertisement_translation', $data=array('advertisement_title'=>$request->advertisement_title_1), $where=array('advertisement_id'=>$id,'language_id'=>1));				
				$update = Advertisement::updateData('advertisement_translation', $data=array('advertisement_title'=>$request->advertisement_title_2), $where=array('advertisement_id'=>$id,'language_id'=>2));				
				$sessionUpdate['updateid'] 	= $id;
				$sessionUpdate['isupdate'] 	= 1;				 
				$request->session()->put('sessionUpdate', $sessionUpdate);									
				//echo '1';
				//return;
				return redirect('/admin/advertisement_list');
		}	
			
		$sessionUpdate['updateid'] 	= 0;
		$sessionUpdate['isupdate'] 	= 1;				 
		$request->session()->put('sessionUpdate', $sessionUpdate);	
							
		$advertisement = DB::table('advertisement as acco')
			->select('*')
			->join('advertisement_translation as atrans', 'acco.id', '=', 'atrans.advertisement_id')
			->where('acco.id', $id)
			->get();		
		$data['title'] 		= 'Update '.$this->heading;
		$data['heading'] 	= $this->heading;
		$data['subHeading'] = 'Update '.$this->heading;
		$data['saveBtn'] 	= 'Save';
		$data['todo'] 		= 'saverec';
		$data['language'] 	=  $language;
		$data['dataset'] 	=  $advertisement;
		$data['id'] 		=  $id;	
		$data['position'] 	= Advertisement::MultiRecords('position',$where=array());
		$data['url'] 	    = url('/').'/admin/advertisement/'.$id;	
		return view('admin.advertisement.advertisement', ['data' => $data]);
	}
	
	public function create(Request $request) {
		$data = array();
		$language = Languagehelper::getlanguage();
		$todo = Input::get('todo');
		if($todo=='addrec'){
		$files = Input::file('advertisement_image');
				if($files) {
					extract($_POST);
					$error = array();
		  			$extension = array("jpeg", "jpg", "png", "gif");
					$file_name = $_FILES["advertisement_image"]["name"];
		   			$file_tmp = $_FILES["advertisement_image"]["tmp_name"];
		   			$ext = pathinfo($file_name, PATHINFO_EXTENSION);
					if(in_array($ext, $extension)) {
						if(!file_exists("public/uploads/advertisement/" . $file_name)) {
					    	move_uploaded_file($file_tmp = $_FILES["advertisement_image"]["tmp_name"], "public/uploads/advertisement/" . $file_name);
					     $request->advertisement_image = $file_name;
					    } else {
					    	$filename = basename($file_name, $ext);
					    	$newFileName = $filename . time() . "." . $ext;
					    	move_uploaded_file($file_tmp = $_FILES["advertisement_image"]["tmp_name"], "public/uploads/advertisement/" . $newFileName);
					     $request->advertisement_image = $file_name;
					    }
					 }
				}	
				$is_active = (!isset($request->is_active)?0:1);
			$max_order = DB::table($this->tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_advertisement)"))->get();
			if(count($max_order) == 0)
			$max_order_val = 1;
			else
			$max_order_val = $max_order[0]->order_id + 1;
			
			$advertisementId = DB::table($this->tablename)->insertGetId(
					['is_active' => $is_active,'advertisement_link'=>$request->advertisement_link,'advertisement_image' => $request->advertisement_image,'position_id'=>$request->position_id,'start_date'=>$request->start_date,'end_date'=>$request->end_date, 'order_id' => $max_order_val, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
				);
			DB::table('advertisement_translation')->insert([
					['advertisement_id' => $advertisementId, 'language_id' => 1, 'advertisement_title' => $request->advertisement_title_1],
					['advertisement_id' => $advertisementId, 'language_id' => 2, 'advertisement_title' => $request->advertisement_title_2],
				]);
			$sessionInsert['insertid'] 	= $advertisementId;
			$sessionInsert['isinsert'] 	= 1;				 
			$request->session()->put('sessionInsert', $sessionInsert);
			//echo '1';
			//return;
			return redirect('/admin/advertisement_list'); 
		}
		
		$data['title'] 		= 'Add '.$this->heading;
		$data['heading'] 	= $this->heading;
		$data['subHeading'] = 'Add '.$this->heading;
		$data['saveBtn'] 	= 'Add';
		$data['todo'] 		= 'addrec';
		$data['language'] 	=  $language;
		$data['dataset'] 	=  array();
		$data['id'] 		=  '';
		$data['position'] 	= Advertisement::MultiRecords('position',$where=array());
		$data['url'] 		=  url('/').'/admin/advertisement';
		return view('admin.advertisement.advertisement', ['data' => $data]);
	}	

	public function statistics(Request $request) {
		$data = array();
		$language = Languagehelper::getlanguage();
		$advertisement_id = $request->id;
		if($request->Search_from_date != '' && $request->Search_to_date != '')
		{
			$Search_from_date 			  = $request->Search_from_date;
			$Search_from_date 			  = date("Y-m-d",strtotime(str_replace('/','-',$Search_from_date)));
			
			$Search_to_date 			  = $request->Search_to_date;
			$Search_to_date 			  = date("Y-m-d",strtotime(str_replace('/','-',$Search_to_date)));
		}
		else
		{
			$Search_from_date = date('Y-m-d', strtotime('-6 days'));
			$Search_to_date   = date('Y-m-d');
		}
		
		
		$statisticsData = Advertisement::get_statistics($Search_from_date,$Search_to_date,$advertisement_id);		
		$clickData = Advertisement::get_clicks($Search_from_date,$Search_to_date,$advertisement_id);
		
		
		$daterange = $this->createDateRangeArray($Search_from_date,$Search_to_date);
		
		$statsArray = array();
		
		for($i = 0; $i<count($daterange); $i++){
			$tempArray = array();
			if(!empty($statisticsData)){
				foreach($statisticsData as $stat){
					if($stat->X == $daterange[$i]){
						$tempArray['X'] = $daterange[$i];
						$tempArray['Y'] = $stat->Y;
						break;
					}else{
						$tempArray['X'] = $daterange[$i];
						$tempArray['Y'] = 0;
					}
				}
			}else{
				$tempArray['X'] = $daterange[$i];
				$tempArray['Y'] = 0;
			}
			if(!empty($clickData)){
				foreach($clickData as $click){
					if($click->X == $daterange[$i]){
						$tempArray['Z'] = $click->click;
						break;
					}else{
						$tempArray['Z'] = 0;
					}
				}
			}else{
				$tempArray['Z'] = 0;
			}
			
			array_push($statsArray,$tempArray);
			
		}
		
		$str = "[['Date','Impression','Click'],";
        $i = 0;
        foreach($statsArray as $val){
        	$str .= "['".$val['X']."',".$val['Y'].",".$val['Z']."]";
        	if($i<count($statsArray)-1){
				$str .= ',';
			}
			$i++;
        }	
        $str .= ']'; 
       
        $totalImpression = Advertisement::getCountData('ev_advertisement_impression',$Search_from_date,$Search_to_date,$advertisement_id,'impression_id','date_of_action');
        $totalClick = Advertisement::getCountData('ev_advertisement_impression_click',$Search_from_date,$Search_to_date,$advertisement_id,'click_id','date');
		
		$data['title'] 		= 'Statistics';
		$data['heading'] 	= 'Statistics';
		$data['subHeading'] = 'Statistics chart';		
		$data['todo'] 		= 'addrec';
		$data['language'] 	=  $language;
		$data['dataset'] 	=  array();
		$data['id'] 		=  $advertisement_id;		
		//$data['url'] 		=  url('/').'/admin/advertisement';
		$data['module_ajaxurl']	= url('/').'/admin/advertisement_statistics/'.$advertisement_id;
		$data['impression_stats']     =  $str;
		$data['total_impression']	  =  $totalImpression->count;
		$data['total_click']	  	  =  $totalClick->count;
		
		$data['Search_from_date']     =  date("d/m/Y",strtotime(str_replace('-','/',$Search_from_date)));
		$data['Search_to_date']     =  	 date("d/m/Y",strtotime(str_replace('-','/',$Search_to_date)));		
		
		return view('admin.advertisement.statistics', ['data' => $data]);
	}
	
	public function createDateRangeArray($strDateFrom,$strDateTo)
	 {
		    // takes two dates formatted as YYYY-MM-DD and creates an
		    // inclusive array of the dates between the from and to dates.

		    // could test validity of dates here but I'm already doing
		    // that in the main script

		    $aryRange=array();

		    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

		    if ($iDateTo>=$iDateFrom)
		    {
		        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
		        while ($iDateFrom<$iDateTo)
		        {
		            $iDateFrom+=86400; // add 24 hours
		            array_push($aryRange,date('Y-m-d',$iDateFrom));
		        }
		    }
		    return $aryRange;
	}	
}