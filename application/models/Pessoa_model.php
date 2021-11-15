<?php

class Pessoa_model extends MY_Model
{
	protected $table = 'pessoas';
	protected $primaryKey = 'idPessoa';
	protected $fields = ['nome', 'email', 'deleted_at'];
	protected $softDelete = true;
}
