<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodo_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	public function get_last_periodo() {
		$this->db->select('*')
					->order_by('id','desc');
		$query = $this->db->get('periodo',1);
		if ($query->num_rows() == 1) {
			$row = $query->row();
			return $row;
		} else {
			return null;
		}
	}
	public function confere_periodo($last,$semestre){
		// $this->db->where('id',$id);
		// $query = $this->db->get('periodo',1);
		if($last){
			if ($last->ano < mdate('%Y'))
				return TRUE;
			if ($last->ano == mdate('%Y')) {
				if ($last->semestre < $semestre)
					return TRUE;
				else
					return FALSE;
			}
			else
				return FALSE;
		}
		else
			return TRUE;
	}
	public function set_periodo($semestre){
		$dados = array(
			'ano' => mdate('%Y'),
			'semestre' => $semestre
		);
		$this->db->insert('periodo',$dados);
		return $this->db->insert_id();
	}

	public function get_single($id=0,$campos='*'){
		$this->db->select($campos);
		$this->db->where('id', $id);
		$query = $this->db->get('periodo', 1);
		if ($query->num_rows() == 1) {
			$row = $query->row();
			return $row;
		} else{
			return NULL;
		}
	}
}