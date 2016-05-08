<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Logmein extends CI_Controller{

	function __construct(){

		parent::__construct();

		$this->load->database();

		$this->load->library("session");

		$this->load->helper('url');

		$this->load->helper('form');

		$this->load->library('allencode');

		$this->load->model('ps/pagess');	
		$this->load->model('log/logmod','logmodel'); 

	}

	

	function index(){

		
        $this->load->view('header');

		$this->load->view('log/logmein');

		$this->load->view('footer');
	}
	function logout(){
		$this->session->unset_userdata('logged_in');
        redirect('/');
	}



	

} 