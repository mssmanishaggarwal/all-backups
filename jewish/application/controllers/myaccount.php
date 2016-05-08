<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myaccount extends CI_Controller {
		function __construct(){
		parent::__construct();
		$this->load->model('citymod');
		$this->load->library("session");
	    $this->load->helper('form');
		$this->load->database();
		$this->load->model('businessmod');	
		$this->load->library('allencode');	
	   }
		public function index() {
        parent::__construct();
		$this->load->library('email');
		$this->load->library("session");
		$user_log=$this->session->userdata('logged_in');
		$this->load->view('header');
		if(isset($user_log['user_id'])){
 		$k=$this->load->model('forum_module');
		
 		$catdt['forumdata'] = $this->forum_module->yourthreads();
		
	 $this->load->database();
		$user_log=$this->session->userdata('logged_in');
 		 $formdata=$this->db->get_where('login',array('email'=>$user_log['email']));
		 $data=$formdata->result();
	   //echo "<pre>";
	  ///print_r($data);	 
 		  $vr= (array) $data[0];	
		  //echo $vr['userinformation'];
		$catdt['user_image']=$vr['user_image'];
		$catdt['userinformation']=$vr['userinformation'];
 		
		
 
   		$this->load->view('user_profile',$catdt);
			
			
			//$this->load->view('user_profile');
		}else{
		/*========================================*/
		
		$this->load->model('modlogin');
		$logindata = array(
						   'email' =>  $this->input->post("inputEmailHandle"),
						   'password' => $this->input->post('inputPassword'),
						  );
		$flag_model=$this->modlogin->try_to_login($logindata);
		//echo $_GET['redirect'];
	   // echo 'gggggggg------------'.$flag_model;
		//die();
	
		if($flag_model=='access_to_login'){
			//redirect($_GET['redirect']);
			
			
			if(isset($_GET['redirect'])&&!empty($_GET['redirect'])){
			redirect($_GET['redirect']);
			}else{
			$this->load->view('user_profile',array('user_name'=>$this->input->post("inputEmailHandle")));	
			}
 			
	
		}else if($flag_model=='not_active_yet'){
			$this->load->view('login',array('alert'=>'not_active_yet'));
		}else if($flag_model=='not_exists'){
			
				$this->load->view('login',array('alert'=>'not_exists'));
			
		}else if($flag_model=='pwd_not_exists'){
			$this->load->view('login',array('alert'=>'pwd_not_exists'));
		}else{$this->load->view('user_profile',array('user_name'=>$this->input->post("inputEmailHandle")));}
		/*=================================================*/
		}
		$this->load->view('footer');
	
       }
	   
 public function threaddelete()
 {
 		$this->load->database();
      $this->db->where('forum_id',$_REQUEST['mdata']);
	 $this->db->delete('forum');
	 echo "forums-post".$_REQUEST['mdata'];
    }
public function updateuser()
{
 		$this->load->database();
  		$k=$this->load->model('forum_module');
 		$updt['userupdate'] = $this->forum_module->updateuser();
 }
	
	public function information()		
	{
	 $this->load->database();
		$user_log=$this->session->userdata('logged_in');
 		 $formdata=$this->db->get_where('login',array('email'=>$user_log['email']));
		 $data=$formdata->result();
	 //print_r($data);	 
 		  $vr= (array) $data[0];	
		  echo $vr['userinformation'];
		  
		  
		//  echo $vr['forum_name']; 
	// echo "<li>Thread post on: ".$vr['forum_modified_date']." <a href='".JEWISH_URL.'/forum/'.$vr['forum_slug']."'>".$vr['forum_name']."</a></li>";
 	}
	function uploadimage()
	{ print_r($_FILES['userImage']);
	$sourcePath = $_FILES['userImage']['tmp_name'];       // Storing source path of the file in a variable
$targetPath = "upload/".$_FILES['userImage']['name']; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ;    // Moving Uploaded file	
   
 	  $data=array(
	   'user_image'=>$targetPath,
   	  );
	   $user_log=$this->session->userdata('logged_in');
  		$this->db->where('email',$user_log['email']);
		$this->db->update('login',$data);	
 		echo $targetPath;							
	
	}
	 function logout(){
		//$this->session->sess_destroy();
		$this->session->unset_userdata('logged_in');
        redirect('/login');
	}
	 
	 function business_profilelist(){
		 $this->load->view('header');
		 $user_log=$this->session->userdata('logged_in');  
		 if(isset($user_log['user_id'])){
			 $this->session->all_userdata( 'city_id');
		 $this->load->view('business_directory/ac_profilelist');
		 }else{
			 $this->load->view('login');
		 }
		 $this->load->view('footer');
	 }
	 function classified_profilelist(){
		 $this->load->view('header');
		 $user_log=$this->session->userdata('logged_in');  
		 if(isset($user_log['user_id'])){
			 $this->session->all_userdata( 'city_id');
		 $this->load->view('listing/ac_profilelist');
		 }else{
			 $this->load->view('login');
		 }
		 $this->load->view('footer');
	 }	 
	 function business_reviews(){
		 $this->load->view('header');
		 $user_log=$this->session->userdata('logged_in');  
		 if(isset($user_log['user_id'])){
		 $this->load->view('business_directory/ac_reviews');
		 }else{
			 $this->load->view('login');
		 }
		 $this->load->view('footer');
	 }
	 function directory_message(){
		 $this->load->view('header');
		 $user_log=$this->session->userdata('logged_in');  
		 if(isset($user_log['user_id'])){
		 $this->load->view('business_directory/ac_private_msg',array('status'=>$this->uri->segment(3)));
		 }else{
			 $this->load->view('login');
		 }
		 $this->load->view('footer');
	 }
	 function classified_message(){
		 $this->load->view('header');
		 $user_log=$this->session->userdata('logged_in');  
		 if(isset($user_log['user_id'])){
		 $this->load->view('listing/ac_private_msg',array('status'=>$this->uri->segment(3)));
		 }else{
			 $this->load->view('login');
		 }
		 $this->load->view('footer');		 
	 }
	 function messages(){
		 $this->load->view('header');
		 $user_log=$this->session->userdata('logged_in');  
		 if(isset($user_log['user_id'])){
		 $this->load->view('message/message');
		 }else{
		 $this->load->view('login');
		 }
		 $this->load->view('footer');
	 }
	
}
