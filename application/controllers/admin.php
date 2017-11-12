<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('usuario_model','usuario');
		$this->load->model('periodo_model','periodo');
		$this->load->model('curso_model','curso');
		$this->load->model('disciplina_model','disciplina');
		$this->load->model('disciplina_curso_model','disciplina_curso');
		$this->load->model('grade_model','grade');
		$this->load->model('inscrito_model','inscrito');
		$this->load->model('usuario_historico_model','historico');
		date_default_timezone_set('America/Sao_Paulo');

	}

	public function index(){
		redirect('dashboard','refresh');

	}
#
#
#	Configuração de Período
#
#
	public function iniciar_periodo(){
		confereLogin('adm','dashboard');
		$last = $this->periodo->get_last_periodo();
		if (mdate('%m')<6) 
			$semestre = 1;
		else
			$semestre = 2;

		if ($this->periodo->confere_periodo($last,$semestre)) {
			$resultado = $this->periodo->set_periodo($semestre);
			if ($resultado) {
				set_msg('Período inicializado!');
				redirect('dashboard','refresh');
			}
		}
		else{
			set_msg('Período Já iniciado!');
			redirect('dashboard','refresh');
		}

	}
#
#
#	Configuração de Curso
#
#
	public function curso(){
		confereLogin('adm','dashboard');
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/curso');
		$this->load->view('frame/footer');

	}

	public function adiciona_curso(){
		confereLogin('adm','dashboard');

		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[2]|max_length[45]|is_unique[curso.nome]');
		$this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|min_length[25]|max_length[2500]');

		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados_form = $this->input->post();
			$dados_ins = array(
				'nome' => $dados_form['nome'],
				'descricao' => to_bd($dados_form['descricao'])
			);
			if ($id = $this->curso->set_curso($dados_ins)) {
				set_msg("Curso adicionado!");
				redirect('admin/edita_curso/'.$id,'refresh');
			}
			else{
				set_msg('Erro na inserção!');
			}
		}

		$dados_pag['titulo'] = 'Adicionar Curso';
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/curso/adiciona_curso',$dados_pag);
		$this->load->view('frame/footer_portal');

	}

	public function lista_curso(){
		confereLogin('adm','dashboard');

		$dados['atual'] = 'dashboard';
		$dados_pag['cursos'] = $this->curso->get_cursos();
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/curso/lista_curso',$dados_pag);
		$this->load->view('frame/footer_portal');

	}
	public function deleta_curso(){
		confereLogin('adm','dashboard');

		//Verifica se o id do curso foi passado
		$id = $this->uri->segment(3);
		if ($id>0) {
			if ($curso = $this->curso->get_single($id)) {
				$dados_pag['curso'] = $curso;
			} else {
				set_msg('Curso selecionado não existe!');
				redirect('admin/lista_curso','refresh');
			}
		} else {
			set_msg('Nenhum curso selecionado!');
			redirect('admin/lista_curso','refresh');
		}

		$this->form_validation->set_rules('deletar', 'Deletar', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			if($this->curso->deleta_curso($id)){
				set_msg('Curso excluído com sucesso!');
				redirect('admin/lista_curso','refresh');
			} else {
				set_msg('Erro ao excluir curso!');
			}
		}

		$dados_pag['titulo'] = 'Deletar Curso';
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/curso/deleta_curso',$dados_pag);
		$this->load->view('frame/footer_portal');

	}

	public function edita_curso(){
		confereLogin('adm','dashboard');

		//Verifica se o id do curso foi passado
		$id = $this->uri->segment(3);
		if ($id>0) {
			if ($curso = $this->curso->get_single($id)) {
				$dados_pag['curso'] = $curso;
				$dados_updt['id'] = $curso->id;
			} else {
				set_msg('Curso selecionado não existe!');
				redirect('admin/lista_curso','refresh');
			}
		} else {
			set_msg('Nenhum curso selecionado!');
			redirect('admin/lista_curso','refresh');
		}

		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[2]|max_length[45]');
		$this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|min_length[25]|max_length[2500]');

		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados_form = $this->input->post();
			$dados_updt += array(
				'nome' => $dados_form['nome'],
				'descricao' => to_bd($dados_form['descricao'])
			);
			// var_dump($dados_updt);
			if ($this->curso->set_curso($dados_updt)) {
				set_msg('Curso modificado com sucesso!');
			} else {
				set_msg('Erro! Nenhuma modificação feita neste curso!');
			}
		}
		$dados_pag['titulo'] = 'Editar Curso';
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/curso/edita_curso',$dados_pag);
		$this->load->view('frame/footer_portal');

	}
