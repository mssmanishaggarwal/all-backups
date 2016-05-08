<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagess extends CI_Model{

	function __construct(){

		parent::__construct();

		$this->load->library('email');

		$this->load->library("session");

		$this->load->database();

		$this->load->library("session");	

	}

	

	public function fetch_test_image(){

		$this->db->select('*');

		$this->db->from('images');

		$query=$this->db->get();

		$data = $query->result_array();

		echo $this->db->last_query();

		return $data;

	}

	 function update_image($post_id,$data){

		  $this->db->where('id',$post_id);

		  $this->db->update('images',$data); 

		  //echo $this->db->last_query();

	 }

		 function multi_image($img){

		   $datanew = array(

						   'image_file' => $img,

						   

						  );

		   $this->db->insert('images', $datanew);  

	   }

	 function delimage($delid){
		 $query = $this->db->query("DELETE FROM `images` WHERE `id`='".$delid."'");
	 }

	 function get_the_image($var){
	 	 $q_m=$this->db->get_where('images', array('id' => $var));
		 foreach($q_m->result_array() as $k=>$v){
					
					return $v['image_file'];
				}
	 }

	

}