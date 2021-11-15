<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function __construct(){	
		parent:: __construct();
		$this->load->model('pessoa_model', 'pessoa');
	}

	public function index(){
		$dados['pessoas'] = $this->pessoa->all();
		$this->load->view('home', $dados);
	}

	public function create(){
		$this->load->view('createOrUpdate');
	}

	public function store(){
		if ($this->form_validation->run('pessoa/create') == FALSE) {
			return formErrorJson();
		}else{
			$data = array(
				"nome" => $this->input->post('nome'),
				"email" => $this->input->post('email')
			);
			if (!$this->pessoa->create($data)) {
				return json(['type' => 'error', 'message' => 'Não foi possível realizar o cadastro']);
			}
			return json(['type' => 'success', 'message' => 'Cadastro realizado com sucesso']);
		}
	}

	public function edit($id){
		$dados['pessoa'] = $this->pessoa->findById($id);
		$this->load->view('createOrUpdate', $dados);
	}
	
	public function update($id){
		if ($this->form_validation->run('pessoa/create') == FALSE) {
			return formErrorJson();
		}else{
			$data = array(
				"nome"=> $this->input->post('nome'),
				"email"=> $this->input->post('email')
			);
			if (!$this->pessoa->update($id, $data)) {
				return json(['type' => 'error', 'message' => 'Não foi possível realizar a alteração dos dados']);
			}
			return json(['type' => 'success', 'message' => 'Dados atualizado']);
		}
	}

	public function trash(){
		$data['trash'] = $this->pessoa->trashed();
		$this->load->view('trash', $data);
	}

	public function restore($id){
		if(!$this->pessoa->restore($id)){
			return json(['type' => 'error', 'message' => 'Não foi possível restaura o registro']);
		}
		return json(['type' => 'success', 'message' => 'Registro restaurado com sucesso']);
	}

	public function softDelete($id){
		if(!$this->pessoa->softDelete($id)){
			return json(['type' => 'error', 'message' => 'Não foi possível remover o registro']);
		}
		return json(['type' => 'success', 'message' => 'Registro removido com sucesso']);
	}

	public function destroy($id){
		if (!$this->pessoa->destroy($id)) {
			return json(['type' => 'error', 'message' => 'Não foi possível remover o registro']);
		}
		return json(['type' => 'success', 'message' => 'Registro removido com sucesso']);
	}

}