#
#
#	Configuração de Disciplina
#
#
	public function disciplina(){
		confereLogin('adm','dashboard');
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/disciplina');
		$this->load->view('frame/footer');

	}

	public function adiciona_disciplina(){
		confereLogin('adm','dashboard');

		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[2]|max_length[45]|is_unique[disciplina.nome]');
		$this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|min_length[25]|max_length[2500]');/*|htmlentities*/
		$this->form_validation->set_rules('cursos[]', 'Cursos', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados_form = $this->input->post();
			$dados_ins = array(
				'nome' => $dados_form['nome'],
				'descricao' => to_bd($dados_form['descricao'])
			);
			if ($id = $this->disciplina->set_disciplina($dados_ins)) {
				if ($this->disciplina_curso->set($id,$dados_form['cursos'])) {
					set_msg("Disciplina adicionada!");
					redirect('admin/edita_disciplina/'.$id,'refresh');
				} else {
					set_msg('Erro ao registrar disciplina em curso');
				}
			} else{
				set_msg('Erro na inserção!');
			}
		}

		$dados_pag['cursos'] = $this->curso->get_cursos();

		$dados_pag['titulo'] = 'Adicionar Disciplina';
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/disciplina/adiciona_disciplina',$dados_pag);
		$this->load->view('frame/footer_portal');

	}

	public function lista_disciplina(){
		confereLogin('adm','dashboard');

		$dados['atual'] = 'dashboard';
		$dados_pag['disciplinas'] = $this->disciplina->get_disciplinas();
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/disciplina/lista_disciplina',$dados_pag);
		$this->load->view('frame/footer_portal');

	}
	public function deleta_disciplina(){
		confereLogin('adm','dashboard');

		//Verifica se o id do curso foi passado
		$id = $this->uri->segment(3);
		if ($id>0) {
			if ($disciplina = $this->disciplina->get_single($id)) {
				$dados_pag['disciplina'] = $disciplina;
				$dados_pag['cursos'] = $this->disciplina_curso->get_cursos_disciplina($id);
			} else {
				set_msg('Disciplina selecionada não existe!');
				redirect('admin/lista_disciplina','refresh');
			}
		} else {
			set_msg('Nenhuma disciplina selecionada!');
			redirect('admin/lista_disciplina','refresh');
		}

		$this->form_validation->set_rules('deletar', 'Deletar', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			if($this->disciplina->deleta_disciplina($id)){
				set_msg('Disciplina excluída com sucesso!');
				redirect('admin/lista_disciplina','refresh');
			} else {
				set_msg('Erro ao excluir disciplina!');
			}
		}


		$dados_pag['titulo'] = 'Deletar Disciplina';
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/disciplina/deleta_disciplina',$dados_pag);
		$this->load->view('frame/footer_portal');

	}

	public function edita_disciplina(){
		confereLogin('adm','dashboard');

		//Verifica se o id da disciplina foi passado
		$id = $this->uri->segment(3);
		if ($id>0) {
			if ($disciplina = $this->disciplina->get_single($id)) {
				$dados_pag['disciplina'] = $disciplina;
				$dados_pag['cursos_atuais'] = $this->disciplina_curso->get_cursos_disciplina($id);
				$dados_updt['id'] = $disciplina->id;
			} else {
				set_msg('Disciplina selecionada não existe!');
				redirect('admin/lista_disciplina','refresh');
			}
		} else {
			set_msg('Nenhuma disciplina selecionada!');
			redirect('admin/lista_disciplina','refresh');
		}

		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[2]|max_length[45]');
		$this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|min_length[25]|max_length[2500]');
		$this->form_validation->set_rules('cursos[]', 'Cursos', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados_form = $this->input->post();
			$dados_updt += array(
				'nome' => $dados_form['nome'],
				'descricao' => to_bd($dados_form['descricao'])
			);
			// var_dump($dados_updt);
			if ( $this->disciplina->set_disciplina($dados_updt) || $this->disciplina_curso->compare_update($id,$dados_form['cursos']) ) {
				$this->disciplina_curso->set_update($id,$dados_form['cursos']);
				set_msg('Disciplina modificada com sucesso!');
			} else {
				set_msg('Erro! Nenhuma modificação feita nesta disciplina!');
			}
		}

		$dados_pag['cursos'] = $this->curso->get_cursos();

		$dados_pag['titulo'] = 'Editar Disciplina';
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/disciplina/edita_disciplina',$dados_pag);
		$this->load->view('frame/footer_portal');

	}
