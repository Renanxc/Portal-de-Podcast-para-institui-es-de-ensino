<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscrito_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function get_inscritos_turma($id){
		$this->db 	->select('id_turma,id_grade,usuario.nome as aluno,usuario.sobrenome as sobrenome,curso.nome as curso,inscrito.data as data')
					->join('turma','turma.id = inscrito.id_turma','outer right')
					->join('grade','grade.id = inscrito.id_grade','outer left')
					->join('usuario','usuario.id = grade.fk_usu','outer left')
					->join('curso','curso.id = grade.fk_curso','outer right')
				 	->where('id_turma',$id);
		$query = $this->db->get('inscrito');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return NULL;
		}
	}

	public function get_inscritos_grade($id){
		$this->db->join('grade','grade.id = inscrito.id_grade','right');
		$this->db->join('turma','turma.id = inscrito.id_turma','left');
		$this->db->where('id_grade',$id);
		$query = $this->db->get('inscrito');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return NULL;
		}
	}

	public function set_inscrito($dados_form){
		$dados = array(
					'id_turma' => $dados_form['turma'],
					'id_grade' => $dados_form['grade'],
					'data' => mdate('%Y-%m-%d')
		);
		$this->db->insert('inscrito',$dados);
		return TRUE;
	}

	public function deleta_inscrito($dados){
		$this->db 	->where('id_turma',$dados['turma'])
					->where('id_grade', $dados['grade'])
					->delete('inscrito');
		return $this->db->affected_rows();
	}
}