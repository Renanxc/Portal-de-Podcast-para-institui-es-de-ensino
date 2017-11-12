<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usuario_historico_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function set($id_usu=null){
		if (is_null($id_usu)) {
			return FALSE;
		} else {
			$dados = array('fk_usu' => $id_usu,
					'data' => mdate('%Y-%m-%d'),
					'hora' => mdate('%H:%i:%s')
			 );
			$this->db->insert('usuario_historico', $dados);
			return TRUE;
		}

	}
	public function get_historicos($id=null,$limit=0,$offset=0){
		if ($id) {
			if ($limit==0) {
				$query = $this->db 	->order_by('id','desc')
									->where('fk_usu',$id)
									->get('usuario_historico');
				if ($query->num_rows() > 0) {
					return $query->result();
				} else {
					return null;
				}
			} else {
				$query = $this->db 	->order_by('id','desc')
									->where('fk_usu',$id)
									->get('usuario_historico',$limit,$offset);
				if ($query->num_rows() > 0) {
					return $query->result();
				} else {
					return null;
				}
			}
		} else {
			$query = $this->db->get('usuario_historico');
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}
	}

}