<?php

class MY_Model extends CI_Model
{
	protected $table;
	protected $primaryKey;
	protected $fields = array();
	protected $timestamp = false;
	protected $softDelete = false;

	public function __construct()
	{
		parent::__construct();
	}

	public function findById(int $id){
		return $this->db->select($this->getFields())
			->from($this->table)
			->where([$this->primaryKey => $id])
		->get()->row();
	}

	/**
	 * list all record from a database
	 * @return array|array[]|object|object[]
	 */
	public function all(){
		$this->db->select($this->getFields())->from($this->table);
		if($this->softDelete){
			$this->db->where('deleted_at is null');
		}
		return $this->db->get()->result();
	}

	public function trashed(){
		return $this->db->select($this->getFields())->from($this->table)->where('deleted_at is not null')->get()->result();
	}

	/**
	 * create a new record in the database
	 * @param array $attributes
	 * @return array|mixed|object|null
	 */
	public function create(array $attributes){
		$this->db->insert($this->table, $attributes);
		return $this->findById($this->db->insert_id());
	}

	/**
	 * update a record by id in the database
	 * @param int $id
	 * @param array $attributes
	 * @return array|false|mixed|object|null
	 */
	public function update(int $id, array $attributes){
		$this->db->where($this->primaryKey, $id);
		try {
			$this->db->update($this->table, $attributes);
			return $this->findById($id);
		}catch (Exception $exception){
			return false;
		}
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function softDelete(int $id):bool{
		if(!$this->findById($id)){
			return false;
		}
		return $this->db->where($this->primaryKey, $id)->update($this->table, ['deleted_at' => date('Y-m-d H:i:s')]);
	}

	/**
	 * remove a record from database
	 * @param int $id
	 * @return bool
	 */
	public function destroy(int $id):bool{
		if(!$this->findById($id)){
			return false;
		}
		return $this->db->where($this->primaryKey, $id)->delete($this->table);
	}

	public function restore(int $id):bool{
		if(!$this->findById($id)){
			return false;
		}
		return $this->db->where($this->primaryKey, $id)->update($this->table, ['deleted_at' => null]);
	}

	/**
	 * @return string
	 */
	private function getFields(){
		array_unshift($this->fields, $this->primaryKey);
		return implode(',', $this->fields);
	}

}
