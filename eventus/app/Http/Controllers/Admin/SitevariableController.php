<?php
namespace App\Http\Controllers\admin;
use App\Helper\Languagehelper;
use App\Http\Controllers\Controller;
use App\Models\Admin\Sitevariable;
use App\Models\Admin\Pagenation;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Lang;
class SitevariableController extends Controller {
	
	protected $tablename;
	protected $title;
	protected $subtitle;
	protected $heading;
	protected $language;
	
	public function __construct() {
		$this->middleware('admins');
		$this->tablename = 'sitevariable';
		$this->title 	 = 'Site Variable';
		$this->subtitle  = 'Site Variable';
		$this->heading   = 'Site Variable';
		$this->language  = 1;
	}
	public function index(Request $request) {		
		$data = array();		
		$sessionUpdate = $request->session()->pull('sessionUpdate');
		$sessionGet = $request->session()->get('sessionData');		 
		$sessionInsert = $request->session()->pull('sessionInsert');		 
		if($sessionUpdate['isupdate'] == 1) {	
			/* SESSION VALUE */							 
			$sessionGet = $request->session()->get('sessionData');	
			$orderby = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
			$fieldname = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.sitevariable_name';
		 	$currpage = !empty($sessionGet['currpage'])?$sessionGet['currpage']:1;
		 	$offset = !empty($sessionGet['offset'])?$sessionGet['offset']:0;
		 	$limit = !empty($sessionGet['limit'])?$sessionGet['limit']:5;
		 	$keywords = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();		 
		 	$sessionArray['orderby'] = $orderby;							 
		 	$sessionArray['fieldname'] = $fieldname;
		 	$sessionArray['currpage']	= $currpage;							 
		 	$sessionArray['offset'] = $offset;
		 	$sessionArray['limit'] = $limit;							 
		 	$sessionArray['keywords'] = $keywords;							 
		 	$request->session()->put('sessionData', $sessionArray);							 
		 	/* SESSION VALUE */
		} else {			
			$currpage	= 1;
			$offset = 0;
			$limit = 5;
			$orderby = 'asc';
			$fieldname = 't.sitevariable_name';
			$keywords = array();
			$request->session()->forget('sessionData');
			$request->session()->forget('sessionUpdate');
			$request->session()->forget('$sessionInsert');
		}		
		$data['dataCount'] = Sitevariable::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords);
		$data['dataGrid'] = Sitevariable::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language),$keywords, $fieldname, $orderby, $limit, $offset);
		$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
		$data['title'] = $this->title;
		$data['heading'] = $this->heading;
		$data['module_ajaxurl']	= url('/').'/admin/sitevariable_ajax/';
		$data['orderby'] = 'asc';
		$data['fa_order']	= 'asc';
		if($fieldname=='t.sitevariable_name' && empty($keywords)){
		 	$data['hide_order'] = 0;	
		}else{
		 	$data['hide_order']= 1;	
		}
		$data['update_id'] = !empty($sessionUpdate['updateid'])?$sessionUpdate['updateid']:'';	
		$data['insert_id'] = !empty($sessionInsert['insertid'])?$sessionInsert['insertid']:'';			
		$data['keywords'] = $keywords;
		$data['limit'] = $limit;
		return view('admin.sitevariable.index',['data' => $data]);
	}
	
	public function todo($type, Request $request) { // AJAX function
		$data = array();
		$sessionArray = array();		
		switch($type){
			case 'searching':$keywords 	= Input::all();	
				/* SESSION VALUE */
				$sessionGet = $request->session()->get('sessionData');	
				$limit = !empty($sessionGet['limit'])?$sessionGet['limit']:5;
				$request->session()->forget('sessionData');
				$sessionArray['keywords']	= $keywords;	
				$sessionArray['orderby']	= 'asc';					 
				$sessionArray['fieldname'] = 't.sitevariable_name';
				$sessionArray['currpage']	= 1;							 
				$sessionArray['offset'] = 0;
				$sessionArray['limit'] = $limit;							 
				$request->session()->put('sessionData', $sessionArray);
				/* SESSION VALUE */							 
				$data['dataCount'] = Sitevariable::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords);
				$data['dataGrid'] = Sitevariable::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords, 't.sitevariable_name', 'asc', $limit, 0);
				$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'], 1, $limit);
				$data['title'] 	= $this->title;
				$data['heading'] 	= $this->heading;
				$data['module_ajaxurl']	= url('/').'/admin/sitevariable_ajax/';
				$data['orderby']	= 'asc';
				$data['fa_order']	= 'asc';
				$data['hide_order']= 1;
				$data['update_id'] = '';	
				$data['insert_id'] = '';
				$data['keywords'] = $keywords;
				$data['limit'] 	= $limit;
				return view('admin.sitevariable.listview',['data' => $data]);
			break;
			case 'paging':	 
				$currpage = Input::get('currpage');
				$limit = Input::get('limit');
				$offset = (($currpage * $limit)-$limit);							
				/* SESSION VALUE */							 
				$sessionGet = $request->session()->get('sessionData');
				$orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
				$fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.sitevariable_name';
				$keywords   = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();
				$sessionArray['orderby']	= $orderby;
				$sessionArray['fieldname']	= $fieldname;
				$sessionArray['currpage']	= $currpage;							 
				$sessionArray['offset'] 	= $offset;
				$sessionArray['limit'] 	= $limit;
				$sessionArray['keywords'] 	= $keywords;
				$request->session()->put('sessionData', $sessionArray);							
				/* SESSION VALUE */
				$data['dataCount'] = Sitevariable::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords);
				$data['dataGrid'] 	= Sitevariable::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, $offset);
				$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'],$currpage, $limit);
				$data['title'] = $this->title;
				$data['heading'] = $this->heading;
				$data['module_ajaxurl']	= url('/').'/admin/sitevariable_ajax/';
				$data['orderby'] = ($orderby=='asc')?'desc':'asc';
				$data['fa_order']	= $orderby;
				if($fieldname == 't.sitevariable_name' && empty($keywords)) {
					$data['hide_order']= 0;	
				} else {
					$data['hide_order']= 1;	
				}
				$data['update_id'] = '';	
				$data['insert_id'] = '';
				$data['keywords'] 	= $keywords;
				$data['limit'] 	= $limit;
				return view('admin.sitevariable.listview',['data' => $data]);
			break;
			case 'perpage':$sessionGet = array();
				$newlimit = Input::get('limit');							 						 
				/* SESSION VALUE */							 
				$sessionGet = $request->session()->get('sessionData');
				$orderby	 = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
				$fieldname  = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.sitevariable_name';
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
				$data['dataCount'] = Sitevariable::totalRecord('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords);
				$data['dataGrid']  = Sitevariable::totalGrid('*', $this->tablename, $where=array('atrans.language_id'=>$this->language), $keywords, $fieldname, $orderby, $limit, $offset);
				$data['pagenation'] = Pagenation::getGroupPagination($data['dataCount'], $currpage, $limit);
				
				$data['title'] 	= $this->title;
				$data['heading'] 	= $this->heading;
				$data['module_ajaxurl']	= url('/').'/admin/sitevariable_ajax/';
				$data['orderby']	= $orderby;
				$data['fa_order']	= $orderby;
				$data['update_id'] = '';	
				$data['insert_id'] = '';
				if($fieldname=='t.sitevariable_name' && empty($keywords)) {
					$data['hide_order'] = 0;	
				} else {
					$data['hide_order'] = 1;	
				}	
				$data['keywords'] = $keywords;	
				$data['limit'] = $limit;	
				return view('admin.sitevariable.listview',['data' => $data]);
			break;
		}
	}
	
	public function update($id = '', Request $request) {
		$data = array();
		$language = Languagehelper::getlanguage();
		$todo = Input::get('todo');		
		/* SESSION VALUE */							 
		$sessionGet = $request->session()->get('sessionData');
		$orderby = !empty($sessionGet['orderby'])?$sessionGet['orderby']:'asc';
		$fieldname = !empty($sessionGet['fieldname'])?$sessionGet['fieldname']:'t.sitevariable_name';
		$currpage = !empty($sessionGet['currpage'])?$sessionGet['currpage']:1;
		$offset = !empty($sessionGet['offset'])?$sessionGet['offset']:0;
		$limit = !empty($sessionGet['limit'])?$sessionGet['limit']:5;
		$keywords = !empty($sessionGet['keywords'])?$sessionGet['keywords']:array();			 
		$sessionArray['orderby'] = $orderby;							 
		$sessionArray['fieldname'] = $fieldname;
		$sessionArray['currpage']	= $currpage;							 
		$sessionArray['offset'] = $offset;
		$sessionArray['limit'] = $limit;							 
		$sessionArray['keywords'] = $keywords;							 
		$request->session()->put('sessionData', $sessionArray);
		/* SESSION VALUE */
		if($todo=='saverec') {
			$update = Sitevariable::updateData($this->tablename, $data=array('date_edited'=>date('Y-m-d H:i:s')), $where=array('sitevariable_id'=>$id));
			$update = Sitevariable::updateData('sitevariable_value', $data=array('variable_value'=>$request->variable_value_1), $where=array('sitevariable_id'=>$id,'language_id'=>1));				
			$update = Sitevariable::updateData('sitevariable_value', $data=array('variable_value'=>$request->variable_value_2), $where=array('sitevariable_id'=>$id,'language_id'=>2));				
			$sessionUpdate['updateid'] 	= $id;
			$sessionUpdate['isupdate'] 	= 1;				 
			$request->session()->put('sessionUpdate', $sessionUpdate);									
			//echo '1';
			//return;
			return redirect('/admin/sitevariable_list');
		}	
		$sessionUpdate['updateid'] 	= 0;
		$sessionUpdate['isupdate'] 	= 1;				 
		$request->session()->put('sessionUpdate', $sessionUpdate);	
		$sitevariable = DB::table('sitevariable as acco')
			->select('*')
			->join('sitevariable_value as atrans', 'acco.sitevariable_id', '=', 'atrans.sitevariable_id')
			->where('acco.sitevariable_id', $id)
			->get();		
		$data['title'] = 'Update '.$this->heading;
		$data['heading'] = $this->heading;
		$data['subHeading'] = 'Update '.$this->heading;
		$data['saveBtn'] = 'Save';
		$data['todo'] = 'saverec';
		$data['language'] =  $language;
		$data['dataset'] = $sitevariable;
		$data['id'] = $id;
		$data['url'] = url('/').'/admin/sitevariable/'.$id;
		return view('admin.sitevariable.sitevariable', ['data' => $data]);
	}
}