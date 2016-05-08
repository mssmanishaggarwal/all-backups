<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Post extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('citymod');
		$this->load->model('postmod');
		$k=$this->postmod->current_date();
	
		foreach($k as $v){
				$get_all=$this->postmod->select_all_image_name($v['post_id']);
						for($i=0;$i<sizeof($get_all);$i++){
							$imh=FCPATH."/upload/".$get_all[$i];
				            $result=unlink($imh);
							$query = $this->db->query("DELETE FROM `images` WHERE `post_id`='".$v['post_id']."'");
						}
			$query = $this->db->query("DELETE FROM `post` WHERE `id`='".$v['post_id']."'");
			$query = $this->db->query("DELETE FROM `housing_post_meta` WHERE `post_id`='".$v['post_id']."'");
			$query = $this->db->query("DELETE FROM `job_post_meta` WHERE `post_id`='".$v['post_id']."'");
			$query = $this->db->query("DELETE FROM `event_post_meta` WHERE `post_id`='".$v['post_id']."'");
			$query = $this->db->query("DELETE FROM `category_post_relationship` WHERE `post_id`='".$v['post_id']."'");
		}
		
	}
	public function index(){
		$this->load->helper('form');
		$this->load->database();
		$this->load->model('postmod');
		$this->load->view('header');
		//$user_log=$this->session->userdata('logged_in');
		$this->load->view('housing/post');
		$this->load->view('footer');
		
	}
	
	function type_post(){
		$this->load->library('allencode');
		$this->load->view('header');
				$this->load->view('housing/post',array('type'=>$this->uri->segment(3)));
		
		$this->load->view('footer');
	}
	
	function addhousingpost(){
		$this->load->library('allencode');
		$this->load->view('header');
$this->load->view('housing/addpost',array('parent_id'=>$this->input->post("parent_id"),'type'=>$this->input->post("type"),'child_id'=>$this->input->post("child_id")));
		$this->load->view('footer');
	}
	
	function preview($b,$k){
		$this->load->library('allencode');
		$this->load->library('encrypt');
		$this->load->model('postmod');
		$this->load->view('header');
		$post_id =  $this->allencode->decode($this->uri->segment(3));
		$email =  $this->allencode->decode($this->uri->segment(4)); 
		//$param=urldecode($k);
		$chek=$this->postmod->cheking_post($post_id ,$email);
				if($chek==true){
                    $this->load->view('alert',array('alert_type'=>'unauth'));
				}else{
			$this->load->view('housing/preview',array('id'=>$post_id,'post_mail'=>$email));
				}
		
		$this->load->view('footer');
	}
	function otr(){
		$this->load->library('allencode');
				$this->load->model('postmod');
				$data = array(
            'c_email' => $this->input->post('c_email'),
            'user_id' => $this->input->post('user_id'),
            /*'object_id' => $this->input->post('object_id'),*/
            'contact_phone_ok' => $this->input->post('contact_phone_ok'),
            'contact_text_ok' => $this->input->post('contact_text_ok'),
            'contact_phone' => $this->input->post('contact_phone'),
            'contact_name' => $this->input->post('contact_name'),
            'post_title' =>$this->input->post('post_title'),
			'geo_area' =>$this->input->post('geo_area'),
			'zipcode' =>$this->input->post('zipcode'),
			'post_content' =>$this->input->post('post_content'),
			'post_date'=>date("Y-m-d H:i:s"),
			'state' =>$this->input->post('state'),
        );
		           
					$post_id=$this->postmod->insert_housing($data);
			$meta_data=array(
			'post_id'=>$post_id,		
			/*'cat_id'=>$this->input->post('cat_id'),	*/	
		    'sqft' =>$this->input->post('sqft'),
			'ask' =>$this->input->post('ask'),
			'movein_month' =>$this->input->post('movein_month'),
			'movein_day' =>$this->input->post('movein_day'),
			'parking' =>$this->input->post('parking'),
			'laundry' =>$this->input->post('laundry'),
			'sale_date_1' =>$this->input->post('sale_date_1'),
			'sale_date_2' =>$this->input->post('sale_date_2'),
			'sale_date_3' =>$this->input->post('sale_date_3'),
			'wheelchaccess' =>$this->input->post('wheelchaccess'),
			'no_smoking' =>$this->input->post('no_smoking'),
			'private_bath' =>$this->input->post('private_bath'),
			'private_room' =>$this->input->post('private_room'),
			'pets_cat' =>$this->input->post('pets_cat'),
			'pets_dog' =>$this->input->post('pets_dog'),
			'contact_ok' =>$this->input->post('contact_ok'),
			'housing_wanted' =>$this->input->post('housing_wanted'),
			'housing_offered' =>$this->input->post('housing_offered'),
	    );	
					$this->postmod->insert_housing_meta($meta_data);
					/*$d=array('cat_id'=>$this->input->post('object_id'), 'post_id'=>$post_id);
					$this->postmod->category_post_relationship($d);*/
					$this->multifile_upload($post_id);
					redirect('/post/preview/'.$this->allencode->encode($post_id).'/'.$this->allencode->encode($this->input->post('c_email')));
		
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
	$this->postmod->multi_image(str_replace(' ', '_',$_FILES['post_images']['name']),$use_id);
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
	    function publish(){
				$this->load->library('allencode');
				$this->load->model('postmod');
		        $this->load->view('header');
				$data=array('c_email'=> $this->input->post('client_mail'),'status'=>1);
				$this->postmod->update_housing($data,$this->input->post('post_id'));
				$this->load->view('alert',array('alert_type'=>'post_published','email_id'=> $this->input->post('client_mail')));
				$active_url=JEWISH_URL.'/post/post_edit/'.$this->allencode->encode($this->input->post('post_id')).'/'.$this->allencode->encode($this->input->post('client_mail')).'/'.$this->input->post('type');
				$this->load->library('email');
					  $email_setting  = array('mailtype'=>'html');
					   $this->email->initialize($email_setting);
								$this->email->from('info@jclassified.com', 'Your Name');
								$this->email->to($this->input->post('client_mail')); 
								//$this->email->cc('testing.kaushik2@gmail.com'); 
								$this->email->bcc('kaushik@primediart.com'); 
								
								$this->email->subject('EDIT/DELETE/UPDATE Your Jewish Classified Post');
								$this->email->message("<p>Please save this email as this is your only source for editing and deleting posts unless you have a Jewish Classified account and were logged in when you created the post.</p>
								<p>Your recent post to the Jewish Classified site can be edited or deleted with the following link: </p>
								<p><a href='".$active_url."' target='_blank'>Edit or delete Jewish Classified post</a></p>");	
								
								@$this->email->send();
								
				$this->load->view('footer');
			
		}
		
		function post_edit(){
			$this->load->library('allencode');
				$this->load->library('encrypt');
				$post_id =  $this->allencode->decode($this->uri->segment(3));
				$email =  $this->allencode->decode($this->uri->segment(4)); 
				$this->load->model('postmod');
				$this->load->view('header'); 
				$chek=$this->postmod->cheking_post($post_id ,$email);
				if($chek==true){
                    $this->load->view('alert',array('alert_type'=>'unauth'));
				}else{
					//$type=$this->postmod->category_type_by_post_id($post_id);
					//echo 'kaushik';
				if($this->uri->segment(5)=='housing'){
					$this->load->view('housing/editpost',array('p_id'=>$post_id ,'email'=>$email));
					}elseif($this->uri->segment(5)=='job'){ 
					$this->load->view('job/editpost',array('p_id'=>$post_id ,'email'=>$email));
					}elseif($this->uri->segment(5)=='event'){ 
					$this->load->view('event/editpost',array('p_id'=>$post_id ,'email'=>$email));
					}
				}
				$this->load->view('footer');
		}
		
		function postupdate(){
			$this->load->library('allencode');
				$this->load->model('postmod');
				$update_id=$this->input->post('id');
				$data = array(
            'c_email' => $this->input->post('c_email'),
           /* 'user_id' => $this->input->post('user_id'),*/
            'object_id' => $this->input->post('object_id'),
            'contact_phone_ok' => $this->input->post('contact_phone_ok'),
            'contact_text_ok' => $this->input->post('contact_text_ok'),
            'contact_phone' => $this->input->post('contact_phone'),
            'contact_name' => $this->input->post('contact_name'),
            'post_title' =>$this->input->post('post_title'),
			'geo_area' =>$this->input->post('geo_area'),
			'zipcode' =>$this->input->post('zipcode'),
			'post_content' =>$this->input->post('post_content'),
			'post_date'=>date("Y-m-d H:i:s"),
			'state' =>$this->input->post('state'),
        );
		           
					$post_id=$this->postmod->update_housing($data,$update_id);
			$meta_data=array(
			'post_id'=>$this->input->post('id'),		
			/*'cat_id'=>$this->input->post('cat_id'),*/		
		    'sqft' =>$this->input->post('sqft'),
			'ask' =>$this->input->post('ask'),
			'movein_month' =>$this->input->post('movein_month'),
			'movein_day' =>$this->input->post('movein_day'),
			'parking' =>$this->input->post('parking'),
			'laundry' =>$this->input->post('laundry'),
			'sale_date_1' =>$this->input->post('sale_date_1'),
			'sale_date_2' =>$this->input->post('sale_date_2'),
			'sale_date_3' =>$this->input->post('sale_date_3'),
			'wheelchaccess' =>$this->input->post('wheelchaccess'),
			'no_smoking' =>$this->input->post('no_smoking'),
			'private_bath' =>$this->input->post('private_bath'),
			'private_room' =>$this->input->post('private_room'),
			'pets_cat' =>$this->input->post('pets_cat'),
			'pets_dog' =>$this->input->post('pets_dog'),
			'contact_ok' =>$this->input->post('contact_ok'),
			'housing_wanted' =>$this->input->post('housing_wanted'),
			'housing_offered' =>$this->input->post('housing_offered'),
	    );	
					$this->postmod->update_housing_meta($meta_data,$update_id);
					/*$d=array('cat_id'=>$this->input->post('object_id'), 'post_id'=>$post_id);
					$this->postmod->category_post_relationship($d);*/
					$this->multifile_upload($update_id);
					redirect('/post/preview/'.$this->allencode->encode($update_id).'/'.$this->allencode->encode($this->input->post('c_email')));
		}
		function delete_image(){
			$this->load->library('allencode');
				$this->load->model('postmod');
				$this->load->helper("file");
			    $imh=FCPATH."/upload/".$_GET['imgurl'];
			    @chmod($imh, 0777);
				$result=unlink($imh);
				$this->postmod->delimage($_GET['ded']);
		}
		function delete_image_bd(){
			$this->load->library('allencode');
				$this->load->model('postmod');
				$this->load->helper("file");
			    $imh=FCPATH."/upload/".$_GET['imgurl'];
			    @chmod($imh, 0777);
				$result=unlink($imh);
				$this->postmod->delimage_bd($_GET['ded']);
		}
		
		function delete(){
			$this->load->library('allencode');
				$this->load->model('postmod');
				$post_id =  $this->allencode->decode($this->uri->segment(3));
				$email =  $this->allencode->decode($this->uri->segment(4)); 
				$chek=$this->postmod->cheking_post($post_id ,$email);
				if($chek==true){
                    $this->load->view('alert',array('alert_type'=>'unauth'));
				}else{
					$this->load->helper("file");
					 @chmod($imh, 0777);
					$get_all=$this->postmod->select_all_image_name($post_id);
						for($i=0;$i<sizeof($get_all);$i++){
							$imh=FCPATH."/upload/".$get_all[$i];
				            $result=unlink($imh);
						}
					$this->postmod->delete_all_by_postid($post_id);
					redirect('/');
				}
		}
		
		/*====================Job Contriller Started==========================*/
		
		function addjobpost(){ 
		$this->load->library('allencode');
			$this->load->view('header');
	$this->load->view('job/addpost',array('parent_id'=>$this->input->post("parent_id"),'type'=>$this->input->post("type"),'child_id'=>$this->input->post("child_id")));
			$this->load->view('footer');
         }
		 
		 function jobinsert(){
			 $this->load->library('allencode');
			 $this->load->model('postmod');
			 $data = array(
            'c_email' => $this->input->post('c_email'),
            'user_id' => $this->input->post('user_id'),
          /*  'object_id' => $this->input->post('object_id'),*/
            'contact_phone_ok' => $this->input->post('contact_phone_ok'),
            'contact_text_ok' => $this->input->post('contact_text_ok'),
            'contact_phone' => $this->input->post('contact_phone'),
            'contact_name' => $this->input->post('contact_name'),
            'post_title' =>$this->input->post('post_title'),
			'geo_area' =>$this->input->post('geo_area'),
			'zipcode' =>$this->input->post('zipcode'),
			'post_content' =>$this->input->post('post_content'),
			'post_date'=>date("Y-m-d H:i:s"),
			'state' =>$this->input->post('state'),
        );
			 $post_id=$this->postmod->insert_housing($data);
			 $meta_data=array(
			'post_id'=>$post_id,		
			/*'cat_id'=>$this->input->post('cat_id'),*/		
		    'compensation' =>$this->input->post('compensation'),
			'telecom' =>$this->input->post('telecom'),
			'part-time' =>$this->input->post('part-time'),
			'contract' =>$this->input->post('contract'),
			'non-profit' =>$this->input->post('non-profit'),
			'internship' =>$this->input->post('internship'),
			'direct_contact' =>$this->input->post('direct_contact'),
			'disabilities' =>$this->input->post('disabilities'),
			'job_wanted' =>$this->input->post('job_wanted'),
			'job_offered' =>$this->input->post('job_offered'),
	    );	
					$this->postmod->insert_job_meta($meta_data);
					$d=array('cat_id'=>$this->input->post('object_id'), 'post_id'=>$post_id);
					$this->postmod->category_post_relationship($d);
					$this->multifile_upload($post_id);
					redirect('/post/job_preview/'.$this->allencode->encode($post_id).'/'.$this->allencode->encode($this->input->post('c_email')));
		 }
		 
		 function job_preview($b,$k){
			 $this->load->library('allencode');
				//$this->load->library('encrypt');
				$this->load->model('postmod');
				$this->load->view('header');
				$post_id =  $this->allencode->decode($this->uri->segment(3));
				$email =  $this->allencode->decode($this->uri->segment(4)); 
				//$param=urldecode($k);
				$chek=$this->postmod->cheking_post($post_id ,$email);
						if($chek==true){
							$this->load->view('alert',array('alert_type'=>'unauth'));
						}else{
					$this->load->view('job/preview',array('id'=>$post_id,'post_mail'=>$email));
						}
				
				$this->load->view('footer');
	     }
		 function job_postupdate(){
			$this->load->library('allencode');
				$this->load->model('postmod');
				$update_id=$this->input->post('id');
				$data = array(
            'c_email' => $this->input->post('c_email'),
            'user_id' => $this->input->post('user_id'),
            'object_id' => $this->input->post('object_id'),
            'contact_phone_ok' => $this->input->post('contact_phone_ok'),
            'contact_text_ok' => $this->input->post('contact_text_ok'),
            'contact_phone' => $this->input->post('contact_phone'),
            'contact_name' => $this->input->post('contact_name'),
            'post_title' =>$this->input->post('post_title'),
			'geo_area' =>$this->input->post('geo_area'),
			'zipcode' =>$this->input->post('zipcode'),
			'post_content' =>$this->input->post('post_content'),
			'post_date'=>date("Y-m-d H:i:s"),
			'state' =>$this->input->post('state'),
        );
		           
					$post_id=$this->postmod->update_housing($data,$update_id);
			$meta_data=array(
			'post_id'=>$this->input->post('id'),		
			'cat_id'=>$this->input->post('cat_id'),		
		    'compensation' =>$this->input->post('compensation'),
			'telecom' =>$this->input->post('telecom'),
			'part-time' =>$this->input->post('part-time'),
			'contract' =>$this->input->post('contract'),
			'non-profit' =>$this->input->post('non-profit'),
			'internship' =>$this->input->post('internship'),
			'direct_contact' =>$this->input->post('direct_contact'),
			'disabilities' =>$this->input->post('disabilities'),
			'job_wanted' =>$this->input->post('job_wanted'),
			'job_offered' =>$this->input->post('job_offered'),
	    );	
					$this->postmod->update_job_meta($meta_data,$update_id);
					/*$d=array('cat_id'=>$this->input->post('object_id'), 'post_id'=>$post_id);
					$this->postmod->category_post_relationship($d);*/
					$this->multifile_upload($update_id);
					redirect('/post/job_preview/'.$this->allencode->encode($update_id).'/'.$this->allencode->encode($this->input->post('c_email')));
		}
		 
		/*====================Job Controller Ended==========================*/
		/*====================Event Controller Started==========================*/
		function addeventpost(){
			$this->load->library('allencode');
			$this->load->view('header');
	$this->load->view('event/addpost',array('parent_id'=>$this->input->post("parent_id"),'type'=>$this->input->post("type"),'child_id'=>$this->input->post("child_id")));
			$this->load->view('footer');
		}
		
		 function eventinsert(){
			 $this->load->library('allencode');
			 $this->load->model('postmod');
			 $data = array(
            'c_email' => $this->input->post('c_email'),
            'user_id' => $this->input->post('user_id'),
            /*'object_id' => $this->input->post('object_id'),*/
            'contact_phone_ok' => $this->input->post('contact_phone_ok'),
            'contact_text_ok' => $this->input->post('contact_text_ok'),
            'contact_phone' => $this->input->post('contact_phone'),
            'contact_name' => $this->input->post('contact_name'),
            'post_title' =>$this->input->post('post_title'),
			'geo_area' =>$this->input->post('geo_area'),
			'zipcode' =>$this->input->post('zipcode'),
			'post_content' =>$this->input->post('post_content'),
			'post_date'=>date("Y-m-d H:i:s"),
			'state' =>$this->input->post('state'),
        );
		$date = date(''.$this->input->post('event_year').'-'.$this->input->post('start_month').'-'.$this->input->post('start_date').' H:i:s');
			 $post_id=$this->postmod->insert_housing($data);
			 $meta_data=array(
			'post_id'=>$post_id,		
			/*'cat_id'=>$this->input->post('cat_id'),*/		
		    'start_month' =>$this->input->post('start_month'),
			'start_date' =>$this->input->post('start_date'),
			'event_year' =>$this->input->post('event_year'),
			'full_date'=>$date,
			'event_duration' =>$this->input->post('event_duration'),
			'event_art' =>$this->input->post('event_art'),
			'event_career' =>$this->input->post('event_career'),
			'event_charitable' =>$this->input->post('event_charitable'),
			'event_competition' =>$this->input->post('event_competition'),
			'event_dance' =>$this->input->post('event_dance'),
			'event_festival' =>$this->input->post('event_festival'),
			'event_fitness_wellness' =>$this->input->post('event_fitness_wellness'),
			'event_food' =>$this->input->post('event_food'),
			'event_free' =>$this->input->post('event_free'),
			'event_kidfriendly' =>$this->input->post('event_kidfriendly'),
			'event_literary' =>$this->input->post('event_literary'),
			'event_music' =>$this->input->post('event_music'),
			'event_outdoor' =>$this->input->post('event_outdoor'),
			'event_sale' =>$this->input->post('event_sale'),
			'event_singles' =>$this->input->post('event_singles'),
			'event_geek' =>$this->input->post('event_geek'),
			'event_advertisement' =>$this->input->post('event_advertisement'),
	    );	
					$this->postmod->insert_event_meta($meta_data);
					$d=array('cat_id'=>$this->input->post('object_id'), 'post_id'=>$post_id);
					$this->postmod->category_post_relationship($d);
					$this->multifile_upload($post_id);
					redirect('/post/event_preview/'.$this->allencode->encode($post_id).'/'.$this->allencode->encode($this->input->post('c_email')));
		 }
		 
		 function event_preview($b,$k){
			 $this->load->library('allencode');
				//$this->load->library('encrypt');
				$this->load->model('postmod');
				$this->load->view('header');
				$post_id =  $this->allencode->decode($this->uri->segment(3));
				$email =  $this->allencode->decode($this->uri->segment(4)); 
				//$param=urldecode($k);
				$chek=$this->postmod->cheking_post($post_id ,$email);
						if($chek==true){
							$this->load->view('alert',array('alert_type'=>'unauth'));
						}else{
					$this->load->view('event/preview',array('id'=>$post_id,'post_mail'=>$email));
						}
				
				$this->load->view('footer');
	     }
		 
		 function event_postupdate(){
			 	$this->load->library('allencode');
				$this->load->model('postmod');
				$update_id=$this->input->post('id');
				$data = array(
            'c_email' => $this->input->post('c_email'),
            'user_id' => $this->input->post('user_id'),
            /*'object_id' => $this->input->post('object_id'),*/
            'contact_phone_ok' => $this->input->post('contact_phone_ok'),
            'contact_text_ok' => $this->input->post('contact_text_ok'),
            'contact_phone' => $this->input->post('contact_phone'),
            'contact_name' => $this->input->post('contact_name'),
            'post_title' =>$this->input->post('post_title'),
			'geo_area' =>$this->input->post('geo_area'),
			'zipcode' =>$this->input->post('zipcode'),
			'post_content' =>$this->input->post('post_content'),
			'post_date'=>date("Y-m-d H:i:s"),
			'state' =>$this->input->post('state'),
        );
		    $date = date(''.$this->input->post('event_year').'-'.$this->input->post('start_month').'-'.$this->input->post('start_date').' H:i:s');      
			$post_id=$this->postmod->update_housing($data,$update_id);
			$meta_data=array(
			'post_id'=>$this->input->post('id'),		
			/*'cat_id'=>$this->input->post('cat_id'),	*/	
		    'start_month' =>$this->input->post('start_month'),
			'start_date' =>$this->input->post('start_date'),
			'event_year' =>$this->input->post('event_year'),
			'full_date'=>$date,
			'event_duration' =>$this->input->post('event_duration'),
			'event_art' =>$this->input->post('event_art'),
			'event_career' =>$this->input->post('event_career'),
			'event_charitable' =>$this->input->post('event_charitable'),
			'event_competition' =>$this->input->post('event_competition'),
			'event_dance' =>$this->input->post('event_dance'),
			'event_festival' =>$this->input->post('event_festival'),
			'event_fitness_wellness' =>$this->input->post('event_fitness_wellness'),
			'event_food' =>$this->input->post('event_food'),
			'event_free' =>$this->input->post('event_free'),
			'event_kidfriendly' =>$this->input->post('event_kidfriendly'),
			'event_literary' =>$this->input->post('event_literary'),
			'event_music' =>$this->input->post('event_music'),
			'event_outdoor' =>$this->input->post('event_outdoor'),
			'event_sale' =>$this->input->post('event_sale'),
			'event_singles' =>$this->input->post('event_singles'),
			'event_geek' =>$this->input->post('event_geek'),
			'event_advertisement' =>$this->input->post('event_advertisement'),
	    
	    );	
					$this->postmod->update_event_meta($meta_data,$update_id);
					/*$d=array('cat_id'=>$this->input->post('object_id'), 'post_id'=>$post_id);
					$this->postmod->category_post_relationship($d);*/
					$this->multifile_upload($update_id);
					redirect('/post/event_preview/'.$this->allencode->encode($update_id).'/'.$this->allencode->encode($this->input->post('c_email')));
		 }
		 	/*====================Event Controller Ended==========================*/
}



