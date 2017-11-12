<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('usuario_historico_model', 'usuario_historico');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index(){
		if ($this->usuario->get_exist_op('privilegio','adm'))
			redirect('login','refresh');
		else
			redirect('instalar','refresh');

	}
	public function logout(){
		confereLogin();

		$this->session->unset_userdata('logged');
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('surname');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('privilegio');
		set_msg('Saiu do sistema!');
		redirect('Main','refresh');
	}
	public function login(){
		if ($this->usuario->get_exist_op('privilegio','adm')) {
			$this->form_validation->set_rules('login','Login', 'trim|alpha_numeric|required|min_length[5]');
			$this->form_validation->set_rules('psw','Senha', 'trim|required|min_length[6]');

			if ($this->form_validation->run() == FALSE) {
				if (validation_errors()) {
					set_msg(validation_errors());
				}
			}
			else{
				$dados_form = $this->input->post();
				if ($this->usuario->get_exist_op('login',$dados_form['login'])) {
					$usuario = $this->usuario->get_exist_senha($dados_form);
					if ($usuario){
						$session = array(
							'logged' => TRUE,
							'user' => $usuario->nome,
							'surname' => $usuario->sobrenome,
							'id' => $usuario->id,
							'privilegio' => $usuario->privilegio
						);
						
						$this->session->set_userdata( $session );
						if (!$this->usuario_historico->set($usuario->id)) {
							set_msg('Erro ao gerar histórico');
						}

						redirect('dashboard','refresh');
					}
					else
						set_msg('Senha incorreta!');
				}
				else
					set_msg('Usuário incorreto!');
			}
			redirect('main','refresh');
		}
		else
			redirect('instalar','refresh');
	}
	public function instalar(){
		if ($this->usuario->get_exist_op('privilegio','adm'))
			redirect('login','refresh');
		else{
			$this->form_validation->set_rules('nome','Nome', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('nasc','Data de Nasciemnto', 'trim');
			$this->form_validation->set_rules('tel','Telefone', 'trim|min_length[9]|max_length[12]|numeric');
			$this->form_validation->set_rules('email','E-mail', 'trim|valid_email');
			$this->form_validation->set_rules('login-cad','Login', 'trim|alpha_numeric|required|min_length[5]|is_unique[usuario.login]');
			$this->form_validation->set_rules('psw-cad','Senha', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('psw2','Senha2', 'trim|required|min_length[6]|matches[psw-cad]');

			if ($this->form_validation->run() == FALSE) {
				if (validation_errors()) {
					set_msg(validation_errors());
				}
			}
			else {
				$dados_form = $this->input->post();
				$resultado = $this->usuario->set_usuario($dados_form,'adm');

				if ($resultado) {
					set_msg('Sistema inicializado...');
					redirect('dashboard','refresh');
				}
			}
			$dados['atual'] = '';
			$this->load->view('frame/header',$dados);
			$this->load->view('setup/instalar');
			$this->load->view('frame/footer');
		}
	}

}