<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Podcast_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function set_podcast($podcast,$turma){
		$dados = array(
			'fk_tur' => $turma,
			'arquivo' => $podcast,
			'data' => mdate('%Y-%m-%d'),
			'hora' => mdate('%H:%m:%s')
		);
		$this->db->insert('podcast',$dados);
		return $this->db->insert_id();
	}
	public function get_podcast_turma($id_turma){
		$query = $this->db 	->where('fk_tur',$id_turma)
							->get('podcast');
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

}