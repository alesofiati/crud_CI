<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model{

	/**
	 * Crud_model constructor.
	 */
	function __construct(){
		parent:: __construct();
	}

	/**
	 * Insere ou atualiza o registro na base
	 * @param string $table
	 * @param string $table_id
	 * @param string $id
	 * @param array $attributes
	 * @return bool
	 */
	public function store(string $table, string $table_id, $id = "", array $attributes){
		if ((!empty($id) && is_numeric($id))) {
			// caso o id tenha algum valor, ele irá alterar os dados do banco de dados
			$this->db->where($table_id, $id);
			if ($this->db->update($table, $attributes)) {
				return true;
			}else{
				return false;
			}
		}else{
			// se não existir id, ele insere no banco de dados
			if ($this->db->insert($table, $attributes)) {
				return true;
			}else{
				return false;
			}
		}
	}

	/**
	 * Busca todos os registro de uma tabela na base de dados
	 * @param string $table
	 * @param false $order_by
	 * @param array $order
	 * @param string $fields
	 * @return false
	 */
	public function all(string $table, $order_by = false, $order = [], string $fields = '*'){
		$this->db->select($fields)->from($table);
		if($order_by){
			$this->db->order_by($order);
		}
		$query = $this->db->get()->result();
		if ($query) {
			return $query;
		}else{
			return false;
		}
	}

	/**
	 * Recupera registro da base de dados
	 * @param string $table
	 * @param string $table_id
	 * @param int $id
	 * @param string $fields
	 * @return mixed
	 */
	public function find(string $table, string $table_id, int $id, string $fields = '*'){
		$this->db->select($fields)->from($table);
		$this->db->where($table_id, $id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	/**
	 * @param string $table
	 * @param string $fields
	 * @param array $joins
	 * @return mixed
	 */
	public function join(string $table, string $fields = "*", array $joins){
		$this->db->select($fields);
		$this->db->from($table);
		foreach ($joins as $key => $join){
			if(isset($join['table']) && isset($join['condition']) && isset($join['type_join'])){
				$this->db->join($join['table'], $join['condition'], $join['type_join']);
			}
		}
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Remove registro da base de dados
	 * @param string $table
	 * @param string $table_id
	 * @param int $id
	 * @return bool
	 */
	public function destroy(string $table, string $table_id, int $id){
		if(count($this->find($table,$table_id, $id)) > 0){
			$this->db->where($table_id, $id)->delete($table);
			return true;
		}
		return false;
	}
	
}

?>
