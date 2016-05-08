<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modlogin extends CI_Model{
	
	  function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
       }
	
	function check_email($the_mail){
		$this->db->select('email');
        $this->db->from('login');
        $this->db->where('email', $the_mail );
		$query = $this->db->get();
        if ( $query->num_rows() > 0 ){ return 'exists';}else{ return 'notexists';}
		
	}
	function insert_login($datanew){
		 $this->db->insert('login', $datanew);  
		 return $this->db->insert_id();
	}
	function active_mod_email($user_id,$key){
		$query = $this->db->query("SELECT * FROM `login` WHERE `id`='".$user_id."' AND `active_key`='".$key."'");
		//echo $this->db->last_query();
		if($query->num_rows()==0){
			return false;
		}else{
			$query = $this->db->query("UPDATE `login` SET  `active_key`='', `other`='1' WHERE `id`='".$user_id."' AND `active_key`='".$key."'");
		//echo $this->db->last_query();
			return true;
		}
	}
	
	function insert_password($logindata){
		$query = $this->db->query("UPDATE `login` SET  `password`='".md5($logindata['password'])."' WHERE `id`='".$logindata['id']."'");
		return true;
	}
	function try_to_login($logindata){
		$query = $this->db->query("SELECT * FROM `login` WHERE `email`='".$logindata['email']."' AND `active_key`='' AND `other`='1' ");
		if($query->num_rows()==0){
				$query = $this->db->query("SELECT * FROM `login` WHERE `email`='".$logindata['email']."' AND `active_key`!=''");
				if($query->num_rows()==1){
					return 'not_active_yet';
				}else{
					return 'not_exists';
				}
		}else{
				$query = $this->db->query("SELECT * FROM `login` WHERE `email`='".$logindata['email']."' AND `active_key`='' AND `other`='1' AND `password`='".md5($logindata['password'])."'");
				if($query->num_rows()==1){
					$data = $query->result_array();
					$this->session->set_userdata( 'logged_in',array(
                            'user_id'       => $data[0]['id'],
                            'email'      => $data[0]['email'],
                            'username'      => $data[0]['username'],
                    ));
					$user_log=$this->session->userdata('logged_in');

					 //print_r($this->session->userdata('logged_in'));
				return 'access_to_login';	

				}else{
					return 'pwd_not_exists';
				}
		}
	}
	
	function reset_email($logindata){
		$query = $this->db->query("SELECT * FROM `login` WHERE `email`='".$logindata['email']."'  AND `active_key`='' AND `other`='1'");
		if($query->num_rows()==0){
			return 'mail_not_exists';
		}else{
			$query = $this->db->query("UPDATE `login` SET  `password`='".md5($logindata['password'])."' WHERE `email`='".$logindata['email']."'");
			return 'pwd_reset';
		}
	}
		
}

?>