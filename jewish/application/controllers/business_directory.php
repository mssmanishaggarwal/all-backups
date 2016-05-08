<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Business_directory extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('citymod');
		$this->load->library("session");
		$this->load->helper('form');
		$this->load->database();
		$this->load->model('businessmod');	
		$this->load->library('allencode');	
	}
	public function index(){
		$this->load->library("session");
		$this->load->helper('form');
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->view('header');
		$this->load->library('allencode');
		//$user_log=$this->session->userdata('logged_in');
		$this->load->view('business_directory/directory');
		$this->load->view('footer');
	}
	
    function business_list(){
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->view('header');
		$this->load->library('allencode');
		$this->load->view('business_directory/business_list');
		$this->load->view('footer');
	 }
	 

	 
	 function add_business(){
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->view('header');
		$this->load->library('allencode');
		$this->load->view('business_directory/add_business');
		$this->load->view('footer');		 
	 }
	 
	 function business_insert(){
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->library('allencode');
		$data = array(
            'ip_addr' => $_SERVER['REMOTE_ADDR'],
            'b_cat_id' => $this->input->post('b_cat_id'),
            'b_email' => $this->input->post('b_email'),
            'b_name' => $this->input->post('b_name'),
            'b_address1' => $this->input->post('b_address1'),
            'b_address2' => $this->input->post('b_address2'),
            'b_city' => $this->input->post('b_city'),
            'b_state' =>$this->input->post('b_state'),
			'b_zipcode' =>$this->input->post('b_zipcode'),
			'b_phone' =>$this->input->post('b_phone'),
			'b_url' =>$this->input->post('b_url'),
			'b_des' =>$this->input->post('b_des'),
        );
		$bd_post_id=$this->businessmod->insert_business($data);
		$this->multifile_upload($bd_post_id);
		if(isset($bd_post_id)){
				$active_url=JEWISH_URL.'/business_directory/business_profile/'.$this->allencode->encode($bd_post_id).'/';
				$this->load->library('email');
					  $email_setting  = array('mailtype'=>'html');
					   $this->email->initialize($email_setting);
								$this->email->from('info@jclassified.com', 'Your Name');
								$this->email->to($this->input->post('b_email')); 
								//$this->email->cc('testing.kaushik2@gmail.com'); 
								$this->email->bcc('kaushik@primediart.com'); 
								
								$this->email->subject('Confirm Your Email Address at Jewish Classified (Business Directory)');
								$this->email->message("<p>Your recent business profile activation link</p>
								<p>Please click below</p>
								<p><a href='".$active_url."' target='_blank'>Click Here for your business profile link</a></p>");	
								
								@$this->email->send();
		$d=array('email'=>$this->input->post('b_email'),'alert_type'=>'notify_email');
		}
		$this->business_verification($d);
	 }
	 function multifile_upload($use_id){
		$this->load->library('allencode');
	$this->load->model('postmod');
	$number_of_files = sizeof($_FILES['post_images']['tmp_name']);
 
    $files = $_FILES['post_images'];
 
				for($i=0;$i<$number_of_files;$i++)
				{
				  if($_FILES['post_images']['error'][$i] != 0)
				  {
					//$this->form_validation->set_message('fileupload_check', 'Couldn\'t upload the file(s)');
					return FALSE;
				  }
				}
    
   
    $this->load->library('upload');
    $config['upload_path'] = FCPATH . 'upload/';
    $config['allowed_types'] = 'gif|jpg|png';

					for ($i = 0; $i < $number_of_files; $i++)
					{
					  $_FILES['post_images']['name'] = time().$files['name'][$i];
					  $_FILES['post_images']['type'] = $files['type'][$i];
					  $_FILES['post_images']['tmp_name'] = $files['tmp_name'][$i];
					  $_FILES['post_images']['error'] = $files['error'][$i];
					  $_FILES['post_images']['size'] = $files['size'][$i];
	$this->postmod->multi_image_bd(str_replace(' ', '_',$_FILES['post_images']['name']),$use_id);
	$this->upload->initialize($config);
					  if ($this->upload->do_upload('post_images'))
					  {
						$this->_uploaded[$i] = $this->upload->data();
						
					  }
					  else
					  {
						//$this->form_validation->set_message('fileupload_check', $this->upload->display_errors());
						echo 'Your Image is not as per our recommendation, please click on browser back button';
					  }
					}
		
	}
	 function business_verification($d){
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->library('allencode');
		$this->load->view('header');
		$this->load->view('business_directory/alert',$d);
		$this->load->view('footer');
	 }
	 
	 function business_profile(){
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->library('allencode');
	    $post_id =$this->allencode->decode($this->uri->segment(3));
		$data=array('status'=>1);	
		$this->businessmod->update_bd_status($post_id,$data);
		$this->load->view('header');
		$this->load->view('business_directory/business_profile',array('bd_id'=>$post_id));
		$this->load->view('footer');	 
	 }
	 function businessprofile(){
		$this->load->view('header');
		$this->load->view('business_directory/single_business');
		$this->load->view('footer');
	 }
	 
	 function business_edit(){
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->library('allencode');
	    $post_id = $this->allencode->decode($this->uri->segment(3));
		$this->load->view('header');
		$this->load->view('business_directory/business_edit',array('bd_id'=>$post_id));
		$this->load->view('footer');
	 }
	 
	 function business_update(){
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->library('allencode');
		$data = array(
            'ip_addr' => $_SERVER['REMOTE_ADDR'],
            'b_cat_id' => $this->input->post('b_cat_id'),
            'b_email' => $this->input->post('b_email'),
            'b_name' => $this->input->post('b_name'),
            'b_address1' => $this->input->post('b_address1'),
            'b_address2' => $this->input->post('b_address2'),
            'b_city' => $this->input->post('b_city'),
            'b_state' =>$this->input->post('b_state'),
			'b_zipcode' =>$this->input->post('b_zipcode'),
			'b_phone' =>$this->input->post('b_phone'),
			'b_url' =>$this->input->post('b_url'),
			'b_des' =>$this->input->post('b_des'),
        );
		$this->businessmod->update_db_profile($data,$this->allencode->decode($this->input->post('id')));
		$this->multifile_upload($this->allencode->decode($this->input->post('id')));
		redirect('/business_directory/business_profile/'.$this->input->post('id'));
	 }
	 

	 function business_image(){
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->library('allencode');
		$have_image=$this->businessmod->check_image($this->allencode->decode($this->uri->segment(3)));
		foreach ($have_image as $v){
			$v['img'];
		}
		if(isset($v['img'])){
		$this->delete_image($v['img'],$this->allencode->decode($this->uri->segment(3)));
		$sourcePath = $_FILES['post_images']['tmp_name'];       
        $targetPath = "upload/".$_FILES['post_images']['name'];
		$thepath=$_FILES['post_images']['name'];
         move_uploaded_file($sourcePath,$targetPath) ;    
   		$data=array('bd_id'=>$this->allencode->decode($this->uri->segment(3)),'img'=>$thepath );
		$this->businessmod->update_image($this->allencode->decode($this->uri->segment(3)),$data);
		echo $thepath;
		}else{
		$sourcePath = $_FILES['post_images']['tmp_name'];       
        $targetPath = "upload/".$_FILES['post_images']['name'];
		$thepath=$_FILES['post_images']['name'];
         move_uploaded_file($sourcePath,$targetPath) ;    
   		$data=array('bd_id'=>$this->allencode->decode($this->uri->segment(3)),'img'=>$thepath );
		$this->businessmod->ins_image($data);
		echo $thepath;
		}
		}
	 function delete_image($id,$delid){
		$this->load->library('allencode');
		$this->load->model('businessmod');
		$this->load->helper("file");
	    $imh=FCPATH."/upload/".$id;
		@chmod($imh, 0777);
		$result=unlink($imh);
				//$this->businessmod->delimage($delid);
		}
	 function review(){
		$this->load->library("session");
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->library('allencode');	
		$this->load->view('header');
		$user_log=$this->session->userdata('logged_in');
		if(isset($user_log['user_id'])){
		$this->load->view('business_directory/review');
		}
		$this->load->view('footer');	 
	 }
	 
	 function add_review(){
		$this->load->library("session");
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->library('allencode');
		$data=array('user_id'=>$this->input->post('user_id'),'post_id'=>$this->allencode->decode($this->input->post('post_id')),'voteNr'=>1,'imgId'=>$this->input->post('imgId'),'comment'=>$this->input->post('b_des'));
		$this->businessmod->add_review($data);
		redirect('/business_directory/review/'.$this->input->post('post_id'));
	 }
	 
	 function login(){
		$this->load->library("session");
		$this->load->database();
		$this->load->model('businessmod');
		$this->load->library('allencode');		 
		$this->load->view('header');
		$this->load->view('login3');
		$this->load->view('footer');	
	 }
	 
	 function bd_private_message(){ 
		$user_log=$this->session->userdata('logged_in');
		$data=array('user_id'=>$user_log['user_id'],
		                     'post_id'=>$this->allencode->decode($_GET['post_id']),
							 'poster_id'=>$this->allencode->decode($_GET['poster_id']),
							 'post_type'=>$_GET['post_type'],
							 'message'=>$_GET['message']
							 );
				 
		if($this->businessmod->check_commnet($user_log['user_id'],$this->allencode->decode($_GET['post_id']))==0){
		if($this->businessmod->check_user_profile($this->allencode->decode($_GET['post_id']),'num_rows')!=0){
		$message_id=$this->businessmod->add_private_message($data);
							$data2=array(
						     'message_id'=>$message_id,
		                     'poster_id'=>$this->allencode->decode($_GET['poster_id']),
							 'status'=>'received',
							 );
							 $user_log=$this->session->userdata('logged_in');
							 $data3=array(
						     'message_id'=>$message_id,
		                     'user_id'=>$user_log['user_id'],
							 'status'=>'received',
							 );	
		$this->businessmod->add_private_message_status($data2);
		$this->businessmod->add_private_message_status2($data3);
		}else{
		$get_poster_date=$this->businessmod->check_user_profile($this->allencode->decode($_GET['post_id']),'full_fetch');
		/*echo ("<pre>");
		print_r($get_poster_date);
		echo ("</pre>");echo */
		                        $this->load->library('email');
					            $email_setting  = array('mailtype'=>'html');
					            $this->email->initialize($email_setting);
								$this->email->from('info@jclassified.com', 'Your Name');
								$this->email->to($get_poster_date[0]['c_email']); 
								//$this->email->cc('testing.kaushik2@gmail.com'); 
								$this->email->bcc('kaushik@primediart.com'); 
								$this->email->subject('Private message from your advertisement at Jewish Classified (Business Directory)');
								$this->email->message("<p>Somebody has shown interest for your business profile.</p>
								<p>Please register your account with ".$get_poster_date[0]['c_email']." this mail address to access your private message from
								My Account at Jewish Classifiied.</p>
								<p><a href='".JEWISH_URL."/login' target='_blank'>Click here to register</a></p>
								");	
								
								@$this->email->send(); //echo "mail";
		}
			echo 'success';
		}else{
			echo 'have_comment';
		}
						 
	 }
	 
	 function classified_private_message(){ 
		$user_log=$this->session->userdata('logged_in');
		$data=array('user_id'=>$user_log['user_id'],
		                     'post_id'=>$this->allencode->decode($_GET['post_id']),
							 'poster_id'=>$this->allencode->decode($_GET['poster_id']),
							 'post_type'=>$_GET['post_type'],
							 'message'=>$_GET['message']
							 );
		if($this->businessmod->check_commnet($user_log['user_id'],$this->allencode->decode($_GET['post_id']))==0){
		if($this->businessmod->check_user_profile_cl($this->allencode->decode($_GET['post_id']),'num_rows')!=0){
		$message_id=$this->businessmod->add_private_message($data);
							$data2=array(
						     'message_id'=>$message_id,
		                     'poster_id'=>$this->allencode->decode($_GET['poster_id']),
							 'status'=>'received',
							 );
							 $user_log=$this->session->userdata('logged_in');
							 $data3=array(
						     'message_id'=>$message_id,
		                     'user_id'=>$user_log['user_id'],
							 'status'=>'received',
							 );	
		$this->businessmod->add_private_message_status($data2);
		$this->businessmod->add_private_message_status2($data3);
		}else{
		$get_poster_date=$this->businessmod->check_user_profile_cl($this->allencode->decode($_GET['post_id']),'full_fetch');
		/*echo ("<pre>");
		print_r($get_poster_date);
		echo ("</pre>");echo */
		                        $this->load->library('email');
					            $email_setting  = array('mailtype'=>'html');
					            $this->email->initialize($email_setting);
								$this->email->from('info@jclassified.com', 'Your Name');
								$this->email->to($get_poster_date[0]['c_email']); 
								//$this->email->cc('testing.kaushik2@gmail.com'); 
								$this->email->bcc('kaushik@primediart.com'); 
								$this->email->subject('Private message from your advertisement at Jewish Classified (Business Directory)');
								$this->email->message("<p>Somebody has shown interest for your business profile.</p>
								<p>Please register your account with ".$get_poster_date[0]['c_email']." this mail address to access your private message from
								My Account at Jewish Classifiied.</p>
								<p><a href='".JEWISH_URL."/login' target='_blank'>Click here to register</a></p>
								");	
								
								@$this->email->send(); //echo "mail";
		}
			echo 'success';
		}else{
			echo 'have_comment';
		}
						 
	 }
	 
	 function bd_private_message_reply(){
		 		$user_log=$this->session->userdata('logged_in');
		        $data=array(
				             'message_id'=>$this->allencode->decode($_GET['message_id']),
				             'user_id'=>$user_log['user_id'],
							 'poster_id'=>$this->allencode->decode($_GET['poster_id']),
							 'post_type'=>$_GET['post_type'],
							 'message_reply'=>$_GET['message_reply']
							 );
				$this->businessmod->add_private_message_reply($data);	
				echo 'success';		 
	 }
	 
	 function message_status(){
		 		 /*$data=array(
				             'status'=>'read'
							 );*/
				//$this->businessmod->make_read($data,$this->uri->segment(3));
				$query=$this->db->query("SELECT * FROM private_message_status WHERE message_id='".$this->uri->segment(3)."' AND user_id='".$this->uri->segment(4)."'");	
				$data = $query->num_rows();
				if($data==0){
					$this->db->query("UPDATE private_message_status SET status='read' WHERE message_id='".$this->uri->segment(3)."' AND poster_id='".$this->uri->segment(4)."'");	
				}else{
					$this->db->query("UPDATE private_message_status SET status='read' WHERE message_id='".$this->uri->segment(3)."' AND user_id='".$this->uri->segment(4)."'");	
				}
				echo $this->db->last_query();			 
	 }
	 function update_review(){
		$data=array('imgId'=>$this->input->post('imgId'),'comment'=>$this->input->post('b_des'),); 
		$this->businessmod->updated_review($data,$this->allencode->decode($this->input->post('post_id')),$this->allencode->decode($this->input->post('user_id')));	
		redirect(JEWISH_URL.'/myaccount/business_reviews/');
	 }
		
}



