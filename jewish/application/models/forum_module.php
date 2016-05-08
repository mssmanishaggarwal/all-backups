<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class forum_module extends CI_Model{

	  function __construct() {

        parent::__construct();

		$this->load->library('email');

		$this->load->library("session");

		$this->load->database();

		$this->load->library("session");

       }

  function catdata()

 {

    $formdata=$this->db->get('forum_cat');

  return $formdata->result();	 

	 

 }

function forumwish_cat($id)

{

 		 $formdata=$this->db->get_where('forum_cat',array('f_cat_id'=>$id))->result();

   return $formdata[0]->f_cat_slug;

}

  

 function myimage($id)

 {

  $forumdata=$this->db->get_where('login',array('id'=>$id))->result();	

//  return $forumdata[0]->user_image;

 }

  function author($id)

 {

  $forumdata=$this->db->get_where('login',array('id'=>$id))->result();	
if(isset($forumdata[0]->username)){
  return $forumdata[0]->username;
}else{return "unknown";}
 }



   function forumid($slug)	

 {

  $forumdata=$this->db->get_where('forum',array('forum_slug'=>$slug))->result();	

  return $forumdata[0]->forum_id;

 }



 function forumcat($id)

 {

  $forumdata=$this->db->get_where('forum_cat',array('f_cat_id'=>$id))->result();	

 return $forumdata[0]->f_cat_name;

 }

 

 function forumdata($data)

 {

$formdata=$this->db->get_where('forum',array('forum_slug'=>$data))->result();	

	 $catname = $this->forumcat($formdata[0]->forum_cat); 

 	 $forum_author_image = $this->myimage($formdata[0]->forum_author); 

 	 $forum_author = $this->author($formdata[0]->forum_author); 

	// echo $forum_author_image;

	$newvalue= array('forum_id'=>$formdata[0]->forum_id,'forum_name'=>$formdata[0]->forum_name,'forum_slug'=>$formdata[0]->forum_slug,'forum_content'=>$formdata[0]->forum_content,'forum_add_date'=>$formdata[0]->forum_add_date,'forum_modified_date'=>$formdata[0]->forum_modified_date,'forum_author_image'=>$forum_author_image,'forum_author'=>$forum_author,'forum_cat'=>$formdata[0]->forum_cat,'forum_author_id'=>$formdata[0]->forum_author);

 	  

 	return $newvalue; 

	 

	 

 }



  

function sanitizeStringForUrl($string){

    $string = strtolower($string);

    $string = html_entity_decode($string);

    $string = str_replace(array('ä','ü','ö','ß'),array('ae','ue','oe','ss'),$string);

    $string = preg_replace('#[^\w\säüöß]#',null,$string);

    $string = preg_replace('#[\s]{2,}#',' ',$string);

    $string = str_replace(array(' '),array('-'),$string);

    return $string;

}

 

 

 

 function insert_data()

  {

 		$data = array(

		'forum_id'=>$this->input->post('forum_id'),

 		'fcomment_name'=>$this->input->post('fcomment_name'),

		'fcomment_email'=>$this->input->post('fcomment_email'),

		'fcomment_desc'=>$this->input->post('fcomment_desc'),

		);

		//print_r($data);

		$this->db->insert('forum_comment',$data);							

	  

  }

  

  function update_thread()

 {

	$forum_slug = $this->sanitizeStringForUrl($this->input->post('forum_name'));

 	  $data=array(

	   'forum_name'=>$this->input->post('forum_name'),

	   'forum_slug'=>$forum_slug,

	   'forum_cat'=>$this->input->post('forum_cat'),

	   'forum_modified_date'=>$this->input->post('forum_modified_date'),

 	   'forum_content'=>$this->input->post('forum_content')

	  );

 	  if($this->input->post('threadupdate'))		

	  {		

 		$this->db->where('forum_id',$this->input->post('forum_id'));

		$this->db->update('forum',$data);	

 		return $forum_slug;							

	  }

  }

  function updateuser()

  {

  	  $userinfor=array(

	   'username'=>$this->input->post('username'),

	   'address'=>$this->input->post('address'),

	   'country'=>$this->input->post('country'),

	   'state'=>$this->input->post('state'),

 	   'about'=>$this->input->post('about')

	  );

	   $userinformation = serialize($userinfor);

	  $data=array('userinformation'=>$userinformation,'username'=>$this->input->post('username'),

	  );

	  

  		$this->db->where('email',$this->input->post('email'));

		$this->db->update('login',$data);	

 		return 1;							

 	  

  }

  

  function insert_nonuser_thread()
   {
	   
	   
 	   
	   if($this->input->post('forum_author_name'))		
	   {
	$data=array('username'=>$this->input->post('forum_author_name'),'email'=>$this->input->post('forum_author_email'));

		$this->db->insert('login',$data);	
 $id = $this->db->insert_id();		   
	   }
	   
 	$forum_slug = $this->sanitizeStringForUrl($this->input->post('forum_name2'));
  	  $data=array(
 	   'forum_name'=>$this->input->post('forum_name2'),
 	   'forum_slug'=>$forum_slug,
 	   'forum_cat'=>$this->input->post('forum_cat'),
 	   'forum_modified_date'=>$this->input->post('forum_modified_date'),
 	   'forum_add_date'=>$this->input->post('forum_modified_date'),
 	   'forum_author'=>$id,
 	   'forum_content'=>$this->input->post('forum_content')
 	  );
	  
	  
	   if($this->input->post('forum_name2'))		
	   {		
			$this->db->insert('forum',$data);	
			return 1;						
	   }
  }

  

  

  

  

   

  function insert_thread()

  {
 	$forum_slug = $this->sanitizeStringForUrl($this->input->post('forum_name'));
  	  $data=array(
 	   'forum_name'=>$this->input->post('forum_name'),
 	   'forum_slug'=>$forum_slug,
 	   'forum_cat'=>$this->input->post('forum_cat'),
 	   'forum_modified_date'=>$this->input->post('forum_modified_date'),
 	   'forum_add_date'=>$this->input->post('forum_modified_date'),
 	   'forum_author'=>$this->input->post('forum_author'),
 	   'forum_content'=>$this->input->post('forum_content')
 	  );
	   if($this->input->post('forum_name'))		
	   {		
			$this->db->insert('forum',$data);	
			return 1;						
	   }
  }

  

   

  

  function replysubmit()

   {

	if($this->input->post('replysubmit'))		

	{	

 		

	  $kj = $this->replydata($this->input->post('fcomment_id'));

 	   // print_r($kj);

 	   if($kj!=0)

	   {

		$jj = sizeof($kj);

  		$rpy[$jj]=array('reply_name'=>$this->input->post('reply_name'),

		'reply_email'=>$this->input->post('reply_email'),

		'reply_desc'=>$this->input->post('reply_desc')

		);

		$reply=array_merge($kj,$rpy);   

	   }else{

 		$reply[0]=array('reply_name'=>$this->input->post('reply_name'),

		'reply_email'=>$this->input->post('reply_email'),

		'reply_desc'=>$this->input->post('reply_desc')

		);

	   }

//	   echo '<pre>';

//	   print_r($reply);

//	   die();

		

		$where = array('fcomment_id'=>$this->input->post('fcomment_id'));  

		// print_r($where);

		$reply = serialize($reply);

		$data=array(  

		 'fcomment_reply'=>$reply

		);

		$this->updateRowWhere('forum_comment',$where,$data);	

	}

	  

	  

	  

  }

  

function updateRowWhere($table, $where = array(), $data = array()) {

    $this->db->where($where);

    $this->db->update($table, $data);

}  

  

  function replydata($data)

{

 $formdata=$this->db->get_where('forum_comment',array('fcomment_id'=>$data))->result();	

if($formdata){

 $newvalue= unserialize($formdata[0]->fcomment_reply);

 return $newvalue;

}

else{return 0;}	

}

  

  

  

  

 function forumcomment($data)

 {

	 $newvalue=array();

	// echo $data;

  	 $forum_id = $this->forumid($data); 



$formdata=$this->db->get_where('forum_comment',array('forum_id'=>$forum_id))->result();	

   for($i=0;$i<sizeof($formdata);$i++)

  {





// print_r($formdata); 

  	 // $forum_author_image = $this->myimage($formdata[0]->fcomment_name); 

 	// echo $forum_author_image;

	$newvalue[$i]= array('fcomment_id'=>$formdata[$i]->fcomment_id,'fcomment_name'=>$formdata[$i]->fcomment_name,'fcomment_email'=>$formdata[$i]->fcomment_email,'fcomment_desc'=>$formdata[$i]->fcomment_desc,'forum_author_image'=>'','fcomment_reply'=>$formdata[$i]->fcomment_reply);

  }

  	return $newvalue; 

  }

  

 function forumcomment_count($data)

 {

	 $newvalue=array();

	// echo $data;

 

$formdata=$this->db->get_where('forum_comment',array('forum_id'=>$data))->result();	

   	return sizeof($formdata); 

  }

  

  

  

  

  

   function forumall()

 {
	 
$this->db->select('*');
     $this->db->order_by("forum_modified_date","desc");
    $this->db->from('forum');
    $query=$this->db->get();
  $forumdata=  $query->result();
 	 

//$forumdata=$this->db->get('forum')->result();
       for($i=0;$i<sizeof($forumdata);$i++)

  {
 	 $catname = $this->forumcat($forumdata[$i]->forum_cat); 
  	 $forum_author_image = $this->myimage($forumdata[$i]->forum_author);
 	 $fcomment_count = $this->forumcomment_count($forumdata[$i]->forum_id) ;
  	$newvalue[$i]= array('forum_id'=>$forumdata[$i]->forum_id,'forum_name'=>$forumdata[$i]->forum_name,'forum_slug'=>$forumdata[$i]->forum_slug,'forum_content'=>$forumdata[$i]->forum_content,'forum_add_date'=>$forumdata[$i]->forum_add_date,'forum_modified_date'=>$forumdata[$i]->forum_modified_date,'forum_author_image'=>$forum_author_image,'forumcomment_count'=>$fcomment_count,'catname'=>$catname);
 //	sort($newvalue[$catname]);
    
 
  }

   //print_r(sort($newvalue[0]));
 //  echo "<pre>";
 //    print_r($newvalue);
 //  echo "</pre>";
   return $newvalue;	          

 }
//
// function forum_getdata($forum_id)
//{
//   $forumdata=$this->db->get_where('forum',array('forum_id'=>$forum_id))->result();
//   print_r($forumdata);
//  	 $fcomment_count = $this->forumcomment_count($forumdata[$i]->forum_id);
// 	 $catname = $this->forumcat($forumdata[$i]->forum_cat); 
//  	 $forum_author_image = $this->myimage($forumdata[$i]->forum_author); 
//  	$newvalue[$catname][$i]= array('forum_id'=>$forumdata[$i]->forum_id,'forum_name'=>$forumdata[$i]->forum_name,'forum_slug'=>$forumdata[$i]->forum_slug,'forum_content'=>$forumdata[$i]->forum_content,'forum_add_date'=>$forumdata[$i]->forum_add_date,'forum_modified_date'=>$forumdata[$i]->forum_modified_date,'forum_author_image'=>$forum_author_image,'forumcomment_count'=>$fcomment_count);
//	
//	return $newvalue;
//}
// 	

   

  function commentforumdata()
{
 $user_log=$this->session->userdata('logged_in');	
 $fcomment_name = $user_log['username'];
  if(isset($user_log['username'])){
   $forumdata=$this->db->get_where('forum_comment',array('fcomment_name'=>$fcomment_name))->result();
//echo '<pre>';
	//print_r($forumdata);
for($i=0;$i<sizeof($forumdata);$i++)
   {
 	 $forum_id[] = $forumdata[$i]->forum_id;

   }
 	$forumdata2 = array_unique($forum_id);   
  sort($forumdata2);
 // print_r($forumdata2);
	for($i=0;$i<sizeof($forumdata2);$i++)
   {
 	   $forumdata=$this->db->get_where('forum',array('forum_id'=>$forumdata2[$i]))->result();
 	 $fcomment_count = $this->forumcomment_count($forumdata[0]->forum_id);
 	
  	   	$newvalue[$i]= array('forum_id'=>$forumdata[0]->forum_id,'forum_name'=>$forumdata[0]->forum_name,'forum_slug'=>$forumdata[0]->forum_slug,'forum_content'=>$forumdata[0]->forum_content,'forum_add_date'=>$forumdata[0]->forum_add_date,'forum_modified_date'=>$forumdata[0]->forum_modified_date,'forum_author_image'=>$forum_author_image,'forumcomment_count'=>$fcomment_count);
	 
	 
	 
 	 
	 
	 
	 
 //  echo 'ggg'.$newforumdata[] =forum_getdata($forumdata2[$i]);

   }
    	return $newvalue;

     }
}
  function yourthreads()

 {

 $userid=$this->session->userdata('logged_in');	 

  if(isset($userid['user_id'])){

// print_r($userid['user_id']);

   $forumdata=$this->db->get_where('forum',array('forum_author'=>$userid['user_id']))->result();
    for($i=0;$i<sizeof($forumdata);$i++)
   {
 	 $fcomment_count = $this->forumcomment_count($forumdata[$i]->forum_id);

	 $catname = $this->forumcat($forumdata[$i]->forum_cat); 

 	 $forum_author_image = $this->myimage($forumdata[$i]->forum_author); 

 	$newvalue[$catname][$i]= array('forum_id'=>$forumdata[$i]->forum_id,'forum_name'=>$forumdata[$i]->forum_name,'forum_slug'=>$forumdata[$i]->forum_slug,'forum_content'=>$forumdata[$i]->forum_content,'forum_add_date'=>$forumdata[$i]->forum_add_date,'forum_modified_date'=>$forumdata[$i]->forum_modified_date,'forum_author_image'=>$forum_author_image,'forumcomment_count'=>$fcomment_count);

	sort($newvalue[$catname]);

	  

  }

   //print_r(sort($newvalue[0]));

   error_reporting(0);

   return $newvalue;	

  }

  else{

	return 0;  

  }

 }

 

 	

}