<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Exmod extends CI_Model {

	function __construct() {

		parent::__construct();

		$this->load->library('email');

		$this->load->library("session");

		$this->load->database();

		$this->load->library("session");

	}

}