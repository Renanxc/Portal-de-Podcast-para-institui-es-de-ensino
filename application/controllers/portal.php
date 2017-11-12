<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('usuario_model','usuario');
	}

	public function index(){
		redirect('dashboard','refresh');
	}
	public function dashboard(){
		confereLogin();
		// $campos = array('privilegio');
		// $usuario = $this->usuario->get_usuario($this->session->userdata('id'),$campos);
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/dashboard');
		$this->load->view('frame/footer');
	}
}
