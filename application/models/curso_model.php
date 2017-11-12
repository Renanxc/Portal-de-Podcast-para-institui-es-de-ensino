<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	public function set_curso($dados){
		if (isset($dados['id']) && $dados['id'] > 0) {
			//update curso
			$this->db->where('id',$dados['id']);
			unset($dados['id']);
			$this->db->update('curso', $dados);
			return $this->db->affected_rows();
		} else {
			//insert curso
			$this->db->insert('curso',$dados);
			return $this->db->insert_id();
		}
	}

	public function get_cursos($limit=0, $offset=0){
		if ($limit == 0) {
			$this->db->order_by('id', 'desc');
			$query = $this->db->get('curso');
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return NULL;
			}
		} else{
			$this->db->order_by('id', 'desc');
			$query = $this->db->get('curso',$limit,$offset);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return NULL;
			}
		}
	}

	public function get_single($id=0,$campos='*'){
		$this->db->select($campos);
		$this->db->where('id', $id);
		$query = $this->db->get('curso', 1);
		if ($query->num_rows() == 1) {
			$row = $query->row();
			return $row;
		} else{
			return NULL;
		}
	}

	public function deleta_curso($id=0){
		$this->db->where('id',$id);
		$this->db->delete('curso');
		return $this->db->affected_rows();
	}

}