<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grade_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function set($usuario=null,$curso=null,$periodo=null){
		if ($usuario == null or $curso == null or $periodo == null)  {
			return FALSE;
		} else {
			$dados = array(
				'fk_usu' => intval($usuario->id),
				'fk_curso' => intval($curso->id),
				'fk_per' => intval($periodo->id),
				'cod_grade' => ''.$periodo->ano.'_'.$periodo->semestre.'-'.str_replace(' ','',$curso->nome).'.'.str_replace(' ','',$usuario->login).'',
				'renovavel' => TRUE
			);
			$this->db->insert('grade',$dados);
			return TRUE;
		}
	}
	public function edita_grade_renovavel($grade=null){
		$this->db 	->where('id',$grade['id'])
					->set('renovavel',$grade['renovavel'],FALSE)
					->update('grade');
		return $this->db->affected_rows();
	}
	public function get_grades_usuario($id=null){
			if ($id) {
				$this->db 	->where('fk_usu',$id)
							->order_by('id','DESC');
				$query = $this->db->get('grade');
				if ($query->num_rows() > 0) {
					return $query->result();
				} else {
					return null;
				}
			} else {
				return null;
			}
	}
	public function deleta_grade($id=null){
		$this->db 	->where('id',$id)
					->delete('grade');
		return $this->db->affected_rows();
	}

}