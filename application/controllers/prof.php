<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prof extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('turma_model','turma');
		$this->load->model('usuario_model','usuario');
		$this->load->model('disciplina_model','disciplina');
		$this->load->model('periodo_model','periodo');
		$this->load->model('inscrito_model','inscrito');
		$this->load->model('podcast_model','podcast');
		date_default_timezone_set('America/Sao_Paulo');

	}

	public function index(){
		redirect('dashboard','refresh');

	}
#
#
#	Configuração de Turma
#
#
	public function adiciona_turma(){
		confereLogin('prof','dashboard');

		$this->form_validation->set_rules('disciplina', 'Disciplina', 'trim|required');
		$this->form_validation->set_rules('turno', 'Turno', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados_form = $this->input->post();

			$campos_usuario = array("id","nome","sobrenome");
			$usuario = $this->usuario->get_usuario($this->session->userdata('id'),$campos_usuario);

			$campos_disciplina = array("id","nome");
			$disciplina = $this->disciplina->get_single($dados_form['disciplina'],$campos_disciplina);

			$periodo = $this->periodo->get_last_periodo();

			if($nome = $this->turma->cria_nome($usuario,$disciplina,$periodo,$dados_form['turno'])){
				if ($id = $this->turma->set_turma($usuario,$disciplina,$periodo,$dados_form['turno'],$nome)) {
					set_msg("Turma adicionada!");
					redirect('prof/ver_turma/'.$id,'refresh');
				}
				else{
					set_msg('Erro na inserção!');
				}
			} else {
				set_msg('Esta turma já existe!');
			}
		}

		$dados_pag['disciplinas'] = $this->disciplina->get_disciplinas();

		$dados_pag['titulo'] = 'Adicionar Turma';
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/prof/turma/adiciona_turma',$dados_pag);
		$this->load->view('frame/footer_portal');

	}

	public function lista_turma(){
		confereLogin('prof','dashboard');

		$dados_pag['turmas'] = $this->turma->get_turmas_usuario($this->session->userdata("id"));

		$dados_pag['titulo'] = 'Minhas Turmas';
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/prof/turma/lista_turma',$dados_pag);
		$this->load->view('frame/footer_portal');
	}

	public function ver_turma($id=0){
		confereLogin('prof','dashboard');
		if ($id>0) {
			if(!$this->turma->confereProfessor($id,$this->session->userdata('id'))){
				set_msg("Sem permissão para ver outras turmas.");
				redirect('prof/lista_turma','refresh');
			}
			if ($turma = $this->turma->get_turma($id)) {
				$inscritos = $this->inscrito->get_inscritos_turma($id);
				$candidatos = $this->turma->get_candidatos($id);
				$podcasts = $this->podcast->get_podcast_turma($id);

				$dados_pag['prof'] = $this->usuario->get_usuario($turma->fk_prof);
				$dados_pag['turma'] = $turma;
				$dados_pag['alunos'] = $inscritos;
				$dados_pag['candidatos'] = $candidatos;
				$dados_pag['podcasts'] = $podcasts;
			} else {
				set_msg('Turma selecionada não existe!');
				redirect('prof/lista_turma','refresh');
			}
		} else {
			set_msg('Nenhuma turma selecionada!');
			redirect('prof/lista_turma','refresh');
		}

		$dados_pag['titulo'] = 'Ver Turma';
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/prof/turma/ver_turma',$dados_pag);
		$this->load->view('frame/footer_portal');

	}

	public function deleta_turma(){
		confereLogin('prof','dashboard');
		$dados_form = $this->input->post();
		if(!$this->turma->confereProfessor($dados_form['id'],$this->session->userdata('id'))){
			set_msg("Sem permissão para ver outras turmas.");
			redirect('prof/lista_turma','refresh');
		}

		$this->form_validation->set_rules('deletar', 'Deletar', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			// print_r($dados_form);
			$dados = array(
				'turma' => $dados_form['id'],
			);
			if($this->turma->deleta_turma($dados)){
				set_msg('Turma deletada com sucesso!');
			} else {
				set_msg('Erro ao deletar turma!');
			}
		}
		redirect('prof/lista_turma/','refresh');
	}
	public function adiciona_inscrito(){
		confereLogin('prof','dashboard');
		$dados_form = $this->input->post();
		if(!$this->turma->confereProfessor($dados_form['turma_id'],$this->session->userdata('id'))){
			set_msg("Sem permissão para ver outras turmas.");
			redirect('prof/lista_turma','refresh');
		}
		$this->form_validation->set_rules('candidato', 'Candidato', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados = array(
				'turma' => $dados_form['turma_id'],
				'grade' => $dados_form['candidato']
			);
			if ($this->inscrito->set_inscrito($dados)) {
				set_msg("Inscrito adicionado!");
				redirect('prof/ver_turma/'.$dados_form['turma_id'],'refresh');
			} else {
				set_msg('Erro ao criar grade!');
			}
		}
		redirect('prof/ver_turma/'.$dados_form['turma_id'],'refresh');
		
	}
	public function deleta_inscrito(){
		confereLogin('prof','dashboard');
		$dados_form = $this->input->post();
		if(!$this->turma->confereProfessor($dados_form['turma_id'],$this->session->userdata('id'))){
			set_msg("Sem permissão para ver outras turmas.");
			redirect('prof/lista_turma','refresh');
		}

		$this->form_validation->set_rules('deletar', 'Deletar', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			// print_r($dados_form);
			$dados = array(
				'turma' => $dados_form['turma_id'],
				'grade' => $dados_form['grade_id']
			);
			if($this->inscrito->deleta_inscrito($dados)){
				set_msg('Inscrito deletado com sucesso!');
			} else {
				set_msg('Erro ao deletar inscrito!');
			}
		}
		redirect('prof/ver_turma/'.$dados_form['turma_id'],'refresh');
	}
	public function adiciona_podcast(){
		confereLogin('prof','dashboard');
		$dados_form = $this->input->post();
		if(!$this->turma->confereProfessor($dados_form['turma_id'],$this->session->userdata('id'))){
			set_msg("Sem permissão para ver outras turmas.");
			redirect('prof/lista_turma','refresh');
		}
	
		$this->load->library('upload', config_upload());
		if (!$this->upload->do_upload('podcast')) {
			set_msg($this->upload->display_errors());
		} else {
			$dados_upload = $this->upload->data();
			if ($this->podcast->set_podcast($dados_upload['file_name'],$dados_form['turma_id'])){
				set_msg('podcast adicionado com sucesso!');
			}
		}
		redirect('prof/ver_turma/'.$dados_form['turma_id'],'refresh');
	}
}
