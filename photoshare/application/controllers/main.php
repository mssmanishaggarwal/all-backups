<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Main extends CI_Controller{
	function __construnct(){
		parent::_construct();
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library("session");
		$this->load->library('allencode');
		$this->load->library("session");
		//$this->load->model('ps/pagess'); 
		
	}
	public function index(){
		$this->load->view('header');
		$this->load->view('main');
		$this->load->view('footer');
	}
}