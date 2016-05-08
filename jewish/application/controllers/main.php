<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
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
		function index()
		{
		$this->load->view('header');
		$this->load->view('main');
		$this->load->view('footer');
		}
		function city_change(){
				$this->session->set_userdata( 'city_id',array($this->input->post('city_id')));
				redirect($_GET['redirect']);
		}
		/*function city(){
		$this->load->view('header');
		$this->load->view('miscellaneous/city');
		$this->load->view('footer');	
		}*/

	
}



