<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model{

	function __construct(){	
		parent:: __construct();
	}

	public function store($table, $idTable, $id, $date){
		if ($id) {
			// caso o id tenha algum valor, ele irá alterar os dados do banco de dados
			$this->db->where($idTable, $id);
			if ($this->db->update($table, $date)) {
				return true;
			}else{
				return false;
			}
		}else{
			// se não existir id, ele insere no banco de dados
			if ($this->db->insert($table, $date)) {
				return true;
			}else{
				return false;
			}
		}
	}

	public function listAll($tabela, $camp, $order, $campo){
		$this->db->select($campo)->from($tabela);
		$this->db->order_by($camp, $order);
		$query = $this->db->get()->result();
		if ($query) {
			return $query;
		}else{
			return false;
		}
	}
	// recupera o registro de alguma tabela e retorna para a tela, para ser editado 
	public function getOne($tabela, $idTable, $id){
		$this->db->select('*')->from($tabela);
		$this->db->where($idTable, $id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	// deleta um registro do banco de dados, de acordo com as informações vinda da controller
	public function delete($tabela, $idTable, $id){
		if ($id) {
			return $this->db->where($idTable, $id)->delete($tabela);
		}else{
			return false;
		}
	}
	
}

?>