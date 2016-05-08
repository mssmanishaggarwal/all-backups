<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
	
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
	
	function about(){
		$this->load->view('header');
		$this->load->view('miscellaneous/about');
		$this->load->view('footer');		
	}
	
	function privacy(){
		$this->load->view('header');
		$this->load->view('miscellaneous/privacy');
		$this->load->view('footer');			
		}
		
	function terms(){
		$this->load->view('header');
		$this->load->view('miscellaneous/terms');
		$this->load->view('footer');			
		}
	
	
}