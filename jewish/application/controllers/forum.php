<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller{

		function __construct(){

		parent::__construct();

		$this->load->database();

		$this->load->model('citymod');

		$this->load->library("session");

		$this->load->helper('form');

		$this->load->model('businessmod');

		$this->load->model('postmod');

		$this->load->library('allencode');

	}

	public function index(){

		$this->load->helper('form');

		$this->load->database();

 		$this->load->view('forum/header');

 		$k=$this->load->model('forum_module');

 		$catdt['catd'] = $this->forum_module->catdata();

		

		$catdt['forumdata'] = $this->forum_module->forumall();

 		//echo "<pre>";

		

		 //       print_r($catdt);



  		$this->load->view('forum/forum',$catdt);

 		//$user_log=$this->session->userdata('logged_in');

		//$this->load->view('housing/post');

		$this->load->view('footer');

	}

    public function insert_forum()

 {

 		$k=$this->load->model('forum_module');

	$_POST['indata'] = $this->forum_module->insert_data();

 	//echo $indata; 

	 

 }

 



 	public function questions()

 {

		$this->load->helper('form');

		$this->load->database();

 		$this->load->view('forum/header');

  		$k=$this->load->model('forum_module');

 		$catdt['catd'] = $this->forum_module->catdata();

		

		$catdt['forumdata'] = $this->forum_module->forumall();

		 $update_thread= $this->forum_module->update_thread();

		 if($update_thread){

		 $catdt['update_thread'] =  $update_thread;

		 $curl= JEWISH_URL.'/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$update_thread;

  		 redirect($curl, 'refresh');

		 }

 		//echo "<pre>";

		

		 //       print_r($catdt);

        if($this->uri->segment(3))

		{

			$catdt['forumcomment'] = $this->forum_module->forumcomment($this->uri->segment(3));

			$catdt['forumdata'] = $this->forum_module->forumdata($this->uri->segment(3));

			$this->load->view('forum/forumcat',$catdt);

			$this->forum_module->insert_data();

            $ar = $this->forum_module->replysubmit();



 		}

        else

		{

  		  $this->load->view('forum/forumcat',$catdt);

 		}

 		

 		$this->load->view('footer');

        }

	public function sidebar()		

	{

	 $this->load->database();

		

		 $formdata=$this->db->get('forum');

		 $data=$formdata->result();

	 // print_r($data);	 

	 for($i=0;$i<sizeof($data);$i++){

		  $vr= (array) $data[$i];	

		//  echo $vr['forum_name']; 

		//  echo "<br>";

		//  echo $vr['forum_slug']; 

  		$k=$this->load->model('forum_module');

   		$kv=$this->forum_module->forumwish_cat($vr['forum_cat']);

  //	 echo "<li>Thread post on: ".$vr['forum_modified_date']." <a href='".JEWISH_URL.'/forum/'.$kv.'/'.$vr['forum_slug']."'>".$vr['forum_name']."</a></li>";

	 }

	}

		

		

 public function threaddelete()

 {

 		$this->load->database();

  //		$k=$this->load->model('forum_module');

 //  $ar = $this->forum_module->delthread();

 //echo 'got data'.$_REQUEST['mdata'];

     $this->db->where('forum_id',$_REQUEST['mdata']);

	 $this->db->delete('forum');

	// echo "forums-post".$_REQUEST['mdata'];

    }

 

 	public function announcements()

 {

		$this->load->helper('form');

		$this->load->database();

 		$this->load->view('forum/header');

 		$k=$this->load->model('forum_module');

 		

 		$catdt['catd'] = $this->forum_module->catdata();

 		$catdt['forumdata'] = $this->forum_module->forumall();

		 $update_thread= $this->forum_module->update_thread();

		 if($update_thread){

		 $catdt['update_thread'] =  $update_thread;

		 $curl= JEWISH_URL.'/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$update_thread;

  		 redirect($curl, 'refresh');

		 }

		

         if($this->uri->segment(3))

		{

		$catdt['forumcomment'] = $this->forum_module->forumcomment($this->uri->segment(3));

		$catdt['forumdata'] = $this->forum_module->forumdata($this->uri->segment(3));

  		  $this->load->view('forum/forumcat',$catdt);

			$this->forum_module->insert_data();

         $ar = $this->forum_module->replysubmit();

 		}

        else

		{

  		  $this->load->view('forum/forumcat',$catdt);

 		}

		$this->load->view('footer');

 }

 	public function discussions()

 {

		$this->load->helper('form');

		$this->load->database();

 		$this->load->view('forum/header');

 		$k=$this->load->model('forum_module');

 		$catdt['catd'] = $this->forum_module->catdata();

		

		$catdt['forumdata'] = $this->forum_module->forumall();

			$this->forum_module->insert_data();

		 $update_thread= $this->forum_module->update_thread();

		 if($update_thread){

		 $catdt['update_thread'] =  $update_thread;

		 $curl= JEWISH_URL.'/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$update_thread;

  		 redirect($curl, 'refresh');

		 }

        if($this->uri->segment(3))

		{

		$catdt['forumcomment'] = $this->forum_module->forumcomment($this->uri->segment(3));

		$catdt['forumdata'] = $this->forum_module->forumdata($this->uri->segment(3));

  		$this->load->view('forum/forumcat',$catdt);

		$this->forum_module->insert_data();

        $ar = $this->forum_module->replysubmit();

 		}

        else

		{

  		  $this->load->view('forum/forumcat',$catdt);

 		}

		

		

		$this->load->view('footer');

 }

 	public function chitchat()

 {

		$this->load->helper('form');

		$this->load->database();

 		$this->load->view('forum/header');

 		$k=$this->load->model('forum_module');

 		$catdt['catd'] = $this->forum_module->catdata();

		 $update_thread= $this->forum_module->update_thread();

		 if($update_thread){

		 $catdt['update_thread'] =  $update_thread;

		 $curl= JEWISH_URL.'/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$update_thread;

  		 redirect($curl, 'refresh');

		 }

		$catdt['forumdata'] = $this->forum_module->forumall();

			$this->forum_module->insert_data();

        $ar = $this->forum_module->replysubmit();

		

        if($this->uri->segment(3))

		{

		$catdt['forumcomment'] = $this->forum_module->forumcomment($this->uri->segment(3));

		$catdt['forumdata'] = $this->forum_module->forumdata($this->uri->segment(3));

  		  $this->load->view('forum/forumcat',$catdt);

			$this->forum_module->insert_data();

 		}

        else

		{

  		  $this->load->view('forum/forumcat',$catdt);

 		}

		$this->load->view('footer');

 }

  

 public function yourthreads()

 {

		$this->load->helper('form');

		$this->load->database();

 		$this->load->view('forum/header');

 		$k=$this->load->model('forum_module');

 		$catdt['catd'] = $this->forum_module->catdata();

		$catdt['forumdata'] = $this->forum_module->yourthreads();
		$catdt['commentforumdata'] = $this->forum_module->commentforumdata();
		$this->forum_module->insert_data();

        $ar = $this->forum_module->replysubmit();

        if($this->uri->segment(3))

		{

 

  		$this->load->view('forum/forumcat',$catdt);

		$this->forum_module->insert_data();

 		}

        else

		{

  		  $this->load->view('forum/mythreads',$catdt);

 		}

		$this->load->view('footer');

 }

 

 function commentlogin()

 {

 $this->load->database();

	//echo $_REQUEST['fcomment_name'].$_REQUEST['fcomment_email']; 

 	 $formdata=$this->db->get_where('commentuser',array('comuser_email'=>$_REQUEST['fcomment_email'],'comuser_name'=>$_REQUEST['fcomment_name']))->result();	

     if(sizeof($formdata))

	{

    $sess_array = array(

         'comuser_name' => $_REQUEST['fcomment_name'],

           'comuser_email' => $_REQUEST['fcomment_email'],

		   'logged_in'=>'TRUE'

        );

       $this->session->set_userdata('comuser_name', $sess_array);	

		$session_id = $this->session->userdata('comuser_name');

		 echo '1';

	}

	else{
		
		
		
//$formdata=$this->db->get_where('commentuser',array('comuser_email'=>$_REQUEST['fcomment_email'],'comuser_name'=>$_REQUEST['fcomment_name']))->result();	
         $comuser_name = $_REQUEST['fcomment_name'];
          $comuser_email = $_REQUEST['fcomment_email'];

		$query = $this->db->query("SELECT * FROM `commentuser` where (comuser_name='$comuser_name'and comuser_email!='$comuser_email')or (comuser_name!='$comuser_email'and comuser_email='$comuser_email')");              
       $count =  $query->row(); // returns an object of the first row
       if($count->comuser_id)
	 {
		echo '2'; 
 
		 
	 }
		else{
		
		

	$data=array('comuser_name'=>$_REQUEST['fcomment_name'],'comuser_email'=>$_REQUEST['fcomment_email']);

		$this->db->insert('commentuser',$data);	

		//return 1;

    $sess_array = array(

         'comuser_name' => $_REQUEST['fcomment_name'],

           'comuser_email' => $_REQUEST['fcomment_email'],

		   'logged_in'=>'TRUE'

        );

       $this->session->set_userdata('comuser_name', $sess_array);		

		$session_id = $this->session->userdata('comuser_name');

		 echo '1';

		//return true;

	//	print_r($session_id);

		}

	}

 }

 

 

 

 

 

 

 

 public function newthreads()

 {

	 // echo "hiiiii";//die();

	 // echo $_REQUEST['forum_cat'];

		$this->load->helper('form');

		$this->load->database();

 		$this->load->view('forum/header');

 		$k=$this->load->model('forum_module');

  		

		$catdt['catd'] = $this->forum_module->catdata();
		if($this->input->post('forum_author_name'))		

         {		

	 		$_REQUEST['indata']=$this->forum_module->insert_nonuser_thread();

         }


		if($this->input->post('forum_name'))		

         {		

	 		$_REQUEST['indata']=$this->forum_module->insert_thread();

         }
		 
		 
		 
		 
		 

 	  	$this->load->view('forum/newthreads',$catdt);

  		$this->load->view('footer');

  }

 	

//	function preview(){

//		$this->load->model('postmod');

//		$this->load->view('header');

//		$data = array();

//		//$this->load->view('housing/preview');

//		$data = array(

//            'c_email' => $this->input->post('c_email'),

//            'user_id' => $this->input->post('user_id'),

//            'object_id' => $this->input->post('object_id'),

//            'contact_phone_ok' => $this->input->post('contact_phone_ok'),

//            'contact_text_ok' => $this->input->post('contact_text_ok'),

//            'contact_phone' => $this->input->post('contact_phone'),

//            'contact_name' => $this->input->post('contact_name'),

//            'post_title' =>$this->input->post('post_title'),

//			'geo_area' =>$this->input->post('geo_area'),

//			'zipcode' =>$this->input->post('zipcode'),

//			'post_content' =>$this->input->post('post_content'),

//			

//        );

//		$meta_data=array(

//		    'sqft' =>$this->input->post('sqft'),

//			'ask' =>$this->input->post('ask'),

//			'movein_month' =>$this->input->post('movein_month'),

//			'movein_day' =>$this->input->post('movein_day'),

//			'parking' =>$this->input->post('parking'),

//			'laundry' =>$this->input->post('laundry'),

//			'sale_date_1' =>$this->input->post('sale_date_1'),

//			'sale_date_2' =>$this->input->post('sale_date_2'),

//			'sale_date_3' =>$this->input->post('sale_date_3'),

//			'wheelchaccess' =>$this->input->post('wheelchaccess'),

//			'no_smoking' =>$this->input->post('no_smoking'),

//			'private_bath' =>$this->input->post('private_bath'),

//			'private_room' =>$this->input->post('private_room'),

//			'pets_cat' =>$this->input->post('pets_cat'),

//			'pets_dog' =>$this->input->post('pets_dog'),

//			'contact_ok' =>$this->input->post('contact_ok')

//	    );

//		$post_id=$this->postmod->insert_housing($data);

//		$this->postmod->insert_housing_meta($meta_data,$post_id);

//		$d=array('cat_id'=>$this->input->post('object_id'), 'post_id'=>$post_id);

//		$this->postmod->category_post_relationship($d);

//		$this->multifile_upload($post_id);

//		 

//		$this->load->view('housing/preview',array('id'=>$post_id));

//		$this->load->view('footer');

//	}

//	

//	function multifile_upload($use_id){

//	$this->load->model('postmod');

//	$number_of_files = sizeof($_FILES['post_images']['tmp_name']);

// 

//    $files = $_FILES['post_images'];

// 

//				for($i=0;$i<$number_of_files;$i++)

//				{

//				  if($_FILES['post_images']['error'][$i] != 0)

//				  {

//					//$this->form_validation->set_message('fileupload_check', 'Couldn\'t upload the file(s)');

//					return FALSE;

//				  }

//				}

//    

//   

//    $this->load->library('upload');

//    $config['upload_path'] = FCPATH . 'upload/';

//    $config['allowed_types'] = 'gif|jpg|png';

//

//					for ($i = 0; $i < $number_of_files; $i++)

//					{

//					  $_FILES['post_images']['name'] = $files['name'][$i];

//					  $_FILES['post_images']['type'] = $files['type'][$i];

//					  $_FILES['post_images']['tmp_name'] = $files['tmp_name'][$i];

//					  $_FILES['post_images']['error'] = $files['error'][$i];

//					  $_FILES['post_images']['size'] = $files['size'][$i];

//	$this->postmod->multi_image(str_replace(' ', '_',$_FILES['post_images']['name']),$use_id);

//	$this->upload->initialize($config);

//					  if ($this->upload->do_upload('post_images'))

//					  {

//						$this->_uploaded[$i] = $this->upload->data();

//						

//					  }

//					  else

//					  {

//						$this->form_validation->set_message('fileupload_check', $this->upload->display_errors());

//						return FALSE;

//					  }

//					}

//		

//	}

	

}







