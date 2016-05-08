<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Businessmod extends CI_Model{
	function __construct() {
        parent::__construct();
		$this->load->library('email');
		$this->load->library("session");
		$this->load->database();
		$this->load->library("session");
       }
	 
	 function fetch_category(){
		$this->db->select('category_name, id');
		$this->db->from('bd_categories');
		$this->db->order_by("category_name", "asc");
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	 }
	 
	 function insert_business($data){
		$this->db->insert('bd_add_business', $data);  
		return $this->db->insert_id();
		   //echo $this->db->last_query();
	 }
	 
	 function fetch_bdpost_id($bd_id){
		$q_m=$this->db->get_where('bd_add_business', array('id' => $bd_id),1,0);
		$data = $q_m->result_array();
		return $data;
	 }
	 
	 function get_bd_catby_id($id){
		$q_m=$this->db->get_where('bd_categories', array('id' => $id),1,0);
		foreach($q_m->result_array() as $v){
		echo $v['category_name'];
			}
	 }
	 
	 function get_bd_image($id){
		 $this->db->select('*');
		 $this->db->where('bd_id', $id );
		 $query = $this->db->get('images');
		 $data = $query->result_array();
		// echo $this->db->last_query();
		 return $data;
	 }
	 
	 function update_bd_status($post_id,$data){
		  $this->db->where('id',$post_id);
		  $this->db->update('bd_add_business',$data); 
		  //echo $this->db->last_query();
	 }
	 
	 function update_db_profile($data,$id){
		  $this->db->where('id',$id);
		  $this->db->update('bd_add_business',$data); 
		  //echo $this->db->last_query();
	 }
	 
	 function get_businessname_bycat($b_cat_id,$city_id){
		   $this->db->select('b_name');
		   $this->db->where('b_cat_id', $b_cat_id );
		   $this->db->where('status', 1 );
		   $this->db->where('b_city', $city_id );
		   $this->db->order_by('b_name','ASC');
		   $query = $this->db->get('bd_add_business');
		   $data = $query->result_array();
		   //echo $this->db->last_query();
		   return $data;
	 }
	 
	 function get_businessprofile_bycat($b_cat_id,$city_id,$start_limit,$end_limit){
		   $this->db->select('*');
		   $this->db->where('b_cat_id', $b_cat_id );
		   $this->db->where('status', 1 );
		   $this->db->where('b_city', $city_id );
		   $this->db->order_by('b_name','ASC');
		   $query = $this->db->get('bd_add_business',$start_limit,$end_limit);
		   //$data = $query->result_array();
		   //echo $this->db->last_query();
		   return $query;
	 }
	 function get_businessprofile_totalrow($b_cat_id,$city_id){
		   $this->db->where('b_cat_id', $b_cat_id );
		   $this->db->where('status', 1 );
		   $this->db->where('b_city', $city_id );
		   $this->db->order_by('b_name','ASC');
		   $query=$this->db->count_all('bd_add_business');
		   /*  echo $this->db->last_query();*/
		   return $query;
	 }
	 
	 function get_businessname_byid($id){
		   $this->db->select('b_name');
		   $this->db->where('id', $id );
		   $this->db->where('status', 1 );
		   $query = $this->db->get('bd_add_business');
		   $data = $query->result_array();
		   //echo $this->db->last_query();
		   return $data;
	 }
	 
	 function get_singlebd_byid($id){
		   $this->db->select('*');
		   $this->db->where('id', $id );
		   $this->db->where('status', 1 );
		   $query = $this->db->get('bd_add_business');
		   $data = $query->result_array();
		   //echo $this->db->last_query();
		   return $data;
	 }
	 
	 function ins_image($data){
		  $this->db->insert('images', $data);  
	 }
	 
	 function check_image($id){
		   $this->db->select('img');
		   $this->db->where('bd_id', $id );
		   $query = $this->db->get('images');
		   $data = $query->result_array();
		   //echo $this->db->last_query();
		   return $data;
	 }
	 function get_businesss_list_by_useremail($email){
		   $this->db->select('*');
		   $this->db->where('b_email', $email );
		   $query = $this->db->get('bd_add_business');
		   $data = $query->result_array();
		   //echo $this->db->last_query();
		   return $data;
	 }
	 function get_classified_list_by_useremail($email){
		   $this->db->select('*');
		   $this->db->where('c_email', $email );
		   $query = $this->db->get('post');
		   $data = $query->result_array();
		   //echo $this->db->last_query();
		   return $data;
	 }	 
	 function delimage($bdid){
		  $query = $this->db->query("DELETE FROM `images` WHERE `bd_id`='".$bdid."'");
	 }
	 function update_image($id,$data){
		  $this->db->where('bd_id',$id);
		  $this->db->update('images',$data); 
			
		}
	 function add_review($data){
		  $this->db->insert('ratings', $data);  
		  return $this->db->insert_id();
	 }
	 function get_all_preview($id){
		   $this->db->select('*');
		   $this->db->where('post_id', $id );
		   $query = $this->db->get('ratings');
		   $data = $query->result_array();
		   //echo $this->db->last_query();
		   return $data;
	 }
	 function get_avg_ratings($id){
		 	$query1 = $this->db->query("SELECT SUM(imgId) AS torev FROM ratings WHERE post_id='".$id."'");
			$data1 = $query1->result_array();
			$query = $this->db->query("SELECT COUNT(*) AS numr FROM ratings WHERE post_id='".$id."'");
			$data = $query->result_array();
			if($data[0]['numr']!=0){
			$avg=$data1[0]['torev']/$data[0]['numr'];
			return $avg;
			}else{
			return 0;	
			}
	 }
	 function get_review_count($id){
		 	$query = $this->db->query("SELECT COUNT(*) AS numr FROM ratings WHERE post_id='".$id."'");
			$data = $query->result_array();
			return $data[0]['numr'];
	 }
	 
	 function check_review_by_user($id,$post_id){
		 	$query = $this->db->query("SELECT * FROM ratings WHERE user_id='".$id."' AND post_id='".$post_id."'");
			$data = $query->num_rows();
			return $data;
	 }
	 function get_single_star($post_id,$imgId){
		 	$query = $this->db->query("SELECT * FROM ratings WHERE imgId='".$imgId."' AND post_id='".$post_id."'");
			$data = $query->num_rows();
			return $data;		 
	 }
	 function get_bar_width($post_id,$imgId){
		 	$per_star_count=$this->get_single_star($post_id,$imgId);
			$tot_count=$this->get_review_count($post_id);
			if($tot_count!=0){
			$returnable=(($per_star_count*100)/$tot_count)/*+15*/;
			return $returnable;
			}else{
			return 0;
			}
	 }
	 function get_user_picture($user_id){
		 	$query = $this->db->query("SELECT `username`,`user_image` FROM login WHERE id='".$user_id."'");
			$data = $query->result_array();
			return $data;		    
	 }
	 function add_private_message($data){
		    $this->db->insert('private_message', $data);  
		    return $this->db->insert_id();		 
	 }
	 function add_private_message_status($data){
		 	$this->db->insert('private_message_status', $data);  
	 }
	 function add_private_message_status2($data){
		 	$this->db->insert('private_message_status', $data);  
	 }	 
	 function add_private_message_reply($data){
		    $this->db->insert('private_message_reply', $data);  
		    return $this->db->insert_id();		 
	 }
	 function check_commnet($user_id,$post_id){
		    $this->db->select('*');
		    $this->db->where('user_id', $user_id );
			$this->db->where('post_id', $post_id );
			$query = $this->db->get('private_message');
			return $query->num_rows() ;
			//echo $this->db->last_query();
	 }
	 function get_bd_email($post_id){
		 	$this->db->select('b_email');
			$this->db->where('id', $post_id );
			$query = $this->db->get('bd_add_business');
			$data = $query->result_array();
			return $data;		    
	 }	
	 function get_cl_email($post_id){
		 	$this->db->select('c_email');
			$this->db->where('id', $post_id );
			$query = $this->db->get('post');
			$data = $query->result_array();
			return $data;		    
	 } 
	 function check_user_profile($poster_id,$method){
			if($method=='num_rows'){
				  $datag= $this->get_bd_email($poster_id);			
				  $query = $this->db->query("SELECT * FROM `login` INNER JOIN `bd_add_business` ON `login`.`email`=`bd_add_business`.`b_email` WHERE `login`.`email`='".$datag[0]['b_email']."' AND `login`.`active_key`='' AND `login`.`other`=1" ); //echo $this->db->last_query();
			      return $query->num_rows() ;
			}else if($method=='full_fetch'){
				  $data = $this->get_bd_email($poster_id);//
				  return $data;	
			}
	 }
	 function check_user_profile_cl($poster_id,$method){
			if($method=='num_rows'){
				  $datag= $this->get_cl_email($poster_id);			
				  $query = $this->db->query("SELECT * FROM `login` INNER JOIN `post` ON `login`.`email`=`post`.`c_email` WHERE `login`.`email`='".$datag[0]['c_email']."' AND `login`.`active_key`='' AND `login`.`other`=1" ); //echo $this->db->last_query();
			      return $query->num_rows() ;
			}else if($method=='full_fetch'){
				  $data = $this->get_bd_email($poster_id);//
				  return $data;	
			}
	 }
	 function get_all_first_comment($user_id,$post_type,$status){
		    /*$this->db->select('*');
			$this->db->where('post_type', $post_type );
		    $this->db->where('user_id', $user_id );
			$this->db->or_where('poster_id', $user_id );
			$query = $this->db->get('private_message');
			$query = $this->db->query("SELECT * FROM (`private_message`) WHERE `status`='".$status."' AND `post_type` = '".$post_type."' AND (`user_id` = '".$user_id."' OR `poster_id` = '".$user_id."')");
			$query=$this->db->query("SELECT * FROM (`private_message`) WHERE `post_type` = '".$post_type."' AND ((`user_id` = '".$user_id."' AND `user_status`='".$status."') AND ( `poster_id` = '".$user_id."' AND `poster_status`='".$status."'))");*/
			$query=$this->db->query("SELECT private_message.id,private_message.message,private_message.post_date,private_message.user_id,private_message.poster_id FROM private_message INNER JOIN private_message_status ON private_message.id=private_message_status.message_id WHERE private_message.post_type='".$post_type."' AND private_message_status.status='".$status."' AND (private_message_status.user_id='".$user_id."' OR private_message_status.poster_id='".$user_id."')");
			$data = $query->result_array();
			//echo $this->db->last_query();	 
			return $data;	
			
	 }
	 function get_all_innitial_comment($user_id,$post_type,$id){
		    $this->db->select('*');
		    $this->db->where('user_id', $user_id );
			 $this->db->where('id', $id );
			$this->db->where('post_type', $post_type );
			$query = $this->db->get('private_message');
			$data = $query->result_array();
			echo $this->db->last_query();	
			return $data;		 
	 }	 
	 function get_poster_postid($post_id,$tbl_name,$field){
		    $query = $this->db->query("SELECT `login`.`id` FROM `login` INNER JOIN `".$tbl_name."` ON `login`.`email`=`".$tbl_name."`.`".$field."` WHERE `".$tbl_name."`.`id`='".$post_id."' AND `login`.`active_key`='' AND `login`.`other`=1" );
			//echo $this->db->last_query();
			$data = $query->result_array();
			if(isset($data[0]['id'])){ return $data[0]['id'];}else{ return 0;}
	 }
	 function fetch_allreply_from_message($message_id){
		 	$this->db->select('*');
			$this->db->where('message_id', $message_id );
			$this->db->where('post_type', 'BD' );
			$this->db->order_by("reply_date","asc");
			$query = $this->db->get('private_message_reply');
			$data = $query->result_array();
			return $data;
	 }
	 function fetch_allreply_from_message_cl($message_id){
		 	$this->db->select('*');
			$this->db->where('message_id', $message_id );
			$this->db->where('post_type', 'CL' );
			$this->db->order_by("reply_date","asc");
			$query = $this->db->get('private_message_reply');
			$data = $query->result_array();
			return $data;
	 }
	 function count_comment($post_type,$status , $user_id){
		/* $query = $this->db->query("SELECT COUNT(*) AS numr FROM private_message_ WHERE post_type='".$post_type."' AND status='".$status."' AND (`user_id`='".$user_id."' OR `poster_id`='".$user_id."' )");*/
		 	$query = $this->db->query("SELECT private_message.id,private_message.message,private_message.post_date,private_message.user_id,private_message.poster_id FROM private_message INNER JOIN private_message_status ON private_message.id=private_message_status.message_id WHERE private_message.post_type='".$post_type."' AND private_message_status.status='".$status."' AND (private_message_status.user_id='".$user_id."' OR private_message_status.poster_id='".$user_id."')");
			$data = $query->num_rows();
			return $data;
			//return $data[0]['numr'];
			//echo $this->db->last_query();
	 }
	 function get_all_review_byuser($userid){
		   $this->db->select('*');
		   $this->db->where('user_id', $userid );
		   $query = $this->db->get('ratings');
		   $data = $query->result_array();
		   return $data;
	 }
	 function get_postname_by_postid($post_id){
		 	$this->db->select('*');
			$this->db->where('id', $post_id );
			$query = $this->db->get('bd_add_business');
		    $data = $query->result_array();
		    echo $data[0]['b_name'];			
	 }
	 function updated_review($data,$post_id,$user_id){
		  $this->db->where('post_id',$post_id);
		  $this->db->where('user_id',$user_id);
		  $this->db->update('ratings',$data); 
		  //echo $this->db->last_query();
	 }
	 function make_read($data,$id){
		 $this->db->where('id',$id);
		  $this->db->update('private_message',$data);
	 }
	 
	 
}