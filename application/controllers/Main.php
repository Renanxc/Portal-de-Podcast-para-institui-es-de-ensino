<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index(){
		$this->load->view('frame/header');
		$this->load->view('main');
		$this->load->view('frame/footer');
	}
	public function pagInterna(){
		$this->load->view('frame/header');
		$this->load->view('pagInterna');
		$this->load->view('frame/footer');
	}
}
