<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turma_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	public function confereProfessor($id,$prof){
		$query = $this->db 	->where('id',$id)
							->where('fk_prof',$prof)
							->get('turma',1);
		if ($query->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function cria_nome($usuario=null,$disciplina=null,$periodo=null,$turno=null){
		if ($usuario == null or $disciplina == null or $periodo == null or $turno ==null)  {
			return FALSE;
		} else {
			$nome = ''.$periodo->ano.'_'.$periodo->semestre.'-'.str_replace(' ','',$disciplina->nome).'-'.$turno.'.'.str_replace(' ','',$usuario->nome).'_'.str_replace(' ','',$usuario->sobrenome).'';
			$query = $this->db 	->where('nome',$nome)
								->get('turma',1);
			if ($query->num_rows() == 0) {
				return $nome;
			} else {
				return FALSE;
			}

		}
	}
	public function set_turma($usuario=null,$disciplina=null,$periodo=null,$turno=null,$nome){
		if ($usuario == null or $disciplina == null or $periodo == null or $turno ==null)  {
			return FALSE;
		} else {

			$dados = array(
				'fk_prof' => $usuario->id,
				'fk_disc' => $disciplina->id,
				'fk_per' => $periodo->id,
				'nome' => $nome,
				'turno' => $turno,
				'status' => 'Em Andamento'
			);
			$this->db->insert('turma',$dados);
			return $this->db->insert_id();
		}
	}
	public function get_turma($id,$campos='*'){
		$this->db->select($campos);
		$this->db->where('id',$id);
		$query = $this->db->get('turma',1);
		if ($query->num_rows() == 1) 
			return $query->row();
		else
			return NULL;
	}
	public function get_turmas_usuario($id=null){
		if ($id) {
			$this->db 	->where('fk_prof',$id)
						->order_by('id','DESC');
			$query = $this->db->get('turma');
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		} else {
			return null;
		}
	}

	public function get_candidatos($id) {
		$query = $this->db 	->select('usuario.nome as nome, grade.cod_grade as grade,grade.id as id')
							->join('disciplina','disciplina.id = turma.fk_disc','outer left')
							->join('disciplina_curso as dc', 'dc.id_disciplina = disciplina.id','outer left')
							->join('curso', 'curso.id = dc.id_curso','outer left')
							->join('periodo', 'periodo.id = turma.fk_per','outer left')
							->join('grade','grade.fk_curso = curso.id and grade.fk_per = periodo.id', 'outer left')
							->join('usuario','usuario.id = grade.fk_usu', 'outer left')
							->where('turma.id',$id)
							->get('turma');
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function deleta_turma($dados){
		$this->db 	->where('id',$dados['turma'])
					->delete('turma');
		return $this->db->affected_rows();
	}
}