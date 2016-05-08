<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Postmod extends CI_Model{
	  function __construct() {
        parent::__construct();
		$this->load->library('email');
		$this->load->library("session");
		$this->load->database();
		$this->load->library("session");
       }
	 function multi_image($img,$use_id){
		   $datanew = array(
						   'post_id' => $use_id,
						   'img' => $img,
						   
						  );
		   $this->db->insert('images', $datanew);  
	   }
	 function multi_image_bd($img,$use_id){
		   $datanew = array(
						   'bd_id' => $use_id,
						   'img' => $img,
						   
						  );
		   $this->db->insert('images', $datanew);  
	   }	   
	 function insert_housing( $data){
		   $this->db->insert('post', $data);  
		   return $this->db->insert_id();
	   }
	  function insert_housing_meta($metadata){
			$this->db->insert('housing_post_meta', $metadata);
		
	  }
	  function insert_job_meta($metadata){
			$this->db->insert('job_post_meta', $metadata);
		
	  }
	   function insert_event_meta($metadata){
			$this->db->insert('event_post_meta', $metadata);
		
	  }
	 function category_post_relationship($d){
		 	$this->db->insert('category_post_relationship', $d);
	 }
	 function get_post_meta($post_id, $metakey){
		 $query = $this->db->select($metakey);
		$q_m=$this->db->get_where('housing_post_meta', array('post_id' => $post_id));
		 foreach($q_m->result_array() as $k=>$v){
					
					return $v[$metakey];
				}
	 }
	 function get_post_meta_job($post_id, $metakey){
		 $query = $this->db->select($metakey);
		$q_m=$this->db->get_where('job_post_meta', array('post_id' => $post_id));
		 foreach($q_m->result_array() as $k=>$v){
					
					return $v[$metakey];
				}
	 }
	 function get_post_meta_event($post_id, $metakey){
		 $query = $this->db->select($metakey);
		$q_m=$this->db->get_where('event_post_meta', array('post_id' => $post_id));
		 foreach($q_m->result_array() as $k=>$v){
					
					return $v[$metakey];
				}
	 }
	 function category_type_by_post_id($post_id){
		 	$query = $this->db->query("SELECT `type` FROM `categories` INNER JOIN `category_post_relationship` ON `categories`.`id`=`category_post_relationship`.`cat_id` WHERE `post_id`='".$post_id."'");
			//echo $this->db->last_query();
			foreach($query->result_array() as $k=>$v){
					return $v['type'];
				}
	 }
	 
	 function get_single_post_image($post_id){
		 $q_m=$this->db->get_where('images', array('post_id' => $post_id),1,0);
		 foreach($q_m->result_array() as $k=>$v){
					
					return $v['img'];
				}
	 }
	 function check_meta($metakey,$metavalue){
		 $ar=array();
		 $q_m=$this->db->get_where('post_meta', array('meta_key'=>$metakey,'meta_value'=>$metavalue));
		 foreach($q_m->result_array() as $k=>$v){
					array_push($ar,$v['post_id']);
					
				}
		return $ar;
	 }
	 function hoseajx(){
		 return 'Kaushik';
	 }
	 
	 function cheking_post($post_id ,$email){
		 $query = $this->db->query("SELECT * FROM `post` WHERE `id`='".$post_id."' AND `c_email`='".$email."'");
		// echo $this->db->last_query();
		 if($query->num_rows()==0){
			 return true;
		 }else{
			 return false;
		 }
	 }
	 
	 function delimage($delid){
		 $query = $this->db->query("DELETE FROM `images` WHERE `id`='".$delid."'");
	 }
	function delimage_bd($delid){
		 $query = $this->db->query("DELETE FROM `images` WHERE `id`='".$delid."'");
	 }
	 function update_housing( $data,$update_id){
		   $this->db->where('id',$update_id);
           $this->db->update('post',$data); 
		   //return $this->db->insert_id();
	   }
	 function update_housing_meta($metadata,$update_id){
			$this->db->where('post_id',$update_id);
           $this->db->update('housing_post_meta',$metadata); 
		//echo $this->db->last_query();
	  }
	   function update_job_meta($metadata,$update_id){
			$this->db->where('post_id',$update_id);
           $this->db->update('job_post_meta',$metadata); 
		//echo $this->db->last_query();
	  }
	   function update_event_meta($metadata,$update_id){
			$this->db->where('post_id',$update_id);
           $this->db->update('event_post_meta',$metadata); 
		//echo $this->db->last_query();
	  }
	  
	  function get_catid_by_postid($post_id){
		  	 $q_m=$this->db->get_where('category_post_relationship', array('post_id' => $post_id));
		 foreach($q_m->result_array() as $k=>$v){
					
					return $v['cat_id'];
				}
	  }
	  function select_all_image_name($post_id){
		  $q_m=$this->db->get_where('images', array('post_id' => $post_id));
		  $ar=array();
		 foreach($q_m->result_array() as $k=>$v){
					array_push($ar,$v['img']);
				}
	     return $ar;	
	  }
	   function delete_all_by_postid($post_id){
		   	$query = $this->db->query("DELETE FROM `post` WHERE `id`='".$post_id."'");
			$query = $this->db->query("DELETE FROM `housing_post_meta` WHERE `post_id`='".$post_id."'");
			$query = $this->db->query("DELETE FROM `job_post_meta` WHERE `post_id`='".$post_id."'");
			$query = $this->db->query("DELETE FROM `event_post_meta` WHERE `post_id`='".$post_id."'");
			$query = $this->db->query("DELETE FROM `category_post_relationship` WHERE `post_id`='".$post_id."'");
			$query = $this->db->query("DELETE FROM `images` WHERE `post_id`='".$post_id."'");
			
	   }
	   function current_date(){
		   		$query = $this->db->query("SELECT `post_id` FROM `event_post_meta` WHERE full_date < CURDATE()");
				return $query->result_array();
	   }
	   function get_single_catname($id){
		 $q_m=$this->db->get_where('categories', array('id' => $id),1,0);
		foreach($q_m->result_array() as $v){
		return $v['category_name'];
			}
	   }
	   function get_children($id){
		 $this->db->select('*');
		 $this->db->where('parent', $id );
		 $query = $this->db->get('categories');
		 $data = $query->result_array();
		// echo $this->db->last_query();
		 return $data;
		   }
		function get_subcat($type,$subcat){
		 $this->db->select('*');
		 $this->db->where('type', $type );
		 if($subcat==false){
		    $this->db->where('parent !=', 0 );	
		 }else{
			$this->db->where('parent =', 0 );  
		 }
		 $query = $this->db->get('categories');	
		 $data = $query->result_array();
		 // echo $this->db->last_query();	
		 return $data;
		}
	 
	
}