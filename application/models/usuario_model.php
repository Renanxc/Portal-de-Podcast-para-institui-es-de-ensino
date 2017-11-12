<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function get_exist_senha($form){
		$this->db->where('login',$form['login']);
		$query = $this->db->get('usuario');
		$row = $query->row();
		if(	password_verify($form['psw'],$row->senha) )
			return $row;
		else
			return NULL;
	}
	public function get_exist_op($op,$value){
		$this->db->where($op,$value);
		$query = $this->db->get('usuario',1);
		if ($query->num_rows() == 1) 
			return TRUE;
		else
			return FALSE;
	}
	public function set_usuario($dados_form,$privilegio){
		if (isset($dados_form['id']) && $dados_form['id'] > 0) {
			//update usuário
			$this->db->where('id',$dados_form['id']);
			unset($dados_form['id']);
			$this->db->update('usuario', $dados_form);
			return $this->db->affected_rows();
		} else {
			//insere usuário
			$dados = array(
				'nome' => $dados_form['nome'],
				'sobrenome' => $dados_form['sobrenome'],
				'data_nasc' => $dados_form['nasc'],
				'telefone' => $dados_form['tel'],
				'email' => $dados_form['email'],
				'login' => $dados_form['login-cad'],
				'senha' => password_hash($dados_form['psw-cad'], PASSWORD_DEFAULT),
				'privilegio' => $privilegio
			);
			$this->db->insert('usuario',$dados);
			return $this->db->insert_id();
		}
	}
	public function get_usuario($id,$campos='*'){
		$this->db->select($campos);
		$this->db->where('id',$id);
		$query = $this->db->get('usuario',1);
		if ($query->num_rows() == 1) 
			return $query->row();
		else
			return NULL;
	}

	public function get_usuarios($limit=0, $offset=0){
		if ($limit == 0) {
			$this->db->order_by('id', 'desc');
			$query = $this->db->get('usuario');
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return NULL;
			}
		} else {
			$this->db->order_by('id', 'desc');
			$query = $this->db->get('usuario',$limit,$offset);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return NULL;
			}
		}
	}

	public function deleta_usuario($id=null){
		$this->db->where('id',$id);
		$this->db->delete('usuario');
		return $this->db->affected_rows();
	}
}