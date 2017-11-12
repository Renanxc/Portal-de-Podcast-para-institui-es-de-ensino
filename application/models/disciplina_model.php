<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disciplina_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function set_disciplina($dados){
		if (isset($dados['id']) && $dados['id'] > 0) {
			//update curso
			$this->db->where('id',$dados['id']);
			unset($dados['id']);
			$this->db->update('disciplina', $dados);
			return $this->db->affected_rows();
		} else {
			//insert curso
			$this->db->insert('disciplina',$dados);
			return $this->db->insert_id();
		}
	}

	public function get_disciplinas($limit=0, $offset=0){
		if ($limit == 0) {
			$this->db->order_by('id', 'desc');
			$query = $this->db->get('disciplina');
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return NULL;
			}
		} else {
			$this->db->order_by('id', 'desc');
			$query = $this->db->get('disciplina',$limit,$offset);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return NULL;
			}
		}
	}

	public function get_single($id=0,$campos='*'){
		$this->db 	->where('id', $id)
					->select($campos);
		$query = $this->db->get('disciplina', 1);
		if ($query->num_rows() == 1) {
			$row = $query->row();
			return $row;
		} else{
			return NULL;
		}
	}

	public function deleta_disciplina($id=0){
		$this->db->where('id',$id);
		$this->db->delete('disciplina');
		return $this->db->affected_rows();
	}

}