#
#
#	Configuração de Usuário
#
#
	public function usuario(){
		confereLogin('adm','dashboard');
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/usuario');
		$this->load->view('frame/footer');

	}

	public function adiciona_aluno(){
		confereLogin('adm','dashboard');

		$this->form_validation->set_rules('nome','Nome', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('sobrenome','Sobrenome', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('nasc','Data de Nasciemnto', 'trim');
		$this->form_validation->set_rules('tel','Telefone', 'trim|min_length[9]|max_length[12]|numeric');
		$this->form_validation->set_rules('email','E-mail', 'trim|valid_email');
		$this->form_validation->set_rules('login-cad','Login', 'trim|alpha_numeric|required|min_length[5]|is_unique[usuario.login]');
		$this->form_validation->set_rules('psw-cad','Senha', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('psw2','Senha2', 'trim|required|min_length[6]|matches[psw-cad]');

		$this->form_validation->set_rules('curso','Curso', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados_form = $this->input->post();
			if ($id = $this->usuario->set_usuario($dados_form,'aluno')) {
				$campos_usuario = array('id','login');
				$usuario_grade = $this->usuario->get_usuario($id,$campos_usuario);

				$campos_curso = array('id','nome');
				$curso_grade = $this->curso->get_single($dados_form['curso'],$campos_curso);

				$periodo_grade = $this->periodo->get_last_periodo();
				if ($this->grade->set($usuario_grade,$curso_grade,$periodo_grade)) {
					set_msg("Usuário adicionado!");
					redirect('admin/ver_usuario/'.$id,'refresh');
				} else {
					set_msg('Erro ao criar grade!');
				}
			}
			else{
				set_msg('Erro na inserção!');
			}
		}

		$cursos = $this->curso->get_cursos();
		if (isset($cursos) && sizeof($cursos) > 0) {
			$dados_pag['cursos'] = $cursos;
		} else {	
			set_msg("Nenhum curso adicionado ainda!");
			redirect('admin','refresh');
		}
		$dados_pag['titulo'] = 'Adicionar Aluno';
		$dados_pag['aluno'] = TRUE;
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/usuario/adiciona_usuario',$dados_pag);
		$this->load->view('frame/footer_portal');

	}

	public function adiciona_professor(){
		confereLogin('adm','dashboard');

		$this->form_validation->set_rules('nome','Nome', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('sobrenome','Sobrenome', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('nasc','Data de Nasciemnto', 'trim');
		$this->form_validation->set_rules('tel','Telefone', 'trim|min_length[9]|max_length[12]|numeric');
		$this->form_validation->set_rules('email','E-mail', 'trim|valid_email');
		$this->form_validation->set_rules('login-cad','Login', 'trim|alpha_numeric|required|min_length[5]|is_unique[usuario.login]');
		$this->form_validation->set_rules('psw-cad','Senha', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('psw2','Senha2', 'trim|required|min_length[6]|matches[psw-cad]');

		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados_form = $this->input->post();
			if ($id = $this->usuario->set_usuario($dados_form,'prof')) {
				set_msg("Usuário adicionado!");
				redirect('admin/ver_usuario/'.$id,'refresh');
			}
			else{
				set_msg('Erro na inserção!');
			}
		}

		$dados_pag['titulo'] = 'Adicionar Professor';
		$dados_pag['aluno'] = FALSE;
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/usuario/adiciona_usuario',$dados_pag);
		$this->load->view('frame/footer_portal');

	}

	public function lista_usuarios($pag = 1){
		confereLogin('adm','dashboard');

		// Para manipular segmentos na URI, pode-se passar como parâmetro no método do controller ou fazer a chamada pela própria library
		# $pag = $this->uri->segment(3);
		# $limite = 5;
		# if (isset($pag))
		# 	$offset = ($pag*$limite)-$limite;
		# else 
		#	$offset = 0;

		$dados['atual'] = 'dashboard';

		$dados_pag['pag_atual'] = $pag;
		$limite = 5;
		$offset = ($pag*$limite)-$limite;

		$dados_pag['usuarios'] = $this->usuario->get_usuarios($limite, $offset);

		$num_paginas = count($this->usuario->get_usuarios()) / $limite;

		$dados_pag['num_paginas'] = ceil($num_paginas);

		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/usuario/lista_usuario',$dados_pag);
		$this->load->view('frame/footer_portal');
		
	}
	public function ver_usuario($id=0){
		confereLogin('adm','dashboard');
		if ($id>0) {
			if ($usuario = $this->usuario->get_usuario($id)) {
				$dados_pag['usuario'] = $usuario;
				$grades = $this->grade->get_grades_usuario($id);
				if (isset($grades)) {
					foreach ($grades as $grade) {
						$turmas_temp = $this->inscrito->get_inscritos_grade($grade->id);
						if (isset($turmas_temp)) {
							$turmas[$grade->id] = $turmas_temp;
						}
						$grade->fk_curso = $this->curso->get_single($grade->fk_curso);
						$grade->fk_per = $this->periodo->get_single($grade->fk_per);
					}
				}
				// print_r($turmas);
				// echo "<br><br>";
				// print_r($grades);
				$dados_pag['turmas'] = (isset($turmas))?$turmas:null;
				$dados_pag['grades'] = $grades;
				$limite_historico = 10;
				$dados_pag['historicos'] = $this->historico->get_historicos($id,$limite_historico);
			} else {
				set_msg('Usuário selecionado não existe!');
				redirect('admin/lista_usuarios','refresh');
			}
		} else {
			set_msg('Nenhum Usuário selecionado!');
			redirect('admin/lista_usuarios','refresh');
		}

		$cursos = $this->curso->get_cursos();
		if (isset($cursos) && sizeof($cursos) > 0) {
			$dados_pag['cursos'] = $cursos;
		} else {	
			set_msg("Nenhum curso adicionado ainda!");
			redirect('admin','refresh');
		}
		$dados_pag['titulo'] = 'Ver Usuário';
		$dados['atual'] = 'dashboard';
		$this->load->view('frame/header',$dados);
		$this->load->view('portal/admin/usuario/ver_usuario',$dados_pag);
		$this->load->view('frame/footer_portal');

	}

	public function deleta_usuario(){
		confereLogin('adm','dashboard');

		$this->form_validation->set_rules('deletar', 'Deletar', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados_form = $this->input->post();
			// print_r($dados_form);
			if ($dados_form['id'] == 1) {
				set_msg('Impossível excluir o Administrador do Portal.');
			} else {	
				if($this->usuario->deleta_usuario($dados_form['id'])){
					set_msg('Usuário deletado com sucesso!');
				} else {
					set_msg('Erro ao deletar usuário!');
				}
			}
			$this->lista_usuarios();
		}

	}

	public function adiciona_grade(){
		confereLogin('adm','dashboard');

		$this->form_validation->set_rules('curso', 'Curso', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados_form = $this->input->post();
			// print_r($dados_form);
			$campos_usuario = array('id','login');
			$usuario_grade = $this->usuario->get_usuario($dados_form['usuario_id'],$campos_usuario);

			$campos_curso = array('id','nome');
			$curso_grade = $this->curso->get_single($dados_form['curso'],$campos_curso);

			$periodo_grade = $this->periodo->get_last_periodo();
			if ($this->grade->set($usuario_grade,$curso_grade,$periodo_grade)) {
				set_msg("Grade adicionada!");
				redirect('admin/ver_usuario/'.$dados_form['usuario_id'],'refresh');
			} else {
				set_msg('Erro ao criar grade!');
			}
		}
		redirect('admin/ver_usuario/'.$dados_form['usuario_id'],'refresh');
	}

	public function edita_grade_renovavel(){
		confereLogin('adm','dashboard');
		
		$this->form_validation->set_rules('renovavel', 'Renovável', 'trim');
		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados_form = $this->input->post();
			$renovavel = (isset($dados_form['renovavel']))?1:0;
			$dados_upt = array('id' => $dados_form['grade_id'], 'renovavel' => $renovavel );
			if($erro = $this->grade->edita_grade_renovavel($dados_upt)) {
				set_msg('Alterado com sucesso!');
			} else {
				set_msg("Erro ao mudar campo 'renovável'");
			}
		}
		redirect('admin/ver_usuario/'.$dados_form['usuario_id'],'refresh');
	}

	public function deleta_grade(){
		confereLogin('adm','dashboard');

		$this->form_validation->set_rules('deletar', 'Deletar', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			if($error = validation_errors())
				set_msg($error);
		} else {
			$dados_form = $this->input->post();
			// print_r($dados_form);
			if($this->grade->deleta_grade($dados_form['grade_id'])){
				set_msg('Grade deletada com sucesso!');
			} else {
				set_msg('Erro ao deletar grade!');
			}
		}
		redirect('admin/ver_usuario/'.$dados_form['usuario_id'],'refresh');
	}
/*
*/
}
