<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disciplina_curso_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function set($id_disciplina=null,$cursos=null){
		if ($id_disciplina == null or $cursos == null) {
			return FALSE;
		} else {
			foreach ($cursos as $id_curso) {
				$dados[] = array(
					'id_disciplina' => $id_disciplina,
					'id_curso' => $id_curso
				);
			}
			$this->db->insert_batch('disciplina_curso',$dados);
			return TRUE;
		}
	}

	public function set_update($id_disciplina=null,$novos=null){
		$this->db->where('id_disciplina',$id_disciplina);
		$this->db->delete('disciplina_curso');
		$this->db->reset_query();
		foreach ($novos as $id_curso) {
			$dados[] = array(
				'id_disciplina' => $id_disciplina,
				'id_curso' => $id_curso
			);
		}
		$this->db->insert_batch('disciplina_curso',$dados);
	}
	public function compare_update($id_disciplina=null,$novos=null){
		//Se algum valor for nulo, então não haverá update
		if ($id_disciplina == null or $novos == null) {
			return FALSE;
		} else {
			// Pega os cursos atuais do banco
			$atuais = $this->get($id_disciplina);
			// Zera contador de cursos coexistentes entre os que já que estão no banco e os que foram editados
			$contador = 0;
			foreach ($novos as $novo) {
				$flag = false;
				foreach ($atuais as $atual) {
					if ($atual->id_curso == $novo) {
						// A flag serve para encontrar um incidência dos cursos vindos da edição com os que já estão no banco
						$flag = true;
					}
					
					// Debug para criação da lógica 

					# echo $atual->id_curso.' compara com '.$novo.' então é '.$flag.'<br>';
				}
				// Se algum dos cursos atuais for igual à algum dos novos, o contador ganhará +1
				if ($flag) {
					$contador++;
				}
			}

			// Debug para criação da lógica 

			# echo 'Cursos atuais e novos que coexistem ='.$contador.'<br>';
			# echo 'Atuais ='.count($atuais).'<br>';
			# echo 'Novos ='.count($novos);

			// Se o número de novos cursos na edição for menor que os atuais, então o contador de incidência será comparado com os atuais
			if (count($novos) < count($atuais)) {
				if ($contador == count($atuais)) {
					return FALSE;
				} else {
					return TRUE;
				}
			// Se não, será comparado com os novos
			} else {
				if ($contador == count($novos)) {
					return FALSE;
				} else {
					return TRUE;
				}
			}
		}
	}
	public function get($id_disciplina=null){
		if ($id_disciplina == null) {
			$query = $this->db->get('disciplina_curso');
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		} else {	
			$this->db->where('id_disciplina',$id_disciplina);
			$query = $this->db->get('disciplina_curso');
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}
	}
	public function get_cursos_disciplina($id_disciplina){
		$this->db->join('disciplina','disciplina.id = disciplina_curso.id_disciplina','right');
		$this->db->join('curso','curso.id = disciplina_curso.id_curso','left');
		$this->db->where('id_disciplina',$id_disciplina);
		$query = $this->db->get('disciplina_curso');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return NULL;
		}
	}

}