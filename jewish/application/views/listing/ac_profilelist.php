<script>console.log('view/listing/ac_profilelist.php')</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/business.css">

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.js"></script>

 <script type="text/javascript">

 jQuery(document).ready(function($) {

   $('#table_id').dataTable(); 

});

	</script> 

 <style>

 .dataTables_wrapper {

  position: relative;

  clear: both;

  zoom: 1;

  font-family: 'SegoeUIRegular';

}

 </style>

<div class="container">

 <article class="page-content">

   <ul class="page-nav">

    <li><a href="<?php echo JEWISH_URL;?>/myaccount/">My Account</a></li>

    <li> > <a href="<?php echo JEWISH_URL;?>/myaccount/classified_profilelist/">Classified Profile listing</a></li>

  </ul>

  <p></p>

<h2>List of Your Classified Profile(s)</h2>

<table  id="table_id" class="display" cellspacing="0" width="100%">

 <thead>

  <tr>

    <th><strong>#</strong></th>

    <th><strong>Classified Name</strong></th>

    <th><strong>City</strong></th>

    <th><strong>Zip</strong></th>

    <th><strong>Phone no</strong></th>

     <th><strong>Edit Profile</strong></th>

  </tr>

</thead>

<tbody>

<?php

 //$city=$this->session->all_userdata( 'city_id');print_r($city);

$user_log=$this->session->userdata('logged_in');  

$get_profile=$this->businessmod->get_classified_list_by_useremail($user_log['email']);

$count=1;

foreach($get_profile as $v){

      echo '<tr>';

      echo '<td>'.$count.'</td>';

      echo '<td>'.$v['post_title'].'</td>';

	  echo '<td>'.$this->citymod->fetch_single_city($v['geo_area']).'</td>';

	  echo '<td>'.$v['zipcode'].'</td>';

	  echo '<td>'.$v['contact_phone'].'</td>';

	  echo '<td><a href="'.JEWISH_URL.'/post/post_edit/'.$this->allencode->encode($v['id']).'/'.$this->allencode->encode($user_log['email']).'" target="_blank">Edit Profile</a></td>';

      echo '</tr>';

$count++;	  

}

?> 

</tbody>

</table>

</article>

</div>