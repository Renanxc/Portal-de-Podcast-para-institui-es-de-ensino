<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}

	public function index(){
		$dados['atual'] = 'main';
		$this->load->view('frame/header',$dados);
		$this->load->view('main');
		$this->load->view('frame/footer');
	}
	public function pagInterna(){
		$dados['atual'] = 'main';
		$this->load->view('frame/header',$dados);
		$this->load->view('pagInterna');
		$this->load->view('frame/footer');
	}
	public function contato(){
		$this->load->library(array('form_validation','email'));
		$this->form_validation->set_rules('nome', 'Nome','trim|required');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email');
		$this->form_validation->set_rules('assunto', 'Assunto','trim|required');
		$this->form_validation->set_rules('mensagem', 'Mensagem','trim|required');
		if ($this->form_validation->run() == FALSE) 
			$dados['formerror'] = validation_errors();
		else{
			$dados_form = $this->input->post();
			$this->email->from($dados_form['email'],$dados_form['nome']);
			$this->email->to('renanxcalmon@gmail.com');
			$this->email->subject($dados_form['assunto']);
			$this->email->message($dados_form['mensagem']);
			if ($this->email->send())
				$dados['formsuccess'] = 'Enviado!';
			else
				$dados['formerror'] = 'Erro durante envio, tente novamente mais tarde!';
		}

		$dados['atual'] = 'contato';
		$this->load->view('frame/header',$dados);
		$this->load->view('contato');
		$this->load->view('frame/footer');
	}
}
