<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classified extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('citymod');
		$this->load->library("session");
		$this->load->helper('form');
		$this->load->model('businessmod');
		$this->load->model('postmod');
		$this->load->library('allencode');
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
	public function index()
	{
		$this->load->helper('form');
		$this->load->database();
		$this->load->model('postmod');
        $this->load->view('header');
		$this->load->view('classified');
		$this->load->view('footer');	
		}
	public function housing(){
		$this->load->view('header');
		$this->load->view('classified',array('type'=>'housing'));
		$this->load->view('footer');	
	}
	public function job(){
		$this->load->view('header');
		$this->load->view('classified',array('type'=>'job'));
		$this->load->view('footer');	
	}
	public function event(){
		$this->load->view('header');
		$this->load->view('classified',array('type'=>'event'));
		$this->load->view('footer');	
	}
	function search(){
		/*===========================*/
		$cat_type= $this->uri->segment(3);
		$cat_id=$this->uri->segment(4);
		$this->load->library('allencode');
		$this->load->model('postmod');
		$this->load->view('header');
				if($cat_type=='housing'){
				     $this->load->view('listing/housing',array('cat_id'=>$cat_id,'type'=>$cat_type));
				}else if($cat_type=='job'){
					 $this->load->view('listing/job',array('cat_id'=>$cat_id,'type'=>$cat_type));
				}else if($cat_type=='event'){
					 $this->load->view('listing/event',array('cat_id'=>$cat_id,'type'=>$cat_type));
				}else{
					 $this->load->view('listing/nolisting');
				}
		$this->load->view('footer');
	}
	function single_housing(){
		$this->load->library('allencode');
		$post_id=$this->allencode->decode($this->uri->segment(3));
		$this->load->model('postmod');
		$this->load->view('header');
		$this->load->view('housing/singlepost',array('id'=>$post_id));
		$this->load->view('footer');
	}
	
	function single_job(){
		$this->load->library('allencode');
		$post_id=$this->allencode->decode($this->uri->segment(3));
		$this->load->model('postmod');
		$this->load->view('header');
		$this->load->view('job/singlepost',array('id'=>$post_id));
		$this->load->view('footer');
	}
	
	function single_event(){
		$this->load->library('allencode');
		$post_id=$this->allencode->decode($this->uri->segment(3));
		$this->load->model('postmod');
		$this->load->view('header');
		$this->load->view('event/singlepost',array('id'=>$post_id));
		$this->load->view('footer');
	}
	function get_children(){
		$ftdata=$this->postmod->get_children($_POST['parent_id']);
		$revert='<select name="child_id" onchange="this.form.submit();">';
		$revert.='<option value="">Please Select</option>';
		foreach ($ftdata as $row){
			$revert.='<option value="'.$row['id'].'">'.ucwords($row['category_name']).'</option>';
		}
		$revert.='</select>';
		echo $revert;
	}
	function get_children_r(){
		$ftdata=$this->postmod->get_children($_GET['pot']);  
		$revert='';
		foreach ($ftdata as $row){
			$revert.='<li><a href="'.JEWISH_URL.'/classified/search/housing/?cat_id='.$row['id'].'">'.ucwords($row['category_name']).'</a></li>';
		}
		echo $revert;
	}	

}