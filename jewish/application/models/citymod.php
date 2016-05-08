<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Citymod extends CI_Model{
	  function __construct() {
        parent::__construct();
		$this->load->library('email');
		$this->load->library("session");
		$this->load->database();
       }	
	  function fetch_city(){
		$this->db->select('*');
		$this->db->order_by("name","asc");		
		$query = $this->db->get('city');
		$data = $query->result_array();
		return $data;
	  }
	  function fetch_single_city($id){
		$q_m=$this->db->get_where('city', array('id' => $id),1,0);
		foreach($q_m->result_array() as $v){
		return $v['name'];
			}
	  }
	
	
}